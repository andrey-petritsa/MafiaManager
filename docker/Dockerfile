FROM php:apache

RUN apt-get update && apt-get upgrade -y && apt-get -y install zip git \
	&& pecl install xdebug && docker-php-ext-enable xdebug \
	#&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
	&& a2enmod rewrite \
	&& docker-php-ext-install mysqli
