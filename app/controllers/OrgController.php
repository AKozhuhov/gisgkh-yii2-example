<?php

namespace app\controllers;

use app\models\OgrnForm;
use opengkh\gis\models\common\GisOrganization;
use yii\web\Controller;

/**
 * Получение информации об организации по ОГРН
 */
class OrgController extends Controller
{
    public function actionIndex()
    {
        $model = new OgrnForm();

        $org = null;
        if ($model->load(\Yii::$app->request->get()) && $model->validate()) {
            // поиск в реестре организаций по ОГРН
            $org = GisOrganization::searchByOgrn($model->ogrn);
        }

        return $this->render('index', [
            'model' => $model,
            'org' => $org
        ]);
    }
}