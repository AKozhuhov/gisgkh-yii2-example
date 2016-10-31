#!/usr/bin/env node

var steps = [
    {
        'message' : 'Останавливаем nginx',
        'commands' : ['service nginx stop']
    }
];

require('shell-done')(steps);
