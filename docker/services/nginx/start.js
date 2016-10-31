#!/usr/bin/env node

var steps = [
    {
        'message' : 'Запускаем nginx',
        'commands' : ['service nginx start']
    }
];

require('shell-done')(steps);
