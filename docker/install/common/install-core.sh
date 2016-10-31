#!/usr/bin/env bash

RED='\033[0;31m'
GREEN='\033[0;32m'
NC='\033[0m'

echo -e "
#
# ${RED}Startup-lab DVP environment installation script${NC}
#
# - fixes and updates
# - utilities (like sudo, curl, wget etc...)
# - Git
# - Node.js and global packages (Mocha, Bower, Foundation-cli
# - Imagemagick
# - PostgreSQL
# - Memcached
# - root interface tweaks (Vim and Bash)
#
# For Debian 8.5 jessie:
#
#     docker pull debian:jessie
#
# Author: Maxim Korshunov <korshunov.m.e@gmail.com>
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
${GREEN}-- Install Git --${NC}
"

set -x
apt-get -y -q -o Dpkg::Use-Pty=0 install git
set +

echo -e "
${GREEN}-- Build curl from sources (with patch) --${NC}
"

set -x
CURL_VERSION=7_50_0

apt-get -y -q -o Dpkg::Use-Pty=0 install \
make autoconf gcc bison g++ pkg-config build-essential libtool libcurl4-openssl-dev

cd /home/dvp/host
if [ ! -d curl-src ]; then
    git clone git@github.com:curl/curl.git curl-src
fi
cd curl-src
git checkout curl-${CURL_VERSION}
if [ -f Makefile ]; then
    make distclean
fi
git clean -xdf
./buildconf
./confugure --with-ssl
make
make install
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
apt-get -y -q -o Dpkg::Use-Pty=0 install ruby-full
gpg --keyserver hkp://keys.gnupg.net --recv-keys D39DC0E3
curl -sSL https://get.rvm.io | bash -s stable
source /etc/profile.d/rvm.sh
rvm install 2.2.4
rvm requirements
gem install -q sass
gem install -q bundler
gem install -q rake
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

echo
echo -e "${GREEN}-- Install BashIt and Ulrimate Vim for root --${NC}"
echo

set -x
git clone --depth=1 https://github.com/Bash-it/bash-it.git ~/.bash_it
~/.bash_it/install.sh
git clone https://github.com/amix/vimrc.git ~/.vim_runtime
sh ~/.vim_runtime/install_awesome_vimrc.sh
set +x

echo    "#"
echo -e "# ${RED}DONE!${NC}"
echo    "#"