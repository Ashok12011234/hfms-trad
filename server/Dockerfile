# Set the base image
FROM php:latest

# Set the working directory
WORKDIR /var/www/html

# Copy the PHP application files to the container
COPY . .

# Install any necessary dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli pdo pdo_mysql zip

# Expose port 80 for HTTP traffic
EXPOSE 80

# Start Apache web server
CMD ["apache2-foreground"]
