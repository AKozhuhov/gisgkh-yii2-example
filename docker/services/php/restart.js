#!/usr/bin/env node

var steps = [
    {
        'message' : 'Перезапускаем php7.0',
        'commands' : ['service php7.0-fpm restart']
    }
];

require('shell-done')(steps);
