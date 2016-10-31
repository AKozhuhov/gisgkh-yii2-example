#!/usr/bin/env node

var steps = [
    {
        'message' : 'Перезапускаем ssh',
        'commands' : ['service ssh restart']
    }
];

require('shell-done')(steps);
