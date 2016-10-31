#!/usr/bin/env node

var steps = [
    {
        'commands' : [
            __dirname + '/php/start.js',
            __dirname + '/nginx/start.js',
            __dirname + '/ssh/start.js'
        ]
    }
];

require('shell-done')(steps);
