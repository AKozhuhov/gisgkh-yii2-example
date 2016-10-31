#!/usr/bin/env node

/**
 * Создание образа Docker (консольная утилита)
 *
 * Справка по команде: ./build.js -h
 *
 * @author Maxim Korshunov <korshunov.m.e@gmail.com>
 */

var sh = require('shelljs');
var fs = require('fs');
var util = require('util');

/**
 * COMMAND LINE ARGUMENTS
 */

/**
 * @type {Argv}
 */
var argv = require('yargs')
    .help('h')
    .option('c', {
        alias: 'clean',
        describe: 'чистый контейнер, без выполнения скриптов по настройке проекта',
        default: false
    })
    .option('f', {
        alias: 'force',
        describe: 'удалить текущий контейнер и образ',
        default: false
    })
    .option('u', {
        alias: 'update',
        describe: 'обновить родительский образ',
        default: false
    })
    .option('r', {
        alias: 'run',
        describe: 'запустить контейнер после сборки',
        default: false
    })
    .argv;

console.log('\n-- ЗАГРУЗКА НАСТРОЕК --\n');

var settings = require('./settings/settings');
console.log(util.inspect(settings, false, null));

/**
 * CLEAN DOCKER CONTAINER AND IMAGE
 */

console.log('\n-- ПРОВЕРКА ОБРАЗА И КОНТЕЙНЕРА В ЛОКАЛЬНОЙ БАЗЕ --\n');

var imageId = sh.exec('docker images -q ' + settings.docker.imageName, {silent: true}).stdout.trim();
var containerId = sh.exec('docker ps -a -q -f "ancestor=' + settings.docker.imageName + '"', {silent: true}).stdout.trim();

if (imageId) {
   if (argv.f) {
        if (containerId) {
            console.log('Удаление контейнера ' + containerId);
            var dockerRmCommand = 'docker rm -f ' + containerId;
            
            console.log(dockerRmCommand);
            sh.exec(dockerRmCommand);
        }
        console.log('Удаление образа ' + imageId);
        var dockerRmiCommand = 'docker rmi -f ' + imageId;

        console.log(dockerRmiCommand);
        sh.exec(dockerRmiCommand);
    } else {
        console.log('Образ ' + settings.docker.imageName + ' уже есть в локальной базе');
        console.log('Для принудительного удаления образа и контейнера укажите опцию -f или --force');
        return;
    }
} else {
    console.log('Удаление образа не требуется');
}

/**
 * CLEAN ROOT DOCKER IMAGE
 */

if (argv.u) {
    console.log('\n-- ОБНОВЛЕНИЕ БАЗОВОГО ОБРАЗА В ЛОКАЛЬНОЙ БАЗЕ --\n');

    var ancestorImageId = sh.exec('docker images -q ' + settings.docker.from, {silent: true}).stdout.trim();
    var ancestorContainerId = sh.exec('docker ps -a -q -f "ancestor=' + settings.docker.from + '"', {silent: true}).stdout.trim();

    console.log('Удаление промежуточных дочерних образов без меток');
    // WARNING: this will affect ALL dangling (untagged) images, not only for this project
    // @todo: find more accurate way to remove child images if they exists (to force base image removing)
    var dockerRmiDanglingComand = "docker rmi $(docker images -f \"dangling=true\" -q)";
    console.log(dockerRmiDanglingComand);
    sh.exec(dockerRmiDanglingComand);

    if (ancestorImageId) {
        if (ancestorContainerId) {
            console.log('Удаление контейнера ' + ancestorContainerId);
            dockerRmCommand = 'docker rm -f ' + ancestorContainerId;

            console.log(dockerRmCommand);
            sh.exec(dockerRmCommand);
        }
        console.log('Удаление образа ' + ancestorImageId);
        dockerRmiCommand = 'docker rmi -f ' + ancestorImageId;

        console.log(dockerRmiCommand);
        sh.exec(dockerRmiCommand);
    } else {
        console.log('Удаление образа не требуется');
    }
}

/**
 * BUILDING Dockerfile
 */

console.log('\n-- СОЗДАНИЕ Dockerfile --\n');

var dockerFile =
    "FROM " + settings.docker.from + "\n" +
    "MAINTAINER " + settings.docker.maintainer + "\n";

if (!argv.c) {
    settings.docker.add.forEach(function (item) {
        dockerFile += "ADD " + item.path + " " + item.dockerPath + "\n";
    });

    try {
        fs.accessSync(__dirname + '/ssh', fs.F_OK);
        dockerFile += "ADD ssh /home/dvp/.ssh\n";
    } catch (e) {}

    settings.docker.run.forEach(function (command) {
        dockerFile += "RUN " + command + "\n";
    });
}

var exposedPorts = '';
Object.keys(settings.docker.expose).forEach(function (exposeKey) {
     exposedPorts += " " + settings.docker.expose[exposeKey].dockerPort;
});

if (exposedPorts) {
    dockerFile += "EXPOSE" + exposedPorts + "\n";
}

// http://developers.redhat.com/blog/2014/05/05/running-systemd-within-docker-container/
dockerFile += "CMD [\"/sbin/init\"]\n";

fs.writeFileSync('./Dockerfile', dockerFile);

console.log(dockerFile);


/**
 * BUILD DOCKER IMAGE
 */

console.log('\n-- ЗАПУСК КОМАНДЫ docker build --\n');

var dockerCommand = "docker build " +
    "--no-cache --rm " +
    "-t " + settings.docker.imageName + ' .';

console.log(dockerCommand);

sh.exec(dockerCommand, {async: true}, function (code, stdout, stderr) {
    console.log('\nDocker build exit code: ' + code);

    if (argv.r) {
        var runCommand = './run.js -f';
        if (argv.c) {
            runCommand += ' -c';
        }
        sh.exec(runCommand);
    }
});