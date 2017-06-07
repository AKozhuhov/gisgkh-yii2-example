#!/bin/bash
# Скрипт установки окружения для образа rucode/gisgkh-soap-php
# Подготовка контейнера на базе Ubuntu:
# docker pull ubuntu:16.04
# docker run docker run -d -h gisgkh-soap-php -v '/tmp:/tmp' -v '{path-to-src}/docker:/root/install' --name=gisgkh-soap-php tail -f /dev/null
# docker exec -it gisgkh-soap-php /bin/bash
# для комманды git clone нужно подключить ssh-ключ
# eval `ssh-agent -s` && ssh-add {path-to-key}

apt-get update
apt-get install dialog apt-utils locales tzdata
echo "LANGUAGE=en_US.UTF-8" > /etc/default/locale
echo "LC_ALL=en_US.UTF-8" >> /etc/default/locale
echo "LANG=en_US.UTF-8" >> /etc/default/locale
echo "LC_TYPE=en_US.UTF-8" >> /etc/default/locale
locale-gen en_US.UTF-8
locale-gen ru_RU.UTF-8
dpkg-reconfigure locales
apt-get install sudo wget vim bzip2 telnet openssh-server
apt-get install software-properties-common
apt-get install git

# конфиг openssl

mv /etc/ssl/openssl.cnf /etc/ssl/openssl.cnf.bak
cp /root/install/openssl.cnf /etc/ssl/
# проверка что ГОСТ в openssl заработал
# должно выдавать "(gost) Reference implementation of GOST engine"
openssl engine | grep GOST

# компиляция CURL 7.50

CURL_VERSION=7_50_0
apt-get install make autoconf gcc bison g++ pkg-config build-essential libtool libssl-dev
cd /tmp && rm -rf curl-src
git clone git@github.com:curl/curl.git curl-src
cd curl-src
git checkout curl-${CURL_VERSION}
git clean -xdf
./buildconf
./configure --with-ssl
make
make install
apt-get install libcurl4-openssl-dev
# проверка что curl видит ГОСТ-овский engine в openssl
# должно выдавать "gost"
curl --engine list | grep gost

# установка PHP 7.1

PHP_VERSION=7.1
add-apt-repository ppa:ondrej/php
apt-get update
apt-get install php7.1
apt-get install php7.1-fpm
apt-get install php7.1-gmp
apt-get install php7.1-intl
apt-get install php7.1-dom
apt-get install php7.1-soap
apt-get install php7.1-curl
apt-get install php7.1-dev
apt-get install php7.1-mbstring

cd /tmp
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer global require "fxp/composer-asset-plugin:~1.1.1"
wget -q http://codeception.com/codecept.phar
chmod +x codecept.phar
mv codecept.phar /usr/local/bin/codecept

# установка NGINX

apt-get install nginx
