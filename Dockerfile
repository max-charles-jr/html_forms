FROM php:8.1-apache

# Install mysqli and any other necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite for pretty URLs (optional but often useful)
RUN a2enmod rewrite

# Copy the application files to the container
COPY ./html /var/www/html

# Expose port 80 (optional, useful if you are building directly and not using docker-compose)
EXPOSE 80