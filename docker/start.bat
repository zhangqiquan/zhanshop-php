@echo off

docker container stop zhanshop-php
docker container rm zhanshop-php

::��������
docker build -f .\Dockerfile -t zhanshop-php:v1 ./
::��������


cd ../
start /b docker run --name zhanshop-php -v %cd%:/var/www -p 6201:6201/tcp zhanshop-php:v1


