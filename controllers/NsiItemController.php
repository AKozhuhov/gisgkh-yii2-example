<?php

namespace app\controllers;

use yii\data\ArrayDataProvider;
use yii\web\Controller;

use gisgkh\Helper;
use gisgkh\Okei;
use gisgkh\services\NsiService;

use gisgkh\types\NsiBase\NsiElementBooleanFieldType;
use gisgkh\types\NsiBase\NsiElementDateFieldType;
use gisgkh\types\NsiBase\NsiElementFloatFieldType;
use gisgkh\types\NsiBase\NsiElementOkeiRefFieldType;
use gisgkh\types\NsiBase\NsiElementStringFieldType;
use gisgkh\types\NsiBase\NsiElementType;
use gisgkh\types\NsiBase\NsiItemType;
use gisgkh\types\NsiCommon\exportNsiItemRequest;

/**
 * Просмотр справочника НСИ
 */
class NsiItemController extends Controller
{
    public function actionIndex($registryNumber)
    {
        /* @var NsiItemType $nsiItem */
        $nsiItem = null;
        $error = null;

        // создание сервиса экспорта общесистемных справочников НСИ
        $service = new NsiService(\Yii::$app->params['opengkh']);

        // формирование критериев выборки
        $request = new exportNsiItemRequest();
        $request->RegistryNumber = $registryNumber;
        $request->Id = Helper::guid();
        $request->ListGroup = 'NSI';

        try {
            // выполнение зароса к SOAP методу
            $response = $service->exportNsiItem($request);

            if (empty($response->ErrorMessage)) {
                // получение полного справочника из ответа SOAP метода
                $nsiItem = $response->NsiItem;
            } else {
                // обработка ошибок контролей или бизнес-процесса
                $error = "{$response->ErrorMessage->ErrorCode}: {$response->ErrorMessage->Description}";
            }
        } catch (\Exception $e) {
            // обработка критических ошибок, таких как SoapFault
            $error = $e->getMessage();
        }

        $elements = $nsiItem ? $nsiItem->NsiElement : [];

        usort($elements, function (NsiElementType $a, NsiElementType $b) {
            return $a->Code < $b->Code ? -1 : ($a->Code > $b->Code ? 1 : 0);
        });

        $dataProvider = new ArrayDataProvider([
            'allModels' => $elements,
        ]);

        // перечень столбцов для GridView по колонкам справочника
        $columns = $this->buildGridColumnsForNsiItem($nsiItem);

        return $this->render('index', [
            'registryNumber' => $registryNumber,
            'dataProvider' => $dataProvider,
            'error' => $error,
            'nsiItem' => $nsiItem,
            'columns' => $columns
        ]);
    }

    /**
     * Формирование столбцов gridview для конкретного справочника НСИ
     * @param NsiItemType $nsiItem
     * @return array
     */
    private function buildGridColumnsForNsiItem(NsiItemType $nsiItem = null)
    {
        $columns = [
            [
                'label' => 'Код',
                'headerOptions' => [
                    'width' => '5rem'
                ],
                'format' => 'raw',
                'value' => function (NsiElementType $nsiElement) {
                    return $nsiElement->Code;
                }
            ],
            [
                'label' => 'Актуально',
                'headerOptions' => [
                    'width' => '5rem'
                ],
                'format' => 'raw',
                'value' => function (NsiElementType $nsiElement) {
                    return $nsiElement->IsActual ? 'да' : 'нет';
                }
            ],
            [
                'label' => 'Обновлено',
                'headerOptions' => [
                    'width' => '5rem'
                ],
                'format' => 'raw',
                'value' => function (NsiElementType $nsiElement) {
                    return \Yii::$app->formatter->asDate($nsiElement->Modified, 'short');
                }
            ],
            [
                'label' => 'Guid',
                'format' => 'raw',
                'value' => function (NsiElementType $nsiElement) {
                    $shortGuid = substr($nsiElement->GUID, 0, 8) . '...';
                    return <<<HTML
<a href="javascript:void(0);" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="right" data-content="{$nsiElement->GUID}">
  {$shortGuid}
</a>
HTML;
                }
            ]
        ];

        if ($nsiItem && $nsiItem->NsiElement) {
            $firstElement = $nsiItem->NsiElement[0];
            foreach ($firstElement->NsiElementField as $nsiColumn) {
                $column = [
                    'label' => $nsiColumn->Name,
                    'format' => 'raw'
                ];
                if ($nsiColumn instanceof NsiElementBooleanFieldType) {
                    $column['value'] = function (NsiElementType $element) use ($nsiColumn) {
                        /* @var NsiElementBooleanFieldType $field */
                        foreach ($element->NsiElementField as $field) {
                            if ($field->Name == $nsiColumn->Name) break;
                        }
                        return $field->Value ? 'да' : 'нет';
                    };
                } elseif ($nsiColumn instanceof NsiElementStringFieldType) {
                    $column['value'] = function (NsiElementType $element) use ($nsiColumn) {
                        /* @var NsiElementStringFieldType $field */
                        foreach ($element->NsiElementField as $field) {
                            if ($field->Name == $nsiColumn->Name) break;
                        }
                        return $field->Value;
                    };
                } elseif ($nsiColumn instanceof NsiElementFloatFieldType) {
                    $column['value'] = function (NsiElementType $element) use ($nsiColumn) {
                        /* @var NsiElementFloatFieldType $field */
                        foreach ($element->NsiElementField as $field) {
                            if ($field->Name == $nsiColumn->Name) break;
                        }
                        return \Yii::$app->formatter->asDecimal($field->Value);
                    };
                } elseif ($nsiColumn instanceof NsiElementDateFieldType) {
                    $column['value'] = function (NsiElementType $element) use ($nsiColumn) {
                        /* @var NsiElementFloatFieldType $field */
                        foreach ($element->NsiElementField as $field) {
                            if ($field->Name == $nsiColumn->Name) break;
                        }
                        return \Yii::$app->formatter->asDate($field->Value, 'short');
                    };
                } elseif ($nsiColumn instanceof NsiElementOkeiRefFieldType) {
                    $column['value'] = function (NsiElementType $element) use ($nsiColumn) {
                        /* @var NsiElementOkeiRefFieldType $field */
                        foreach ($element->NsiElementField as $field) {
                            if ($field->Name == $nsiColumn->Name) break;
                        }
                        $okei = Okei::getByCode($field->Code);
                        return ($okei ? $okei->title : '--') . "<br/>ОКЕИ {$field->Code}";
                    };
                } else {
                    $column['value'] = function (NsiElementType $element) use ($nsiColumn) {
                        /* @var NsiElementBooleanFieldType $field */
                        foreach ($element->NsiElementField as $field) {
                            if ($field->Name == $nsiColumn->Name) break;
                        }
                        $json = "<pre style='display: none;' class='json-value'>" . json_encode($field, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "</pre>";
                        return "<a href=\"javascript:void(0);\" onclick=\"$('.json-value').toggle();\">json</a>{$json}";

                    };
                }

                $columns[] = $column;
            }
        }

        return $columns;
    }
}