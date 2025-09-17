@echo off
REM Ecommerce Laravel Application Setup Script for Windows
REM This script will help you set up the ecommerce application

echo 🚀 Starting Ecommerce Laravel Application Setup...

REM Check if PHP is installed
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ PHP is not installed. Please install PHP 8.1 or higher.
    pause
    exit /b 1
)

REM Check if Composer is installed
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Composer is not installed. Please install Composer.
    pause
    exit /b 1
)

REM Check if Node.js is installed
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Node.js is not installed. Please install Node.js.
    pause
    exit /b 1
)

REM Check if NPM is installed
npm --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ NPM is not installed. Please install NPM.
    pause
    exit /b 1
)

echo ✅ All required tools are installed.

REM Install PHP dependencies
echo 📦 Installing PHP dependencies...
composer install

REM Install Node.js dependencies
echo 📦 Installing Node.js dependencies...
npm install

REM Create .env file if it doesn't exist
if not exist .env (
    echo 📝 Creating .env file...
    copy .env.example .env
    echo ⚠️  Please update your .env file with your database and email credentials.
) else (
    echo ✅ .env file already exists.
)

REM Generate application key
echo 🔑 Generating application key...
php artisan key:generate

REM Create storage link
echo 🔗 Creating storage link...
php artisan storage:link

REM Run migrations
echo 🗄️  Running database migrations...
php artisan migrate

REM Seed the database
echo 🌱 Seeding the database...
php artisan db:seed

REM Build assets
echo 🎨 Building frontend assets...
npm run build

echo.
echo 🎉 Setup completed successfully!
echo.
echo 📋 Next steps:
echo 1. Update your .env file with your database credentials
echo 2. Update your .env file with your SMTP credentials for email
echo 3. Start the development server: php artisan serve
echo 4. In another terminal, start the queue worker: php artisan queue:work
echo 5. In another terminal, start Vite for development: npm run dev
echo.
echo 🌐 Access your application at: http://localhost:8000
echo 👨‍💼 Access admin dashboard at: http://localhost:8000/admin
echo.
echo 📧 Don't forget to configure your SMTP settings in the .env file!
echo 🔄 Don't forget to start the queue worker for email notifications!
pause
