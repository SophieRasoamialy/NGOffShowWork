FROM richarvey/nginx-php-fpm:3.1.6

COPY . .

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

# Create symlink for php-fpm socket
RUN mkdir -p /var/run/php-fpm && \
    ln -s /var/run/php-fpm.sock /var/run/php-fpm/php-fpm.sock

VOLUME /var/www/html/storage

# Start script
RUN echo '#!/bin/bash\n\
/var/www/html/scripts/init.sh\n\
/start.sh' > /custom-start.sh

RUN chmod +x /custom-start.sh

CMD ["/custom-start.sh"]