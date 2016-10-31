#!/usr/bin/env node

var steps = [
    {
        'message' : 'Останавливаем php7.0',
        'commands' : ['service php7.0-fpm stop']
    }
];

require('shell-done')(steps);
