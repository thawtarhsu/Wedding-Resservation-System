FROM php:8.3.26-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y --no-install-recommends \
  ca-certificates \
  curl \
  git \
  libonig-dev \
  unzip \
  zip \
  && rm -rf /var/lib/apt/lists/* \
  && docker-php-ext-install -j$(nproc) mysqli pdo pdo_mysql mbstring

WORKDIR /var/www/html
COPY . .

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
