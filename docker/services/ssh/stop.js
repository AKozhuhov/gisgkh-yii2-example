#!/usr/bin/env node

var steps = [
    {
        'message' : 'Останавливаем ssh',
        'commands' : ['service ssh stop']
    }
];

require('shell-done')(steps);
