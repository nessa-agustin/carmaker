# FROM docker/whalesay:latest
# LABEL Name=carmaker Version=0.0.1
# RUN apt-get -y update && apt-get install -y fortunes
# CMD ["sh", "-c", "/usr/games/fortune -a | cowsay"]

FROM composer as builder
WORKDIR /app
COPY composer.* ./
RUN composer install


FROM php:7.2-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring

# WORKDIR /app
COPY . /app

# COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY --from=builder /app/vendor /var/www/vendor

# RUN composer install

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000