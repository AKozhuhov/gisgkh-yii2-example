# [opengkh/environment](https://hub.docker.com/r/opengkh/environment/)

## Требования

Для локальной установки окружения необходимо предварительно установить:

1. Node.js -- [инструкция по установке](https://nodejs.org/en/download/package-manager/)
2. Docker -- [инструкция по установке](https://docs.docker.com/engine/installation/)

## Установка

Перед тем как запустить сборку докера может потребоваться задать некоторые параметры, 
которые зависят от локального окружения, такие как:

- локаьный ip адрес для привязки сервисов из докера
- порты, на которые будут отвечать сервисы из докера
- UID и GID для создания пользователя в докере (чтобы директории проекта были доступны на запись и на чтение, как в докере, так и в локальном окружении)

Для задания настроек нужно скопировать файл [`settings/local.js.example`](settings/local.js.example) в `settings/local.js` и отредактировать его.

Для установки и запуска нужно выполнить:

```sh
cd /path/to/yii-opengkh-example/docker
npm install
npm run docker
npm run services
```

После первого запуска нужно также выполнить команды для настройки проекта и установке зависимостей:

```
npm run db-install
npm run site-install
```

## Работа в докере

Для входа в консоль контейнера можно использовать команду:

`docker exec -it starday /bin/bash`

Для удобства в `~/.bash_aliases` можно добавить алиасы (`/path/to/yii-opengkh-example` нужно заменить на путь к директории проекта):

```
alias starday='docker exec -it -u dvp starday /bin/bash'
alias starday-run='cd /path/to/yii-opengkh-example/docker && npm run docker'
alias starday-services='cd /path/to/yii-opengkh-example/docker && npm run services-restart'
```

---

**Важно!** При использовании докера вся работа с завистимостями 
и сборка проекта должны выполняться в контейнере.

---

Утилиты для работы с докером (`-h` для получения справки по аргументам):

- `./build.js` - сбока образа
- `./run.js` - запуск контейнера
- `./execute.js` - выполнение комманды в контейнере
