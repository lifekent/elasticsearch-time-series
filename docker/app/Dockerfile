FROM php:7.0-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev libxml2-dev \
	&& docker-php-ext-install mcrypt mbstring

RUN pecl install -o -f xdebug \
    && rm -rf /tmp/pear \
    && echo "zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20121212/xdebug.so" > /usr/local/etc/php/conf.d/xdebug.ini \