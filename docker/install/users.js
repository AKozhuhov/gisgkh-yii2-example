#!/usr/bin/env node

var settings = require('./settings.json');

var homeDir = '/home/dvp';

var steps = [
    {
        'message' : 'Добавляем группу dvp с ID ' + settings.user.primaryGroupId,
        'commands' : ['groupadd dvp -g ' + settings.user.primaryGroupId]
    },
    {
        'message' : 'Добавляем пользователя dvp с ID ' + settings.user.id + ' в группу dvp',
        'commands' : ['useradd dvp -u ' + settings.user.id + ' -g ' + settings.user.primaryGroupId]
    },
    {
        'message' : 'Добавляем www-data в группу dvp (чтобы nginx и php имели доступ к рабочим файлам) и наоборот',
        'commands' : [
            'usermod -G dvp www-data',
            'usermod -G www-data dvp',
        ]
    },
    {
        'message' : 'Даём пользователю dvp права на выполнение sudo без пароля',
        'commands' : [
            'echo "dvp ALL=NOPASSWD: ALL" > /etc/sudoers.d/startuplab',
            'echo "%dvp ALL=NOPASSWD: ALL" >> /etc/sudoers.d/startuplab',
            'chmod 700 /etc/sudoers.d/startuplab'
        ]
    },
    {
        'message' : 'Права на домашнюю директорию пользователя dvp',
        'commands' : [
            'chown dvp:dvp -R ' + homeDir,
            'chmod 600 /home/dvp/.ssh/*',
            'chmod 664 /home/dvp/.ssh/*.pub',
            'chmod 600 /home/dvp/.ssh/authorized_keys'
        ]
    },
    {
        'message' : 'Настраиваем vim и bash для dvp',
        'commands' : [
            'export HOME=' + homeDir + ' && sudo -H -u dvp git clone https://github.com/amix/vimrc.git ' + homeDir + '/.vim_runtime ',
            'export HOME=' + homeDir + ' && sudo -H -u dvp sh ' + homeDir + '/.vim_runtime/install_awesome_vimrc.sh',
            'export HOME=' + homeDir + ' && sudo -H -u dvp git clone --depth=1 https://github.com/Bash-it/bash-it.git ' + homeDir + '/.bash_it',
            'export HOME=' + homeDir + ' && sudo -H -u dvp echo "n" | ' + homeDir + '/.bash_it/install.sh',
            'export HOME=' + homeDir + ' && sudo -H -u dvp sed -i \'s/bobby/zork/g\' ' + homeDir + '/.bashrc',
            'cp /root/install/configs/profile.sh /etc/profile.d',
            'chsh -s /bin/bash dvp'
        ]
    }
];

require('shell-done')(steps);
