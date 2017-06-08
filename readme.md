# Пример приложения интеграции с ГИС ЖКХ на Yii2

Приложение достуно по адресу [demo.open-gkh.ru](http://demo.open-gkh.ru)

Данное приложение демонстрирует реализовацию взаимодействия с ГИС ЖКХ
через **SOAP API** на базе платформы [openGKH](http://open-gkh.ru):
- установление защищенного соединения с использованием алгоритмов шифрования ГОСТ
- подписание запросов с помощью ЭЦП
- формирование запроса и разбор ответа
- обработка ошибок контролей или бизнес-процесса 

В приложение включены классы обработки 2-х soap сервисов ГИС ЖКХ:
- [Сервис импорта сведений в реестр организаций](http://gisgkh-api.open-gkh.ru/OrganizationsRegistryCommonService/)
- [Сервис экспорта общих справочников подсистемы НСИ](http://gisgkh-api.open-gkh.ru/NsiCommonService/)

Классы для работы со [всеми остальными сервисами](http://gisgkh-api.open-gkh.ru/), включая серфис файлового обмена,
можно приобрести по запросу. Контакты на сайте [openGKH](http://open-gkh.ru/).

## Как развернуть приложение в своей инфраструктуре
 
1. проверить требования

    - **php7.1** с модулями **soap**, **gmp**, **curl**
    - **curl** с поддержкой ГОСТ через **openssl** (проверка `curl --engine list | grep gost`)
    - [composer](https://getcomposer.org/download/)
    - [composer-asset-plugin](https://packagist.org/packages/fxp/composer-asset-plugin)
        
2. клонировать этот репозиторий
3. выполнить в директории с примером `composer install`
4. запустить сервер, например через `php -S localhost:8080` (из папки `web`)

## Как развернуть приложение с помощью Docker

1. установить [Docker](https://docs.docker.com/engine/installation/) *
2. клонировать этот репозиторий
3. выполнить команду `run` ** из этого репозитория   

```
cd {source-path}
./run
```

\* желательно сразу после установки добавить текущего пользователя в группу `docker` чтобы команда `docker` была доступна для текущего пользователя без `sudo` 

** если нет php, то собрать и запустить docker можно вручную, например так
    
```
cd {source-path}/docker
docker build --no-cache -rm -t opengkh/gisgkh-soap-php:local`
docker run -d -h gisgkh-soap-php -v '{source-path}:/example' -p '{local-ip}:8080:80' --name=gisgkh-soap-php opengkh/gisgkh-soap-php:local`
```

*** в примере выше приложение разворачивается на порту `8080`, 
если этот порт у вас уже занят можно выбравть любой другой. 
В комманде `run` для этого достаточно указать параметр `-p` или `--port`

```
./run --port={my-port-number}
```

Полный перечень параметров комадны `run` можно получить через `./run --help`


---
 
Лицензия: [http://open-gkh.ru/license.html](http://open-gkh.ru/license.html)
