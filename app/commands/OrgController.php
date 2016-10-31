<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use opengkh\gis\models\common\GisOrganization;
use yii\console\Controller;
use yii\helpers\ArrayHelper;


class OrgController extends Controller
{
    /**
     * @param string $ogrn
     */
    public function actionByOgrn($ogrn = '1037739877295')
    {
        $gisOrg = GisOrganization::searchByOgrn($ogrn);
        print_r($gisOrg);
    }
}
