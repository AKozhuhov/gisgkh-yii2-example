<?php

use \yii\helpers\Html;

/* @var $this yii\web\View */

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Модуль интеграции с ГИС ЖКХ</h1>

        <h2>Демонстрационное приложение</h2>

        <br/>
        <p>
            <a class="btn btn-default" href="https://github.com/opengkh/gisgkh-yii2-example">
                Исходный код на GitHub
            </a>
        </p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h2>Подключение к ГИС ЖКХ</h2>
                <p>
                    Приложение подключено к тестовому стенду ГИС ЖКХ <?= Html::a('СИТ-1', 'https://217.107.108.147/ ') ?>
                </p>
                <p>
                    Для установления соединения используется ключ тестовой ИС. Ключ также доступен в составе исходного кода,
                    поэтому пример может быть легко воспроизведён.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h2>Пример 1: НСИ</h2>

                <p>
                    Получение полного перечня справочников НСИ ГИС ЖКХ
                </p>

                <p><a class="btn btn-default" href="/nsi">Перейти к примеру &raquo;</a></p>
            </div>
            <div class="col-lg-6">
                <h2>Пример 2: Реестр организаций</h2>

                <p>
                    Получение сведений об организации по ОГРН

                </p>

                <p><a class="btn btn-default" href="/org">Перейти к примеру &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
