FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    netcat-openbsd gnupg \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Node.js 18
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set Laravel's public directory as Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -i 's|/var/www/html|${APACHE_DOCUMENT_ROOT}|g' /etc/apache2/sites-available/000-default.conf && \
    echo '<Directory "/var/www/html/public">\n\
    AllowOverride All\n\
    Require all granted\n\
    </Directory>' > /etc/apache2/conf-available/override.conf && \
    a2enconf override

# Set working directory
WORKDIR /var/www/html

# Copy composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy package config first to cache npm install
COPY package*.json ./

# Install JS dependencies
RUN npm install

# Copy entire Laravel source
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Build frontend (support Vite or Laravel Mix)
RUN if [ -f vite.config.js ]; then npm run build; \
    elif [ -f webpack.mix.js ]; then npm run prod; \
    else echo "No frontend build system detected"; fi

# Set correct permissions
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# Add entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]

EXPOSE 80
