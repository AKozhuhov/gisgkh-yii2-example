#!/usr/bin/env bash

RED='\033[0;31m'
GREEN='\033[0;32m'
NC='\033[0m'

echo -e "
#
# ${RED}Startup-lab DVP environment installation script (PHP+NGINX)${NC}
#
# For core image:
#
#     docker pull staruplab/rias-gkh-dvp:core
#
# Author: Maxim Korshunov <korshunov.m.e@gmail.com>
# july 2017
#
# Execution date: $(date)
#
# Related articles:
#   - https://gist.github.com/tvlooy/881d0d67d0ad699c38a3
#   - https://bugs.php.net/bug.php?id=69510
#   - https://www.howtoforge.com/community/threads/ubuntu-correct-path-to-libxml2-when-configuring-php-5.9982/
#
#   - http://put.hk/article/news.php.net/php.bugs/186512/Bug-67588-Fbk-Csd-configure-fails-to-recognize-systemd-in-CentOS-7-0.html
#   - https://packages.debian.org/search?keywords=systemd
# "

echo -e "
${GREEN}-- PHP: config variables --${NC}
"

set -x
PHP_VERSION=7.0.8
TIMEZONE="Asia\/Yekaterinburg"
FPM_PORT=9000
FPM_USER=www-data
FPM_GROUP=www-data
APCU_VERSION=5.1.5
PHP_PATH=/opt/php/${PHP_VERSION}
set +x

echo -e "
${GREEN}-- OpenSSL configuration (to support GOST) -- ${NC}
"

set -x
mv /etc/ssl/openssl.cnf /etc/ssl/openssl.cng.bak
cp /rias/docker/install/common/configs/ssl/openssl.cnf /etc/ssl/openssl.cnf
set +x

echo -e "
${GREEN}-- PHP: install compilation dependencies --${NC}
"

set -x
apt-get -y -q -o Dpkg::Use-Pty=0 install \
libfcgi-dev libfcgi0ldbl libjpeg62-turbo-dbg libmcrypt-dev libc-client2007e libc-client2007e-dev \
libxml2-dev libbz2-dev libjpeg-dev libpng12-dev libfreetype6-dev libkrb5-dev libpq-dev libxml2-dev \
libxslt1-dev libpng12-dev libjpeg62-turbo-dev libxpm-dev libimlib2-dev libicu-dev libreadline6-dev libmcrypt-dev \
libsystemd-dev
set +x

echo -e "
${GREEN}-- PHP: clean directories (if PHP already installed) --${NC}
"

set -x
# PHP installation path
rm -rf /opt/php/${PHP_VERSION}
mkdir /opt/php/${PHP_VERSION}

# configs path
rm -rf /etc/php/${PHP_VERSION}
mkdir -p /etc/php/${PHP_VERSION}/conf.d
mkdir -p /etc/php/${PHP_VERSION}/cli/conf.d
mkdir -p /etc/php/${PHP_VERSION}/fpm/conf.d
mkdir -p /etc/php/${PHP_VERSION}/fpm/pool.d
set +x


echo -e "
${GREEN}-- PHP: get source from github --${NC}
"

set -x
cd /home/dvp/host
if [ ! -d php-src ]; then
    git clone http://github.com/php/php-src.git
fi
cd php-src
git checkout PHP-${PHP_VERSION}
if [ -f Makefile ]; then
    make distclean
fi
git clean -xdf
./buildconf --force
set +x

echo -e "
${GREEN}-- PHP: configure parameters & build (separate for CLI and FPM) --${NC}
"

set -x
CONFIGURE_STRING="--prefix=${PHP_PATH} \
--with-libdir=lib/x86_64-linux-gnu \
--with-pgsql \
--with-pdo-pgsql \
--with-openssl=/usr \
--with-system-ciphers \
--with-kerberos \
--with-curl \
--with-mcrypt \
--with-zlib-dir \
--with-freetype-dir \
--enable-mbstring \
--with-libxml-dir=/usr/bin \
--enable-soap \
--enable-calendar \
--with-zlib \
--with-gd \
--disable-rpath \
--with-bz2 \
--enable-sockets \
--enable-sysvsem \
--enable-sysvshm \
--enable-pcntl \
--enable-mbregex \
--enable-exif \
--enable-bcmath \
--with-mhash \
--enable-zip \
--with-pcre-regex \
--with-jpeg-dir=/usr \
--with-png-dir=/usr \
--enable-gd-native-ttf \
--enable-ftp \
--with-gettext \
--with-xmlrpc \
--with-xsl \
--enable-opcache \
--enable-inline-optimization
--enable-ftp \
--with-gettext \
--with-xpm-dir \
--enable-intl \
--with-readline \
--disable-cgi"

# Options for development
CONFIGURE_STRING="$CONFIGURE_STRING \
--enable-debug"

# Build FPM
./configure \
${CONFIGURE_STRING} \
--with-config-file-path=/etc/php/${PHP_VERSION}/fpm \
--with-config-file-scan-dir=/etc/php/${PHP_VERSION}/fpm/conf.d \
--disable-cli \
--enable-fpm \
--with-fpm-systemd \
--with-fpm-user=${FPM_USER} \
--with-fpm-group=${FPM_GROUP}

make -j2 -s
make install

# Cleanup
make distclean
./buildconf --force

# Build CLI

