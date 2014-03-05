#!/bin/bash

wget -q http://getcomposer.org/installer -O - | php;
mkdir web
./composer.phar install --dev;
[[ -s web/css/bootstrap.css ]]
