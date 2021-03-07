FROM php:7-apache
ARG PUID=1000
ARG PGID=1000
RUN groupmod -g $PGID www-data && usermod -u $PUID www-data
RUN apt-get update && \
    apt-get install -y zlib1g-dev libpng-dev libjpeg-dev ca-certificates curl git
RUN docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install gd
RUN pecl install -f xdebug && docker-php-ext-enable xdebug
RUN echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/php.ini;
RUN echo 'xdebug.client_port=9000' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.start_with_request=yes' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.mode=debug' >> /usr/local/etc/php/php.ini
VOLUME /media
EXPOSE 9000
EXPOSE 80