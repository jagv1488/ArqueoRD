FROM php:8.2-fpm

# Instalar extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    nodejs \
    npm

# Limpiar caché de apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de composer primero (mejor para caché)
COPY composer.json composer.lock ./

# Instalar dependencias PHP
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Copiar el resto de archivos
COPY . .

# Instalar dependencias NPM y compilar assets (si usas Vite)
RUN npm install && npm run build

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer puerto
EXPOSE 9000

# Comando para iniciar PHP-FPM
CMD ["php-fpm"]
