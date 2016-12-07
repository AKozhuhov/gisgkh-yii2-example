# [opengkh/environment](https://hub.docker.com/r/opengkh/environment/)

## Требования

Для локальной установки окружения необходимо предварительно установить:

1. Node.js (не ниже 6-й версии) -- [инструкция по установке](https://nodejs.org/en/download/package-manager/)
2. Docker -- [инструкция по установке](https://docs.docker.com/engine/installation/)

## Установка

Сначала нужно создать файл локальных настроек. Для этого нужно скопировать файл [`settings/local.js.example`](settings/local.js.example) в `settings/local.js` и раскомментирвоать там нужные строки.

В настройках нужно указать путь к директории куда был клонирован проект:

```
settings.application.source.path = '/path/to/yii-opengkh-example';
```

Также можно задать некоторые другие индивидуальные настройки, чтобы контейнер не конфликтовал с локальным окружением, такие как:

- локальный ip адрес для привязки сервисов из докера
- порты, на которые будут отвечать сервисы из докера
- UID и GID для создания пользователя в докере (чтобы директории проекта были доступны на запись и на чтение, как в докере, так и в локальном окружении)

Для установки и запуска нужно выполнить:

```sh
cd /path/to/yii-opengkh-example/docker
npm install
npm run docker
npm run services
```

После первого запуска нужно также выполнить команду для настройки проекта и установки зависимостей:

```sh
npm run app-install
```

Если использовались настройки по-умолчанию и установка прошла успешно, то демо-приложение будет доступно по адресу `http://{local-ip}:8080`.

---

## Работа в докере

Для входа в консоль докера можно использовать команду:

`docker exec -it opengkh /bin/bash`

Для удобства в `~/.bash_aliases` можно добавить алиасы (`/path/to/yii-opengkh-example` нужно заменить на путь к директории проекта):

```
alias opengkh='docker exec -it -u dvp starday /bin/bash'
alias opengkh-run='cd /path/to/yii-opengkh-example/docker && npm run docker'
alias opengkh-services='cd /path/to/yii-opengkh-example/docker && npm run services-restart'
```

---

Утилиты для работы с докером (`-h` для получения справки по аргументам):

- `./build.js` - сбока образа
- `./run.js` - запуск контейнера
- `./execute.js` - выполнение комманды в контейнере

---
 
Лицензия: [http://open-gkh.ru/license.html](http://open-gkh.ru/license.html)
