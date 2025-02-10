#!/bin/bash

echo ".................................."

# Start PHP-FPM
php-fpm

echo "php-fpm start......................."

# Start Nginx
nginx -g 'daemon off;'

echo "nginx start......................."

# Check Nginx status
sleep 5
if ! pgrep nginx > /dev/null; then
    echo "Nginx failed to start......................."
    exit 1
fi
