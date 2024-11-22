# Usamos una imagen oficial de PHP con Apache como base
FROM php:8.2-apache

# Instalar las dependencias necesarias de PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Instalar Composer (gestor de dependencias de PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Habilitar el mod_rewrite de Apache para Laravel
RUN a2enmod rewrite

# Establecer el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copiar los archivos de la aplicación al contenedor
COPY . .

# Asegurarnos de que los permisos sean correctos para las carpetas de almacenamiento
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 80 para la aplicación
EXPOSE 80

# Iniciar Apache cuando se ejecute el contenedor
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]

