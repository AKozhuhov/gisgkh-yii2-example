<?php

use yii\web\View;
use yii\helpers\ArrayHelper;

use gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryResultType;

/**
 * @var View $this
 * @var string $ogrn
 * @var string $error
 * @var exportOrgRegistryResultType $orgData
 */

$this->title = 'Пример 2: Поиск организации по ОГРН';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="body-content">
    <h1>Поиск организации по ОГРН</h1>
    <p>
        Поиск сведений об организации производится через сервис RegOrgService API ГИС ЖКХ.
    </p>
    <p>
        <a class="btn btn-default" href="#" onclick="$('.i-code-example').toggle()">Посмотреть исходный код с комментариями</a>
        <a class="btn btn-default" href="http://gisgkh-api.open-gkh.ru/OrganizationsRegistryCommonService/" target="_blank">Документация на сервис</a>
    </p>
    <div class="i-code-example" style="display: none;">
        <p>
            Контроллер, выполняюший поиск организации по ОГРН:
            <pre><?= highlight_string(file_get_contents(\Yii::getAlias('@app/controllers/OrgController.php')), true)?></pre>
        </p>
    </div>
    <hr/>
    <p>
        <form method="get">
            <div class="form-group">
                <label for="ogrn">ОРГН</label>
                <input type="text" class="form-control" id="ogrn" placeholder="ОГРН" name="ogrn" value="<?= $ogrn ?>" aria-describedby="ogrn-help">
                <span id="ogrn-help" class="help-block">Примеры: 1234567890123, 1037739877295</span>
            </div>
            <button type="submit" class="btn btn-default">Найти</button>
        </form>
    </p>

    <?php if ($error): ?>
    <div class="alert alert-danger" role="alert"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($orgData): ?>
    <pre class="alert alert-success" role="alert"><?= json_encode(ArrayHelper::toArray($orgData), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></pre>
    <?php endif; ?>

    <?php if ($ogrn && empty($orgData) && empty($error)): ?>
    <div class="alert alert-info" role="alert">Ничего не найдено</div>
    <?php endif; ?>
</div>
