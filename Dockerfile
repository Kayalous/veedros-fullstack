FROM php:7.4-fpm
RUN apt-get update -y && apt-get install -y git libonig-dev libmcrypt-dev openssl \
    && pecl install mcrypt-1.0.4 \
    && docker-php-ext-enable mcrypt 
RUN docker-php-ext-install pdo mbstring
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
COPY . /app
ADD composer.json ./
RUN composer install --no-scripts --no-interaction --no-autoloader --no-dev --prefer-dist
ADD . ./
CMD php artisan cache:clear
CMD php artisan config:clear
CMD php artisan view:clear
CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000