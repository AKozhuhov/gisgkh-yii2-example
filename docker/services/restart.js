#!/usr/bin/env node

var steps = [
    {
        'commands' : [
            __dirname + '/php/restart.js',
            __dirname + '/nginx/restart.js',
            __dirname + '/ssh/restart.js'
        ]
    }
];

require('shell-done')(steps);