./configure \
${CONFIGURE_STRING} \
--enable-pcntl \
--with-config-file-path=/etc/php/${PHP_VERSION}/cli \
--with-config-file-scan-dir=/etc/php/${PHP_VERSION}/cli/conf.d

make -j2 -s
make install
set +x

echo -e "
${GREEN}-- PHP: deploy config files and environment variables --${NC}
"

set -x
# export PHP_PATH
echo "export PATH=\$PATH:${PHP_PATH}/bin" > /etc/profile.d/php.sh
echo "export PATH=\$PATH:${PHP_PATH}/bin" >> /etc/bash.bashrc
export PATH=$PATH:${PHP_PATH}/bin
ln -s ${PHP_PATH}/bin/php /usr/local/bin/php

# FPM config
cp /rias/docker/install/common/configs/php/fpm/php.ini /etc/php/${PHP_VERSION}/fpm/php.ini
cp /rias/docker/install/common/configs/php/fpm/php-fpm.conf /etc/php/${PHP_VERSION}/fpm/php-fpm.conf
cp /rias/docker/install/common/configs/php/fpm/pool.d/rias.conf /etc/php/${PHP_VERSION}/fpm/pool.d/rias.conf
mkdir /etc/php/${PHP_VERSION}/fpm/conf.d

# CLI config
cp /rias/docker/install/common/configs/php/cli/php.ini /etc/php/${PHP_VERSION}/cli/php.ini
mkdir /etc/php/${PHP_VERSION}/cli/conf.d

# sysV and systemd
cp /rias/docker/install/common/configs/init.d/php7.0-fpm.sh /etc/init.d/php7.0-fpm
cp /rias/docker/install/common/configs/systemd/php7.0-fpm.service /etc/systemd/system/php7.0-fpm.service
chmod 755 /etc/init.d/php7.0-fpm
set +x

echo -e "
${GREEN}-- PHP: install pecl modules --${NC}

Modules:
    - Imagick
    - Apcu

Related topics:
    - http://serverfault.com/questions/57377/installing-imagick-php-extension-on-ubuntu
    - http://stackoverflow.com/questions/6727736/cant-get-to-install-intl-extension-for-php-on-debian
    - https://packages.debian.org/search?keywords=libicu
"

set -x
# Imagick
# dependencies for imagick PECL extension
apt-get -y -q -o Dpkg::Use-Pty=0 install libmagickwand-dev libmagickcore-dev
pecl install imagick
echo "extension=imagick.so" > /etc/php/${PHP_VERSION}/conf.d/imagick.ini
ln -s /etc/php/${PHP_VERSION}/conf.d/imagick.ini /etc/php/${PHP_VERSION}/cli/conf.d/imagick.ini
ln -s /etc/php/${PHP_VERSION}/conf.d/imagick.ini /etc/php/${PHP_VERSION}/fpm/conf.d/imagick.ini

# Apcu
pecl install apcu-${APCU_VERSION}
echo "extension=apcu.so" > /etc/php/${PHP_VERSION}/conf.d/apcu.ini
ln -s /etc/php/${PHP_VERSION}/conf.d/apcu.ini /etc/php/${PHP_VERSION}/cli/conf.d/apcu.ini
ln -s /etc/php/${PHP_VERSION}/conf.d/apcu.ini /etc/php/${PHP_VERSION}/fpm/conf.d/apcu.ini
set +x

echo -e "
${GREEN}-- Install php-dbase from source --${NC}
"

set -x
cd /home/dvp/host
if [ ! -d php7-dbase ]; then
    git clone git://github.com/mote0230/dbase-pecl-php7.git php7-dbase
fi
cd php7-dbase
git checkout curl-${CURL_VERSION}
phpize
./configure
make
make install
touch /etc/php/${PHP_VERSION}/conf.d/dbase.ini
echo "extension=dbase.so" | tee -a /etc/php/${PHP_VERSION}/conf.d/dbase.ini
ln -s /etc/php/${PHP_VERSION}/conf.d/dbase.ini /etc/php/${PHP_VERSION}/fpm/conf.d/dbase.ini
ln -s /etc/php/${PHP_VERSION}/conf.d/dbase.ini /etc/php/${PHP_VERSION}/cli/conf.d/dbase.ini
set +x

echo -e "
${GREEN}-- Install Composer and Codeception --${NC}
"

set -x
cd ~
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer global require "fxp/composer-asset-plugin:~1.1.1"
wget -q http://codeception.com/codecept.phar
chmod +x codecept.phar
mv codecept.phar /usr/local/bin/codecept
set +x

echo -e "
${GREEN}-- Install Nginx --${NC}
"

set -x
apt-get -y -q -o Dpkg::Use-Pty=0 install nginx
mv /etc/nginx/nginx.conf /etc/nginx/nginx.conf.bak
cp /rias/docker/install/common/configs/nginx/nginx.conf /etc/nginx/nginx.conf
rm -f /var/www/html/index.html
rm -f /etc/nginx/sites-enabled/default
cp /rias/docker/install/common/configs/nginx/index.html /var/www/html/index.html
cp /rias/docker/install/common/configs/nginx/index.php /var/www/html/index.php
set +x

echo -e "
${GREEN}-- Start services --${NC}
"

set -x
insserv php7.0-fpm
systemctl enable php7.0-fpm.service
systemctl daemon-reload
systemctl start php7.0-fpm
systemctl start nginx
set +x

echo -e "
#
# ${RED}DONE!${NC}
# "