#!/bin/bash

#SCRIPT=$(readlink -f "$0")
#ROOT=$(dirname "$SCRIPT")

#cd $ROOT/..

#chgrp -R www-data runtime
#chmod -R +w runtime
#chgrp -R www-data web/assets
#chmod -R +w web/assets
#
#mv /etc/nginx/sites-enabled/default /etc/nginx/conf.d/default.bak
#rm -f /etc/nginx/conf.d/gisgkh-yii2-example.conf
ln -s /example/docker/default.nginx /etc/nginx/conf.d/gisgkh-yii2-example.conf

service php7.1-fpm start
service nginx start