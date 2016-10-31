#!/usr/bin/env node

var settings = require('./settings.json');

var steps = [
    {
        'message' : 'SHH: применяем настройки',
        'commands' : [
            'mv /etc/ssh/ssh_config /etc/ssh/ssh_config.bak',
            'ln -s ' + settings.application.source.dockerPath + '/docker/install/local/configs/ssh/ssh_config /etc/ssh/ssh_config'
        ]
    }
];

require('shell-done')(steps);
