#!/bin/bash

# Ecommerce Laravel Application Setup Script
# This script will help you set up the ecommerce application

echo "🚀 Starting Ecommerce Laravel Application Setup..."

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP 8.1 or higher."
    exit 1
fi

# Check if Composer is installed
if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed. Please install Composer."
    exit 1
fi

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed. Please install Node.js."
    exit 1
fi

# Check if NPM is installed
if ! command -v npm &> /dev/null; then
    echo "❌ NPM is not installed. Please install NPM."
    exit 1
fi

echo "✅ All required tools are installed."

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install

# Install Node.js dependencies
echo "📦 Installing Node.js dependencies..."
npm install

# Create .env file if it doesn't exist
if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp .env.example .env
    echo "⚠️  Please update your .env file with your database and email credentials."
else
    echo "✅ .env file already exists."
fi

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate

# Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link

# Run migrations
echo "🗄️  Running database migrations..."
php artisan migrate

# Seed the database
echo "🌱 Seeding the database..."
php artisan db:seed

# Build assets
echo "🎨 Building frontend assets..."
npm run build

echo ""
echo "🎉 Setup completed successfully!"
echo ""
echo "📋 Next steps:"
echo "1. Update your .env file with your database credentials"
echo "2. Update your .env file with your SMTP credentials for email"
echo "3. Start the development server: php artisan serve"
echo "4. In another terminal, start the queue worker: php artisan queue:work"
echo "5. In another terminal, start Vite for development: npm run dev"
echo ""
echo "🌐 Access your application at: http://localhost:8000"
echo "👨‍💼 Access admin dashboard at: http://localhost:8000/admin"
echo ""
echo "📧 Don't forget to configure your SMTP settings in the .env file!"
echo "🔄 Don't forget to start the queue worker for email notifications!"
