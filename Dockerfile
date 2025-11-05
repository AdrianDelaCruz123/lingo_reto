# Imagen base de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias para Laravel y MySQL
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git && \
    docker-php-ext-install pdo pdo_mysql zip

# Activar mod_rewrite (necesario para Laravel)
RUN a2enmod rewrite

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto al contenedor
COPY ./src /var/www/html

# Cambiar DocumentRoot de Apache para que apunte a /public (Laravel)
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --no-scripts --no-autoloader

# Generar el autoload de Composer (ahora que los archivos ya están en su sitio)
RUN composer dump-autoload

# Dar permisos a Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer puerto 80
EXPOSE 80

# Comando por defecto
CMD ["apache2-foreground"]

EXPOSE 80
