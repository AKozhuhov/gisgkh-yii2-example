#!/usr/bin/env node

var settings = require('./common');

// uncomment and edit lines below if you need to change common config

// settings.docker.from = 'debian:jessie';

settings.application.source.path = '/opengkh/yii2-gisgkh-example';

// settings.user.id = 1000
// settings.user.gid = 1000
// settings.user.homeDir =

// var ip =
// settings.docker.expose.ssh.ip = ip
settings.docker.expose.ssh.port = 1029;
// settings.docker.expose.web.ip = ip
settings.docker.expose.web.port = 8082;

// etc...

module.exports = settings;