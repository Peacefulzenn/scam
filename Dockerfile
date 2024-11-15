# Use an official PHP image as a base
FROM php:8.1-cli

# Install required extensions or libraries if needed
# RUN docker-php-ext-install pdo pdo_mysql

# Set the working directory to the folder where your PHP files are
WORKDIR /app

# Copy all your files into the container
COPY . /app

# Expose the port on which PHP server will run
EXPOSE 10000

# Command to start PHP built-in server
CMD ["php", "-S", "0.0.0.0:10000"]
