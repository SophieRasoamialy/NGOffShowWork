#!/bin/bash
echo "Starting services..."
echo "Current user: $(whoami)"
echo "Socket permissions: $(ls -l /var/run/php-fpm.sock)"

# Vérifier la configuration de PHP-FPM
php-fpm -t

# Démarrer PHP-FPM en arrière-plan
php-fpm &
php_fpm_pid=$!

sleep 2

# Vérifier si PHP-FPM a bien démarré
if ! kill -0 $php_fpm_pid 2>/dev/null; then
    echo "PHP-FPM failed to start"
    exit 1
fi

# Vérifier si le lien symbolique storage existe
if [ ! -L "/var/www/html/public/storage" ]; then
    php artisan storage:link
    echo "Storage symlink created"
else
    echo "Storage symlink already exists"
fi

# Vérifier et corriger les permissions des fichiers
chown -R nginx:nginx /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "PHP-FPM started"

# Lancer Nginx en mode foreground
nginx -g 'daemon off;'
