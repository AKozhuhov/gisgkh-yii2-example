#!/usr/bin/env node

var settings = require('./settings.json');

// @todo: remove project specific names, just deploy all .conf files from configs/nginx/conf.d/ or add to nginx.conf this search path

var steps = [
    {
        'message' : 'NGINX: Установка базового конфигурационного файла',
        'commands' : [
            'mv /etc/nginx/nginx.conf /etc/nginx/nginx.conf.bak',
            'ln -s ' + settings.application.source.dockerPath + '/docker/install/configs/nginx/nginx.conf /etc/nginx/nginx.conf'
        ]
    },
    {
        'message' : 'NGINX: symlink-и на конфиги виртуальных узлов',
        'commands' : [
            'ln -s ' + settings.application.source.dockerPath + '/docker/install/configs/nginx/conf.d/opengkh.nginx /etc/nginx/conf.d/opengkh.conf',
        ]
    }
];

require('shell-done')(steps);