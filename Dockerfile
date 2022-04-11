FROM php:7.4-apache

WORKDIR /var/www/html

# Setup GD extension
RUN apt-get update && apt-get install -y \
    libbz2-dev \
    libc-client-dev libkrb5-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmemcached-dev zlib1g-dev \
    libmcrypt-dev \
    libpq-dev \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    sendmail \
    vim \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap \
    && rm -r /var/lib/apt/lists/*

# Install extensions
# RUN docker-php-ext-install bcmath bz2 calendar dba exif gettext opcache pcntl pdo_mysql pdo_pgsql pgsql shmop soap sockets sysvmsg sysvsem sysvshm wddx zip
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt install libzip-dev

# RUN docker-php-ext-install pdo pdo_mysql zip bcmath

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
