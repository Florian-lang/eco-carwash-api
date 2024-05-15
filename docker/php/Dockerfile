FROM php:8.3.7-fpm

RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN useradd -m user
USER root
RUN chown -R user:user /var/www/html

COPY . .

RUN chmod -R 777 /var/www/html

USER user

COPY composer.json composer.lock ./
RUN composer install

EXPOSE 9000

CMD ["php-fpm"]