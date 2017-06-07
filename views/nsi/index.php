<?php

use gisgkh\types\NsiBase\NsiItemInfoType;
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
        Выборка делается через сервис экспорта общесистемных справочников НСИ API ГИС ЖКХ динамически (при каждом обновлении страницы)
    </p>
    <p>
        <a class="btn btn-default" href="#" onclick="$('.i-code-example').toggle()">Посмотреть исходный код с комментариями</a>
        <a class="btn btn-default" href="http://gisgkh-api.open-gkh.ru/NsiCommonService/" target="_blank">Документация на сервис</a>
    </p>
    <div class="i-code-example" style="display: none;">
        <p>
            Контроллер, делающий выборку справочников НСИ:
            <pre><?= highlight_string(file_get_contents(\Yii::getAlias('@app/controllers/NsiController.php')), true)?></pre>
        </p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert"><?= $error ?></div>
    <?php endif; ?>

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
                'header' => 'Реестровый номер',
                'headerOptions' => [
                    'width' => '5rem'
                ],
                'format' => 'raw',
                'value' => function (NsiItemInfoType $nsiItem) {
                    return $nsiItem->RegistryNumber;
                }
            ],
            [
                'header' => 'Название справочника',
                'format' => 'raw',
                'value' => function (NsiItemInfoType $nsiItem) {
                    return Html::a($nsiItem->Name, '/nsi/' . $nsiItem->RegistryNumber);
                }
            ],
            [
                'header' => 'Дата обновления',
                'format' => 'raw',
                'value' => function (NsiItemInfoType $nsiItem) {
                    return \Yii::$app->formatter->asDate($nsiItem->Modified, 'short');
                }
            ]
        ]
    ]);?>
</div>
