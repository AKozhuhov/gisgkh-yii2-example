#!/usr/bin/env node

var steps = [
    {
        'commands' : [
            __dirname + '/php/stop.js',
            __dirname + '/nginx/stop.js',
            __dirname + '/ssh/stop.js'
        ]
    }
];

require('shell-done')(steps);
