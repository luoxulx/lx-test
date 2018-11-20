FROM php:7.2-fpm-alpine

RUN apk update && apk add --no-cache libpng m4 autoconf make gcc g++ \
    freetype-dev libjpeg-turbo-dev libpng-dev libmcrypt-dev linux-headers\
    nginx supervisor curl libcurl gmp-dev libxslt-dev gettext-dev bzip2-dev

RUN docker-php-ext-configure gd --with-gd \
    --with-freetype-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ \
    --with-png-dir=/usr/include/

RUN docker-php-ext-configure zip --with-zlib-dir=/usr && docker-php-ext-configure wddx --enable-libxml

RUN docker-php-ext-install bcmath gd mysqli pdo_mysql calendar sysvmsg sysvsem sysvshm \
    mysql xsl shmop sockets bz2 exif gettext gmp mcrypt opcache pcntl zip wddx

ENV MEMCACHED_DEPS zlib-dev libmemcached-dev cyrus-sasl-dev
RUN apk add --no-cache --update libmemcached-libs zlib
RUN set -xe \
    && apk add --no-cache --update --virtual .phpize-deps $PHPIZE_DEPS \
    && apk add --no-cache --update --virtual .memcached-deps $MEMCACHED_DEPS \
    && pecl install memcached-2.2.0 \
    && echo "extension=memcached.so" > /usr/local/etc/php/conf.d/memcached.ini \
    && pecl install redis \
    && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini \
    && rm -rf /usr/share/php && rm -rf /tmp/* \
    && apk del .memcached-deps .phpize-deps

RUN pecl install swoole-1.9.0 && echo "extension=swoole.so" > /usr/local/etc/php/conf.d/swoole.ini

ENV TZ=Asia/Shanghai
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# RUN chown -R www-data:root /var/tmp/nginx

# nginx config
ADD duoke.conf /etc/nginx/conf.d/
ADD nginx.conf /etc/nginx/nginx.conf

# php config
# ADD php.ini /usr/local/etc/php/
# ADD www.conf /usr/local/etc/php-fpm.d/

ADD supervisord.conf /etc/supervisord.conf

EXPOSE 80

CMD /usr/bin/supervisord -c /etc/supervisord.conf
