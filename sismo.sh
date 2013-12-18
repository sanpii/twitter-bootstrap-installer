#!/bin/bash

wget -q http://getcomposer.org/installer -O - | php;
mkdir web
./composer.phar install --dev;
[[ -e web/css/bootstrap.css ]]
