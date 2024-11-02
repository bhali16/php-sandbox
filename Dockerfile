FROM php:8.2-apache

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        zip \
    && pecl install redis xdebug \
    && docker-php-ext-enable redis xdebug
# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files into the container
COPY . /var/www/html

# Set permissions to avoid "Forbidden" errors
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Update Apache configuration to allow access to the document root
RUN echo "\
<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n" \
>> /etc/apache2/apache2.conf

# Expose port 80 for Apache
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
