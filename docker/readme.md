# Что в докере:

ОС: ubuntu/debian

Для интеграции с ГИС ЖКХ:

* php7.1 (soap, gmp, curl, intl)
* curl
* openssl + gost

Для запуска тестового приложения:

* nginx

Дополнтельно:

* composer, composer-asset-plugin
* git


# Установка и запуск докера

Настройки локального окружения:

* **ip** локальный IP адрес, 192.168.*
* **path** путь к приложению 
* **port** web-порт (по-умолчанию 8080)
* **uid** ID пользователя **dvp** (по-умолчанию 1000)
* **gid** ID группы **dvp** (по-умолчанию 1000)

docker build 


1. Сценарий использования без докера:
 - проверить требования
    php7.1 + модули
    openssl, curl (проверка `curl --engine list | grep gost`)
    composer, composer-asset-plugin
 - клонировать пример
 - выполнить `composer install`
 - запустить сервер, например через `php -S localhost:8080` (из папки web)

2. сценарий с использованием докера
 - проверить требования
    docker
 - клонировать пример
 - если есть php выполнить `./docker/start.php`
 - если нет php, то собрать и запустить docker вручную
    `docker build --no-cache -rm -t rucode/gisgkh-soap-php:local`
    `docker run -d -h gisgkh-soap-php -v '{source-path}:/example' -p '{local-ip}:8080:80' --name=gisgkh-soap-php rucode/gisgkh-soap-php:local`

 



