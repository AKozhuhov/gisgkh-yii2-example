<?php

use yii\web\View;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

use gisgkh\types\NsiBase\NsiItemType;

/* @var $this View */
/* @var $dataProvider ArrayDataProvider */
/* @var $nsiItem NsiItemType */
/* @var $columns array */
/* @var $registryNumber string */

$this->title = "Справочник НСИ № {$registryNumber}";
$this->params['breadcrumbs'][] = ['label' => 'Пример 1: Нормативно-справочная информация (НСИ)', 'url' => '/nsi'];
$this->params['breadcrumbs'][] = $this->title;

$soapLogPath = @\Yii::$app->params['opengkh']['debug_path'];
if (is_file($soapLogPath)) {
    $soapLog = file_get_contents($soapLogPath);
    $soapLog = $soapLog ? (new GeSHi($soapLog, 'xml'))->parse_code() : null;
}

$sourceCode = (new GeSHi(file_get_contents(\Yii::getAlias('@app/controllers/NsiItemController.php')), 'php'))->parse_code();

$this->registerJs(<<<JS
    $('[data-toggle="popover"]').popover();
JS
    );
?>

<div class="body-content">

    <h1><?= $this->title ?></h1>

    <p>
        Перечень элементов справочникка формируется через сервис экспорта общесистемных справочников НСИ API ГИС ЖКХ динамически (при каждом обновлении страницы)
    </p>

    <p>
        <a class="btn btn-default" href="#" onclick="$('.i-code-example').toggle()">Посмотреть исходный код с комментариями</a>
        <?php if ($soapLog): ?>
            <a class="btn btn-default" href="#" onclick="$('.i-soap-log').toggle()">SOAP запрос / ответ</a>
        <?php endif; ?>
        <a class="btn btn-default" href="http://gisgkh-api.open-gkh.ru/NsiCommonService/" target="_blank">Документация на сервис</a>
    </p>
    <div class="i-code-example" style="display: none;"><?= $sourceCode ?></div>
    <?php if ($soapLog): ?>
        <div class="i-soap-log" style="display: none;"><?= $soapLog ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert"><?= $error ?></div>
    <?php endif; ?>

    <hr/>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'tableOptions' => [
            'class' => 'table'
        ],
        'columns' => $columns
    ]);?>
</div>
