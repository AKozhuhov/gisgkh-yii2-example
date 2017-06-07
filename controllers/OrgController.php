<?php

namespace app\controllers;

use yii\web\Controller;

use gisgkh\Helper;
use gisgkh\services\RegOrgService;
use gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryRequest;
use gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryResultType;

/**
 * Получение информации об организации по ОГРН
 */
class OrgController extends Controller
{
    public function actionIndex($ogrn = null)
    {
        /* @var exportOrgRegistryResultType[] $orgData */
        $orgData = [];
        $error = null;

        if ($ogrn) {
            // создание экземпляра сервиса обмена сведениями о поставщиках информации
            $service = new RegOrgService(\Yii::$app->params['opengkh']);

            // формирование критериев запроса
            $request = new exportOrgRegistryRequest();
            $request->Id = Helper::guid();
            $request->SearchCriteria = new exportOrgRegistryRequest\SearchCriteria();
            $request->SearchCriteria->OGRN = $ogrn;

            try {
                // выполнение зароса к SOAP методу
                $response = $service->exportOrgRegistry($request);
                if (empty($response->ErrorMessage)) {
                    // получение сведений об организациях из ответа SOAP метода
                    $orgData = $response->OrgData;
                } else {
                    // обработка ошибок контролей или бизнес-процесса
                    $error = "{$response->ErrorMessage->ErrorCode}: {$response->ErrorMessage->Description}";
                }
            } catch (\SoapFault $exception) {
                // обработка критических ошибок, таких как SoapFault
                $error = $exception->getMessage();
            }
        }

        return $this->render('index', [
            'ogrn' => $ogrn,
            'orgData' => $orgData,
            'error' => $error
        ]);
    }
}