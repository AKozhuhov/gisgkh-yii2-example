#!/usr/bin/env node

var fs = require('fs');
var settings = {};

try {
    settings = require('./local');
} catch (e) {
    console.log(e);
    settings = require('./common');
}

fs.writeFileSync(__dirname + '/settings.json', JSON.stringify(settings));

module.exports = settings;