# Use the official PHP image as a base
FROM php:8.1-apache

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mysqli

# Copy your PHP code into the container
COPY . /var/www/html/

# Expose the port Render will use (default is 10000)
EXPOSE 10000

# Start the Apache server
CMD ["apache2-foreground"]
