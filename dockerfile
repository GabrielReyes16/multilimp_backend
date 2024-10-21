# Usa una imagen base oficial de PHP con Apache
FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Copiar el código de Laravel al contenedor
COPY . .

# Dar permisos a la carpeta de almacenamiento
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configurar Apache para trabajar con Laravel
RUN a2enmod rewrite
RUN service apache2 restart

# Exponer el puerto 80
EXPOSE 80

# Ejecutar Composer para instalar dependencias
RUN composer install --no-dev --optimize-autoloader

# Establecer permisos correctos
RUN chmod -R 755 /var/www/html
RUN chmod -R 775 /var/www/html/storage

# Configurar variables de entorno
COPY .env.example .env
RUN php artisan key:generate

# Comando por defecto para iniciar Apache cuando el contenedor se inicie
CMD ["apache2-foreground"]
