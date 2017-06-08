<?php

namespace app\controllers;

use yii\base\Exception;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

use gisgkh\Helper;
use gisgkh\services\NsiService;
use gisgkh\types\NsiBase\NsiItemInfoType;
use gisgkh\types\NsiCommon\exportNsiListRequest;


/**
 * Перечень справочников НСИ
 */
class NsiController extends Controller
{
    public function actionIndex()
    {
        $error = null;
        /* @var NsiItemInfoType[] $result */
        $result = [];

        // создание сервиса экспорта общесистемных справочников НСИ
        $service = new NsiService(\Yii::$app->params['opengkh']);

        // формирование критериев выборки
        $request = new exportNsiListRequest();
        $request->Id = Helper::guid();
        $request->ListGroup = 'NSI';

        try {
            // выполнение зароса к SOAP методу
            $response = $service->exportNsiList($request);

            if (empty($response->ErrorMessage)) {
                // получение переченя справочников из ответа SOAP метода
                $result = $response->NsiList->NsiItemInfo;
            } else {
                // обработка ошибок контролей или бизнес-процесса
                $error = "{$response->ErrorMessage->ErrorCode}: {$response->ErrorMessage->Description}";
            }
        } catch (\Exception $e) {
            // обработка критических ошибок, таких как SoapFault
            $error = $e->getMessage();
        }

        usort($result, function (NsiItemInfoType $a, NsiItemInfoType $b) {
           return $a->RegistryNumber < $b->RegistryNumber ? -1 : ($a->RegistryNumber > $b->RegistryNumber ? 1 : 0);
        });

        $dataProvider = new ArrayDataProvider([
            'allModels' => $result,
        ]);

        $dataProvider->pagination->pageSize = 100;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'error' => $error
        ]);
    }
}