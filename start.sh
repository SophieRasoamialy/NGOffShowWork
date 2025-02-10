#!/bin/bash
echo "Starting services..."

# Ensure necessary directories exist
mkdir -p /var/run/php-fpm

# Start PHP-FPM in the background
php-fpm &
php_fpm_pid=$!

# Wait a moment to ensure PHP-FPM starts
sleep 2

# Check if PHP-FPM is running
if ! kill -0 $php_fpm_pid 2>/dev/null; then
    echo "Failed to start PHP-FPM"
    exit 1
fi

echo "PHP-FPM started successfully"

# Start Nginx in the foreground
nginx -g 'daemon off;'