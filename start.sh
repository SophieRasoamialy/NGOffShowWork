#!/bin/bash

# Start PHP-FPM
php-fpm

# Start Nginx
nginx -g 'daemon off;'

# Check Nginx status
sleep 5
if ! pgrep nginx > /dev/null; then
    echo "Nginx failed to start......................."
    exit 1
fi
