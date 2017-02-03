FROM phusion/baseimage:0.9.19

CMD ["/sbin/my_init"]

RUN apt-get update
RUN apt-get install -y curl git vim libmcrypt-dev libxml2-dev \ 
	php7.0-cli php7.0-mbstring php7.0-mcrypt php7.0-dom php7.0-zip \
	php7.0-curl

RUN curl -sS https://getcomposer.org/installer | php  
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html

#RUN php /var/www/html/composer.phar install --working-dir /var/www/html
#RUN php artisan migrate

# Clean up APT when done.
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*