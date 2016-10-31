#!/usr/bin/env node

var steps = [
    {
        'message' : 'Запускаем php7.0',
        'commands' : ['service php7.0-fpm start']
    }
];

require('shell-done')(steps);
