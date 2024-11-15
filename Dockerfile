# Use an official PHP image as a base
FROM php:8.1-cli

# Install PHP extensions if required (example: pdo, mysqli, etc.)
# RUN docker-php-ext-install pdo pdo_mysql

# Set the working directory to the folder where your PHP files are
WORKDIR /app

# Copy all your files into the container
COPY . /app

# Expose the port that Render will provide (it will be set dynamically)
EXPOSE 10000

# Install dependencies like the PHP built-in server
RUN apt-get update && apt-get install -y \
    php-cli \
    php-common \
    php-mbstring \
    php-xml \
    php-curl \
    php-mysqli \
    && apt-get clean

# Start the PHP built-in server and bind to the correct port
CMD ["php", "-S", "0.0.0.0:$PORT"]
