#!/bin/sh

docker container stop zhanshop-php
docker container rm zhanshop-php

docker build -f ./Dockerfile -t zhanshop-php:v1 ./

cd ../
dirpath=$(cd $(dirname $0);pwd)

docker run --name zhanshop-php -v $dirpath:/var/www -p 6201:6201/tcp --restart=always zhanshop-php:v1 &