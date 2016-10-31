# Пример приложения с модулем [opengkh/yii2-gisgkh](https://github.com/opengkh/yii2-gisgkh) 

Приложение создано на базе шаблона [Yii 2 Basic Project Template](https://github.com/yiisoft/yii2-app-basic).

## Поключение модуля opengkh/yii2-gisgkh

Модуль подключен через менеджер зависимостей composer. Настройка подключения в файле [`composer.json`](composer.json):

```json
    "repositories": [
        {
            "url": "https://github.com/opengkh/yii2-gisgkh.git",
            "type": "git"
        }
    ],
    "require": {
        "opengkh/yii2-gisgkh": "*"
    },
```

## Настройки модуля

Настройки модуля определены в файлах кофигурации `config/console.php` (для консольных команд) и `config/web.php` (для веб-приложения):
 
```
    'bootstrap' => [..., 'gisgkh'],
    'modules' => [
        'gisgkh' => [
            'class' => 'opengkh\gis\Module',
            'version' => '10.0.2.3',
            'sslCert' => '@app/config/rgd20161023.pem',
            'sslKey' => '@app/config/rgd20161023.pem',
            'caInfo' => '@app/config/cacert3.pem',
            'username' => '<http-login>',
            'password' => '<http-password>',
            'ip' => '217.107.108.147',
            'port' => '10081',
            'SenderId' => null,
            'orgPPAGUID' => '4e254e2a-98a2-4006-af79-cee92cbec248'
        ]
    ],
```

Параметры `sslCert` и `sslKey` определяют расположение сертификата и ключа информационной системы. Сам ключ в приложение не входит, его нужно получать самостоятельно.
 
Описание остальных параметров можно найти в [документации к модулю](https://github.com/opengkh/yii2-gisgkh/blob/master/README.md). 

## Демонстрационный функционал

1. Консольная команда `./yii org/by-ogrn`

Выводит сведения об организации из ГИС ЖКХ по её ОГРН.

Код контроллера:

```
    public function actionByOgrn($ogrn = '1037739877295')
    {
        $gisOrg = GisOrganization::searchByOgrn($ogrn);
        print_r($gisOrg);
    }
```

2. ...
