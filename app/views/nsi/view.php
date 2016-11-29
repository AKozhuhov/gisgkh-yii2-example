<?php

use \yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider */
/* @var $reference \app\nsi\NSIReference*/
/* @var $columns array */

$this->title = $reference->title;
$this->params['breadcrumbs'][] = ['label' => 'Пример 1: Нормативно-справочная информация (НСИ)', 'url' => '/nsi'];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="body-content">

    <h1><?= $reference->title ?></h1>

    <p>
        Перечень элементов справочникоа получается через API ГИС ЖКХ динамически (при каждом обновлении страницы)
    </p>

    <?= $this->render('annotation'); ?>

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
