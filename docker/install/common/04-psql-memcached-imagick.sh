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
# STEP 4 -- psql-memcached-imagick:
# - PostgreSQL
# - Memcached
# - Imagemagick
#
# Prerequisites:
# - 03-nodejs-ruby
#
#   docker pull startuplab/rias-gkh-dvp:03
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

echo
echo -e "${GREEN}-- Install Imagemagick --${NC}"
echo

set -x
apt-get -y -q -o Dpkg::Use-Pty=0 install imagemagick
set +x

echo
echo -e "${GREEN}-- Install PostgreSQL --${NC}"
echo

set -x
apt-get -y -q -o Dpkg::Use-Pty=0 install postgresql-9.4 postgresql-client-9.4
set +x

echo
echo -e "${GREEN}-- Install Memcached --${NC}"
echo

set -x
apt-get -y -q -o Dpkg::Use-Pty=0 install memcached
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
# $ docker commit -m '04-psql-memcached-imagick' -a \"${AUTHOR}\" rias-dvp startuplab/rias-gkh-dvp:04
#
# "