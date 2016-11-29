#!/usr/bin/env node

var os = require('os');
var ip = require('ip');

module.exports = {
    application: {
        source: {
            path: '/opengkh',
            dockerPath: '/opengkh'
        }
    },
    user: {
        id: os.userInfo().uid,
        primaryGroupId: os.userInfo().gid,
        homeDir: os.homedir()
    },
    docker: {
        imageName: 'opengkh/environment:local',
        containerName: 'opengkh',
        from: 'opengkh/environment:latest',
        maintainer: "Maxim Korshunov \"korshunov.m.e@gmail.com\"",
        mount: [
            {
                path: os.homedir(),
                dockerPath: '/home/dvp/host'
            }
        ],
        add: [
            {
                path: 'install',
                dockerPath: '/root/install/'
            },
            {
                path: 'settings/settings.json',
                dockerPath: '/root/install/settings.json'
            },
            {
                path: 'package.json',
                dockerPath: '/root/install/package.json'
            }
        ],
        run: [
            'apt-get update -y',
            'cd /root/install && npm install',
            '/root/install/users.js',
            '/root/install/php.js',
            '/root/install/nginx.js',
            '/root/install/ssh.js'
        ],
        expose: {
            ssh: {
                ip: ip.address(),
                port: 1027,
                dockerPort: 22
            },
            web: {
                ip: ip.address(),
                port: 8080,
                dockerPort: 80
            }
        }
    }
};
