<?php

use \yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\OgrnForm */
/* @var $org \opengkh\gis\models\common\GisOrganization */

$this->title = 'Пример 2: Поиск организации по ОГРН';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="body-content">

    <h1>Поиск организации по ОГРН</h1>

    <p>
        Поиск сведений об организации производится через API ГИС ЖКХ.
    </p>
    <p>
        <a class="btn btn-default" href="#" onclick="$('.i-code-example').toggle()">Посмотреть исходный код с комментариями</a>
    </p>

    <div class="i-code-example" style="display: none;">
    <p>
        Контроллер, выполняюший поиск с использованием модуля OpenGKH:
<pre>
namespace app\controllers;

use yii\web\Controller;
use opengkh\gis\models\common\GisOrganization;
use app\models\OgrnForm;

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
</pre>
    </p>
    </div>

    <hr/>

    <p>
        <?php $form = \yii\bootstrap\ActiveForm::begin([
            'method' => 'get'
        ])?>

        <?= $form->field($model, 'ogrn')->textInput()->hint('Примеры: 1234567890123, 1037739877295') ?>

        <?= Html::submitButton('Найти') ?>

        <?php \yii\bootstrap\ActiveForm::end() ?>
    </p>

    <?php if ($model->ogrn): ?>
    <p>
        <?php if (empty($org)): ?>
            <div class="alert alert-info" role="alert">Ничего не найдено :(</div>
        <?php else: ?>
            <pre>
<?= json_encode(\yii\helpers\ArrayHelper::toArray($org), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>
            </pre>
        <?php endif; ?>
    </p>
    <?php endif; ?>
</div>
