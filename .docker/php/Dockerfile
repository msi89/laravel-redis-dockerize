FROM php:7.4-fpm


# Install system dependencies
RUN apt-get update && apt-get install -y libpq-dev libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev
# Configure the extension:
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
# Install the extension:
RUN docker-php-ext-install pdo pdo_pgsql

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd