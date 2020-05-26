FROM webdevops/php-apache:7.4

RUN mkdir /var/www/public
COPY apache/street-tt.conf /opt/docker/etc/httpd/vhost.common.d/street-tt.conf

WORKDIR /var/www
