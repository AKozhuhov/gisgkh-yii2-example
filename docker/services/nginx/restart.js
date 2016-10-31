#!/usr/bin/env node

var steps = [
    {
        'message' : 'Перезапускаем nginx',
        'commands' : ['service nginx restart']
    }
];

require('shell-done')(steps);
