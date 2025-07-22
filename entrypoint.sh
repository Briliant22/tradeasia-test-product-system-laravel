#!/bin/bash

# Wait for MySQL (skip if you're not using it directly)
if [[ -n "$DB_HOST" ]]; then
  until nc -z "$DB_HOST" "$DB_PORT"; do
    echo "Waiting for MySQL at $DB_HOST:$DB_PORT..."
    sleep 2
  done
fi

echo "Running migrations..."
php artisan migrate --force

echo "Starting Apache..."
exec apache2-foreground
