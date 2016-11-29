#!/usr/bin/env node

var steps = [
    {
        'message' : 'PHP: Устанавливаем composer-asset-plugin для пользователя dvp',
        'commands' : ['sudo -H -u dvp composer global require "fxp/composer-asset-plugin:^1.2.0"']
    }
];

require('shell-done')(steps);
