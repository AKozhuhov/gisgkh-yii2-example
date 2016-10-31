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
# STEP 2 -- curl + ssl:
# - deploy ssl config with GOST support
# - build curl form sources
#
# Prerequisites:
# - 01-init
#
#   docker pull startuplab/rias-gkh-dvp:01
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
${GREEN}-- OpenSSL configuration (to support GOST) -- ${NC}
"

set -x
mv /etc/ssl/openssl.cnf /etc/ssl/openssl.cng.bak
cp /opengkh/docker/install/common/configs/ssl/openssl.cnf /etc/ssl/openssl.cnf
set +x

echo -e "
${GREEN}-- Build curl from sources (with patch) --${NC}
"

set -x
CURL_VERSION=7_50_0

apt-get -y -q -o Dpkg::Use-Pty=0 install \
make autoconf gcc bison g++ pkg-config build-essential libtool libssl-dev

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
./configure --with-ssl
make
make install

apt-get install libcurl4-openssl-dev
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
# $ docker commit -m '02-curl-ssl' -a \"${AUTHOR}\" rias-dvp startuplab/rias-gkh-dvp:02
#
# "