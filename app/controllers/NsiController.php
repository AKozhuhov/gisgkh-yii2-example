<?php

namespace app\controllers;

use app\nsi\NSIElement;
use app\nsi\NSIStorage;

use gisgkh\types\lib\Nsi\NsiElementBooleanFieldType;
use gisgkh\types\lib\Nsi\NsiElementFloatFieldType;
use gisgkh\types\lib\Nsi\NsiElementOkeiRefFieldType;
use gisgkh\types\lib\Nsi\NsiElementStringFieldType;

use opengkh\gis\components\NsiDynamicManager;
use opengkh\gis\models\common\Okei;

use yii\data\ArrayDataProvider;
use yii\web\Controller;

/**
 * Просмотр НСИ
 */
class NsiController extends Controller
{
    public function actionIndex()
    {
        /**
         * @var NsiDynamicManager $nsi
         */
        $nsi = \Yii::$app->get('nsi');
        $nsi->updateReferencesList();

        /**
         * @var NSIStorage $nsiStorage
         */
        $nsiStorage = \Yii::$app->get('nsiStorage');

        $dataProvider = new ArrayDataProvider([
            'allModels' => $nsiStorage->references,
        ]);

        $dataProvider->pagination->pageSize = 100;

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($registryNumber)
    {
        /**
         * @var NsiDynamicManager $nsi
         */
        $nsi = \Yii::$app->get('nsi');
        $nsi->updateReferencesList();
        $nsi->updateReference($registryNumber);

        /**
         * @var NSIStorage $nsiStorage
         */
        $nsiStorage = \Yii::$app->get('nsiStorage');

        $firstElement = array_values($nsiStorage->references[$registryNumber]->elements)[0];
        $columns = [[
            'label' => 'Код',
            'headerOptions' => [
                'width' => '5rem'
            ],
            'format' => 'raw',
            'value' => function (NSIElement $element) {
                return $element->code;
            }
        ]];

        if (!empty($firstElement)) {
            foreach ($firstElement->fields as $template) {
                $columns[] = [
                    'label' => $template->Name,
                    'format' => 'raw',
                    'value' => function (NSIElement $element) use ($template) {
                        switch ($template::className()) {
                            case NsiElementStringFieldType::className():
                                /* @var NsiElementStringFieldType $field */
                                $field = $element->fields[$template->Name];
                                return $field->Value;
                                break;
                            case NsiElementBooleanFieldType::className():
                                /* @var NsiElementBooleanFieldType $field */
                                $field = $element->fields[$template->Name];
                                return $field->Value ? 'да' : 'нет';
                                break;
                            case NsiElementFloatFieldType::className():
                                /* @var NsiElementFloatFieldType $field */
                                $field = $element->fields[$template->Name];
                                return sprintf("%d", $field->Value);
                                break;
                            case NsiElementOkeiRefFieldType::className():
                                /* @var NsiElementOkeiRefFieldType $field */
                                $field = $element->fields[$template->Name];
                                $okei = Okei::getByCode($field->Code);
                                return $okei ? $okei->title : $field->Code;
                                break;
                            default:
                                $field = $element->fields[$template->Name];
                                return '<pre>' . json_encode($field, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . '</pre>';
                        }
                    }
                ];
            }
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $nsiStorage->references[$registryNumber]->elements,
        ]);


        return $this->render('view', [
            'reference' => @$nsiStorage->references[$registryNumber],
            'dataProvider' => $dataProvider,
            'columns' => $columns
        ]);

    }
}