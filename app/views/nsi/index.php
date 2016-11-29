<?php

use \yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider */

$this->title = 'Пример 1: Нормативно-справочная информация (НСИ)';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="body-content">

    <h1>Нормативно-справочная информация ГИС ЖКХ (НСИ)</h1>

    <p>
        Перечень справочников получается через API ГИС ЖКХ динамически (при каждом обновлении страницы)
    </p>

    <?= $this->render('annotation'); ?>

    <hr/>

    <h2>Перечень справочников</h2>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'tableOptions' => [
            'class' => 'table'
        ],
        'columns' => [
            [
                'attribute' => 'registryNumber',
                'headerOptions' => [
                    'width' => '5rem'
                ]
            ],
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function (\app\nsi\NSIReference $reference) {
                    return Html::a($reference->title, '/nsi/' . $reference->registryNumber);
                }
            ],
        ]
    ]);?>
</div>
