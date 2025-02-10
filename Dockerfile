FROM richarvey/nginx-php-fpm:3.1.6

COPY . .

# Image config
ENV SKIP_COMPOSER 0  # Changed to 0 to allow composer install
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

# Install dependencies and optimize Laravel
RUN composer install --no-dev --optimize-autoloader && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Fix permissions
RUN chmod -R 775 /var/www/html/storage && \
    chown -R nginx:nginx /var/www/html/storage && \
    chown -R nginx:nginx /var/www/html/bootstrap/cache

# Create symlink for php-fpm socket
RUN mkdir -p /var/run/php-fpm && \
    ln -s /var/run/php-fpm.sock /var/run/php-fpm/php-fpm.sock

VOLUME /var/www/html/storage

# Create and set permissions for start.sh
COPY start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]