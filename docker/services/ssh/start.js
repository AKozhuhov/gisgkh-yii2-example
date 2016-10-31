#!/usr/bin/env node

var steps = [
    {
        'message' : 'Запускаем ssh',
        'commands' : ['service ssh start']
    }
];

require('shell-done')(steps);
