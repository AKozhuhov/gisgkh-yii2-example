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
# STEP 1 -- init:
# - fixes and updates
# - utilities (like sudo, curl, wget etc...)
# - Git
# - root interface tweaks (Vim and Bash)
#
# Prerequisites:
# - Debian 8.5 jessie
#
#   docker pull debian:jessie
#
# - for github ssh access: copy your ssh key including private part with name ${SSH_KEY_NAME} to ${HOST_HOME}
#
# Author: ${AUTHOR}
# july 2017
#
# Execution date: $(date)
# "

echo -e "
${GREEN}-- System fixes, update & upgrate --${NC}
"

set -x
apt-get -y -q -o Dpkg::Use-Pty=0 update
apt-get -y -q -o Dpkg::Use-Pty=0 install dialog apt-utils locales
apt-get -y -q -o Dpkg::Use-Pty=0 upgrade
dpkg-reconfigure tzdata
# http://la2ha.ru/dev-seo-diy/unix/setting_locale_failed
echo "LANGUAGE=en_US.UTF-8" > /etc/default/locale
echo "LC_ALL=en_US.UTF-8" >> /etc/default/locale
echo "LANG=en_US.UTF-8" >> /etc/default/locale
echo "LC_TYPE=en_US.UTF-8" >> /etc/default/locale
locale-gen en_US.UTF-8
locale-gen ru_RU.UTF-8
dpkg-reconfigure locales
set +x

echo -e "
${GREEN}-- Install system utilities sudo, wget, vim, bzip2, telnet, openssh-server --${NC}
"

set -x
apt-get -y -q -o Dpkg::Use-Pty=0 install sudo wget vim  bzip2 telnet openssh-server
set +x

echo -e "
${GREEN}-- Enable ssh --${NC}
"

set -x
mkdir ~/.ssh
cp ${HOST_HOME}/${SSH_KEY_NAME}* ~/.ssh/
cd ~/.ssh/
eval `ssh-agent -s`
ssh-add ${SSH_KEY_NAME}
set +x

echo -e "
${GREEN}-- Install Git --${NC}
"

set -x
apt-get -y -q -o Dpkg::Use-Pty=0 install git
set +

echo -e "
${GREEN}-- Fix systemd --${NC}
"

set -x
# https://bugs.php.net/bug.php?id=69237
ln -s /lib/x86_64-linux-gnu/libsystemd-daemon.so.0 /lib/x86_64-linux-gnu/libsystemd-daemon.so
set +x


echo -e "
${GREEN}-- Install BashIt and Ulrimate Vim for root --${NC}
"

set -x
git clone --depth=1 https://github.com/Bash-it/bash-it.git ~/.bash_it
~/.bash_it/install.sh
git clone https://github.com/amix/vimrc.git ~/.vim_runtime
sh ~/.vim_runtime/install_awesome_vimrc.sh
sed -i 's/bobby/zork/g' ~/.bashrc
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
#
# Commit the image:
#
# $ exit
# $ docker commit -m '01-init' -a \"${AUTHOR}\" rias-dvp startuplab/rias-gkh-dvp:01
#
# "