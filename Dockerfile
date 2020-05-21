FROM webdevops/php-apache:7.4

RUN mkdir /var/www/public
COPY apache/phpunit.conf /opt/docker/etc/httpd/vhost.common.d/phpunit.conf

WORKDIR /var/www
