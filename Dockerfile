# Usar una imagen oficial de PHP con Apache
FROM php:8.1-apache

# Habilitar mod_rewrite (necesario para Laravel)
RUN a2enmod rewrite

# Instalar dependencias necesarias para Laravel
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev git zip && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd

# Instalar Composer (gestor de dependencias de PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copiar los archivos de tu proyecto dentro del contenedor
COPY . /var/www/html

# Ejecutar Composer para instalar las dependencias del proyecto
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto 80 para que la aplicación sea accesible
EXPOSE 80
