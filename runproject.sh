#!/bin/bash

# Install Composer dependencies
composer install

# Copy the .env file and generate the application key
cp .env.example .env
php artisan key:generate

# Run database migrations
php artisan migrate

# Run the development server
php artisan serve
