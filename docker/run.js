#!/usr/bin/env node

/**
 * Запуск Docker-а (консольная утилита)
 *
 * Справка по аргументам: ./run.js -h
 *
 * @author Maxim Korshunov <korshunov.m.e@gmail.com>
 */

/**/
var sh  = require('shelljs');
var shelldone  = require('shell-done');
var os  = require('os');
var fs  = require('fs');
var argv = require('yargs')
    .help('h')
    .option('f', {
        alias: 'force',
        describe: 'удалить текущий контейнер, если он есть',
        default: false
    })
    .option('c', {
        alias: 'clean',
        describe: 'without additional scripts',
        default: false
    })
    .argv;

var settings = require('./settings/settings');

/**********************************************************************************************************************/
console.log('\n-- ПРОВЕРКА КОНТЕЙНЕРА --\n');

var containerId = sh.exec('docker ps -a -q -f "ancestor=' + settings.docker.imageName + '"', {silent: true}).stdout.trim();

if (containerId) {
    if (argv.f) {
        console.log('Удаление контейнера ' + containerId);
        var dockerRmCommand = 'docker rm -f ' + containerId;

        console.log(dockerRmCommand);
        sh.exec(dockerRmCommand);
    } else {
        console.log('Контейнер для образа ' + settings.docker.imageName + ' уже создан');
        console.log('Для принудительного удаления контейнера укажите опцию -f или --force');
        shelldone([{
            'message' : 'ЗАПУСК КОНТЕЙНЕРА',
            'commands' : [
                'docker start ' + containerId
            ]
        }]);
        return;
    }
} else {
    console.log('Удаление контейнера не требуется');
}

/**********************************************************************************************************************/
console.log('\n-- ЗАПУСК КОМАНДЫ docker run --\n');

var command =
    'docker run -t --privileged ' +
    '   --name=' + settings.docker.containerName +
    '   --log-driver=syslog ' +
    '   -h ' + settings.docker.containerName;

command += ' -v ' + settings.application.source.path + ':' + settings.application.source.dockerPath;

settings.docker.mount.forEach(function (mount) {
    command += ' -v ' + mount.path + ':' + mount.dockerPath
});

Object.keys(settings.docker.expose).forEach(function (exposeKey) {
    command +=
        " -p " + settings.docker.expose[exposeKey].ip +
        ':' + settings.docker.expose[exposeKey].port +
        ':' + settings.docker.expose[exposeKey].dockerPort;
});

command += ' ' + settings.docker.imageName;

console.log(command);
console.log('^C to exit');

sh.exec(command);