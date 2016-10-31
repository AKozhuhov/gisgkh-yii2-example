#!/usr/bin/env node

/**
 * Выполнение комманды в докере (консольная утилита)
 *
 * Справка по аргументам: ./execute.js -h
 *
 * @author Maxim Korshunov <korshunov.m.e@gmail.com>
 */

/**
 * @type {Argv}
 */
var argv = require('yargs')
    .help('h')
    .default('u', 'dvp')
    .option('c', {
        alias: 'command',
        describe: 'команда, которую нужно выполнить'
    })
    .option('u', {
        alias: 'user',
        describe: 'имя пользователя, от лица которого будет выполнена комманда'
    })
    .option('m', {
        alias: 'message',
        describe: 'комментарий к комманде (будет выведен в консоль)'
    })
    .demand(['c'])
    .argv;

var settings = require('./settings/settings');

var step = {
    'commands' : ['docker exec -i -u ' + argv.u + ' ' + settings.docker.containerName + ' ' + argv.c]
};

if (argv.m) {
    step.message = argv.m;
}

require('shell-done')([step]);
