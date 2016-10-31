#!/usr/bin/env bash

RED='\033[0;31m'
GREEN='\033[0;32m'
NC='\033[0m'
SSH_KEY_NAME=hf-max
HOST_HOME=/home/dvp/host
AUTHOR="Maxim Korshunov <korshunov.m.e@gmail.com>"

echo -e "
#
# ${RED}Startup-lab DVP environment installation script${NC}
#
# STEP 3 -- Node.js + Ruby:
# - Node.js 6.x
# - Global node modules: mocha, bower, foundation-cli
# - RVM (ruby version manager)
# - Ruby 2.3.0
# - Ruby gems: saas, bundler, rake
#
# Prerequisites:
# - 02-curl-ssl
#
#   docker pull startuplab/rias-gkh-dvp:02
#
# - for github ssh access: copy your ssh key including private part with name ${SSH_KEY_NAME} to ${HOST_HOME}
#
# Author: ${AUTHOR}
# july 2017
#
# Execution date: $(date)
# "

echo -e "
${GREEN}-- Copy ssh key --${NC}
"

set -x
mkdir ~/.ssh
cp ${HOST_HOME}/${SSH_KEY_NAME}* ~/.ssh/
cd ~/.ssh/
eval `ssh-agent -s`
ssh-add ${SSH_KEY_NAME}
set +x

echo -e "
${GREEN}-- Install Node.js --${NC}
"

set -x
curl -sL https://deb.nodesource.com/setup_6.x | sudo -E bash -
sudo apt-get -y -q -o Dpkg::Use-Pty=0 install nodejs
set +x

echo
echo -e "${GREEN}-- Install global NPM packages: mocha, bower, foundation-cli --${NC}"
echo

set -x
npm install -g --silent mocha
npm install -g --silent bower
npm install -g --silent foundation-cli
set +x

echo -e "
${GREEN}-- Install Ruby 2.2.4 and gems (sass, bundler, rake) --${NC}
see: http://tecadmin.net/install-ruby-on-rails-on-ubuntu/#
"
set -x
gpg --keyserver hkp://keys.gnupg.net --recv-keys D39DC0E3
curl -sSL https://get.rvm.io | bash -s stable
set +x
. /etc/profile.d/rvm.sh
rvm requirements
rvm install 2.3.0
rvm --default use 2.3.0
gem install -q sass
gem install -q bundler
gem install -q rake
set -x
# RVM creates own group with GID 1000
# for further using of docker this GID should be changed because this is usually GID of current user primary group
# howto: http://unix.stackexchange.com/questions/33844/change-gid-of-a-specific-group/33874#33874
groupmod -g 999 rvm
find / -gid 1000 ! -type l -exec chgrp 999 {} \;
echo ". /etc/profile.d/rvm.sh" >> /etc/bash.bashrc
set +x

echo -e "
${GREEN}-- Remove ssh key --${NC}
"

set -x
rm -f ~/.ssh/${SSH_KEY_NAME}*
set +x

echo -e "
#
# ${RED}DONE!${NC}
# Commit the image:
#
# $ exit
# $ docker commit -m '03-nodejs-ruby' -a \"${AUTHOR}\" rias-dvp startuplab/rias-gkh-dvp:03
#
# "