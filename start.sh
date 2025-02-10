#!/bin/bash

echo "start>>>>>>>>>>>>>>>>>>>>>>>><"

# Start PHP-FPM
php-fpm
if [ $? -eq 0 ]; then
    echo "php-fpm started successfully."
else
    echo "Failed to start php-fpm."
    exit 1
fi

echo "php-fpm start......................."

# Start Nginx
nginx -g 'daemon off;' &
nginx_pid=$!

sleep 5
if ! ps -p $nginx_pid > /dev/null; then
    echo "Nginx failed to start."
    exit 1
fi

echo "nginx start......................."

wait $nginx_pid
