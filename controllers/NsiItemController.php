<?php

namespace app\controllers;


use gisgkh\Helper;
use gisgkh\services\NsiService;

use gisgkh\types\NsiBase\NsiElementType;
use gisgkh\types\NsiBase\NsiItemType;
use gisgkh\types\NsiCommon\exportNsiItemRequest;

use yii\data\ArrayDataProvider;
use yii\web\Controller;

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

        $dataProvider = new ArrayDataProvider([
            'allModels' => $nsiItem ? $nsiItem->NsiElement : [],
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
                'label' => 'Guid',
                'format' => 'raw',
                'value' => function (NsiElementType $nsiElement) {
                    return $nsiElement->GUID;
                }
            ],
            [
                'label' => 'Значение',
                'format' => 'raw',
                'value' => function (NsiElementType $nsiElement) {
                    return '<pre>' . json_encode($nsiElement->NsiElementField, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . '</pre>';
                }
            ],
        ];

        return $columns;
    }
}