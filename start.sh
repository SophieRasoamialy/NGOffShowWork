#!/bin/bash
echo "Starting services..."
echo "Current user: $(whoami)"
echo "Socket permissions: $(ls -l /var/run/php-fpm.sock)"

php-fpm -t

php-fpm &
php_fpm_pid=$!

sleep 2

if ! kill -0 $php_fpm_pid 2>/dev/null; then
    echo "PHP-FPM failed to start"
    exit 1
fi

echo "PHP-FPM started"
nginx -g 'daemon off;'