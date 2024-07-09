FROM php:8.2-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    autoconf \
    build-essential \
    apt-utils \
    zlib1g-dev \
    libzip-dev \
    unzip \
    zip \
    libmagick++-dev \
    libmagickwand-dev \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    curl \
    libcurl4 \
    libcurl4-openssl-dev \
    libmcrypt-dev \
    libonig-dev \
    wget \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo pdo_pgsql

RUN echo "error_reporting = E_ALL & ~E_STRICT & ~E_DEPRECATED" > /usr/local/etc/php/conf.d/disable-deprecations.ini

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install calendar curl soap gd intl pdo_mysql mysqli zip xml mbstring bcmath gettext pdo pdo_pgsql

COPY ../../. /var/www/html

RUN cd /var/www/html && composer install --dev
ENV PATH /var/www/html/vendor/bin:$PATH

EXPOSE 80