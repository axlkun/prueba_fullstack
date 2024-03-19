# Imagen base con PHP y Apache
FROM php:8.2-apache

# Copiar virtual host al contenedor
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Actualizar el sistema e instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    imagemagick \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    wget \
    && rm -rf /var/lib/apt/lists/* \
    && a2enmod rewrite \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install gd pdo pdo_mysql mysqli zip

# Copiar todo el contenido del proyecto al contenedor
# COPY public/ /var/www/

# Establecer el directorio de trabajo
WORKDIR /var/www

# Exponer el puerto 80 para Apache
EXPOSE 80

# Comando para iniciar Apache cuando se ejecute el contenedor
CMD ["apache2-foreground"]
