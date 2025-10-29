# Imagen base de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias para Laravel y MySQL
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git && \
    docker-php-ext-install pdo pdo_mysql zip

# Activar mod_rewrite (necesario para Laravel)
RUN a2enmod rewrite

# Copiar los archivos del proyecto al contenedor
WORKDIR /var/www/html
COPY ./src /var/www/html

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage

# Exponer puerto 80
EXPOSE 80
