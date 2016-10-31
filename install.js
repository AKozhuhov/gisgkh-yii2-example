#!/usr/bin/env node

var steps = [
    {
        'message' : 'Права на директории',
        'commands' : [
            'sudo chown dvp:dvp -R ' + __dirname + '/app',
            'sudo chown dvp:www-data -R ' + __dirname + '/app/runtime',
            'sudo chmod g+w -R ' + __dirname + '/app/runtime',
            'sudo chown dvp:www-data -R ' + __dirname + '/app/web/assets',
            'sudo chmod g+w -R ' + __dirname + '/app/web/assets'
        ]
    },
    {
        'message' : 'Установка зависимостей',
        'commands' : [
            'cd ' + __dirname + '/app && composer install'
        ]
    },
    {
        'message' : 'Права на директории',
        'commands' : [
            'sudo chown dvp:dvp -R ' + __dirname + '/app',
            'sudo chown dvp:www-data -R ' + __dirname + '/app/runtime',
            'sudo chmod g+w -R ' + __dirname + '/app/runtime',
            'sudo chown dvp:www-data -R ' + __dirname + '/app/web/assets',
            'sudo chmod g+w -R ' + __dirname + '/app/web/assets'
        ]
    }
];

require('shell-done')(steps);
