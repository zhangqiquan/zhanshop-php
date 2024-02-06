FROM zhanshop/php:8.3-ubuntu
LABEL version="1.0" description="张启全的php框架"

# 设置环境变量
ENV APP_ENV 'dev'
EXPOSE 6201/tcp
RUN docker-php-ext-install sockets
WORKDIR /var/www

CMD ["php","/var/www/cmd.php", "server", "start", "false"]