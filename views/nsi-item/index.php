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

?>

<div class="body-content">

    <h1><?= $this->title ?></h1>

    <p>
        Перечень элементов справочникка формируется через сервис экспорта общесистемных справочников НСИ API ГИС ЖКХ динамически (при каждом обновлении страницы)
    </p>

    <p>
        <a class="btn btn-default" href="#" onclick="$('.i-code-example').toggle()">Посмотреть исходный код с комментариями</a>
        <a class="btn btn-default" href="http://gisgkh-api.open-gkh.ru/NsiCommonService/" target="_blank">Документация на сервис</a>
    </p>
    <div class="i-code-example" style="display: none;">
        <p>
            Контроллер, делающий выборку элементов справочника НСИ:
            <pre><?= highlight_string(file_get_contents(\Yii::getAlias('@app/controllers/NsiItemController.php')), true)?></pre>
        </p>
    </div>

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
