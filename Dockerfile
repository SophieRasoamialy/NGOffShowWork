FROM richarvey/nginx-php-fpm:3.1.6

COPY . .

# Copy nginx.conf
COPY nginx.conf /etc/nginx/nginx.conf
COPY www.conf /etc/php-fpm.d/www.conf

# Image config
ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV NGINX_WORKER_PROCESSES auto

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

# Create scripts directory
RUN mkdir -p /var/www/html/scripts

# Create initialization script
RUN echo '#!/bin/bash\n\
echo "Creating .env file..."\n\
touch /var/www/html/.env\n\
env >> /var/www/html/.env\n\
php artisan config:cache\n\
php artisan migrate --force' > /var/www/html/scripts/init.sh

# Make script executable
RUN chmod +x /var/www/html/scripts/init.sh

# Install dependencies and optimize Laravel
RUN composer install --no-dev --optimize-autoloader

# Fix permissions
RUN chmod -R 775 /var/www/html/storage && \
    chown -R nginx:nginx /var/www/html/storage && \
    chown -R nginx:nginx /var/www/html/bootstrap/cache

    RUN chmod -R 755 /etc/nginx


# Create symlink for php-fpm socket
RUN mkdir -p /var/run/php-fpm && \
    ln -s /var/run/php-fpm.sock /var/run/php-fpm/php-fpm.sock

VOLUME /var/www/html/storage

# Expose port 80
EXPOSE 80

# Start script
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

CMD ["start.sh"]
