FROM php:8.2-apache

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpq-dev \
    unzip \
    git \
    && apt-get install -y \
    libonig-dev \
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        zip \
        mbstring \
        xml \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configure PHP upload limits (increased values)
RUN echo "\
upload_max_filesize = 5120M\n\
post_max_size = 5120M\n\
memory_limit = 5120M\n\
max_execution_time = 3600\n\
max_input_time = 3600\n\
output_buffering = Off\n\
max_input_vars = 5000\n\
session.gc_maxlifetime = 3600\n\
display_errors = Off\n\
log_errors = On\n\
error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT\n" > /usr/local/etc/php/conf.d/uploads.ini

# Additional PHP configuration for phpMyAdmin
RUN echo "\
session.save_handler = files\n\
session.use_strict_mode = 1\n\
session.use_cookies = 1\n\
session.use_only_cookies = 1\n\
session.cookie_httponly = 1\n" >> /usr/local/etc/php/conf.d/uploads.ini

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Update Apache configuration to allow access to the document root
RUN echo "\
<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n" \
>> /etc/apache2/apache2.conf

# Set working directory
WORKDIR /var/www/html

# Create directory and set permissions
RUN mkdir -p /var/www/html \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Copy application files into the container
COPY --chown=www-data:www-data . /var/www/html/

# Expose port 80 for Apache
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
