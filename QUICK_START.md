# Quick Start Guide

Get your Ecommerce Laravel Application up and running in minutes!

## 🚀 Quick Setup (5 minutes)

### Prerequisites
- PHP 8.1+
- Composer
- Node.js & NPM
- MySQL

### 1. Clone & Install
```bash
# Clone the repository
git clone <repository-url>
cd ecommerce

# Install dependencies
composer install
npm install
```

### 2. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate
```

### 3. Database Setup
```bash
# Create database (MySQL)
mysql -u root -p
CREATE DATABASE ecommerce_db;

# Run migrations
php artisan migrate --seed
```

### 4. Start Development
```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start queue worker (IMPORTANT!)
php artisan queue:work

# Terminal 3: Start Vite for assets
npm run dev
```

### 5. Access Application
- **Frontend**: http://localhost:8000
- **Admin**: http://localhost:8000/admin

## 📧 Email Setup (Required)

### Gmail (Recommended)
1. Enable 2FA on Gmail
2. Generate App Password
3. Update `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Ecommerce Store"
```

## 🔄 Queue Setup (Important!)

The application uses queues for email notifications. **You must start the queue worker:**

```bash
php artisan queue:work
```

**Without the queue worker running, emails won't be sent!**

## 🎯 Default Admin Account

After seeding, you can login with:
- **Email**: admin@example.com
- **Password**: password

## 🛠️ Development Commands

```bash
# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Run tests
php artisan test

# Check routes
php artisan route:list

# Check queue status
php artisan queue:monitor
```

## 🚨 Common Issues

### 1. "Class not found" errors
```bash
composer dump-autoload
```

### 2. Email not sending
- Check if queue worker is running
- Verify SMTP credentials
- Check `.env` file

### 3. Database connection error
- Verify database credentials in `.env`
- Ensure MySQL is running
- Check if database exists

### 4. Assets not loading
```bash
npm run build
# or for development
npm run dev
```

## 📱 Features to Test

1. **User Registration/Login**
2. **Product Browsing**
3. **Add to Cart**
4. **Checkout Process**
5. **Admin Dashboard**
6. **Email Notifications**

## 🔧 Customization

### Adding New Products
1. Go to Admin → Products
2. Click "Add New Product"
3. Fill in product details
4. Upload images
5. Save

### Changing Site Settings
1. Go to Admin → Settings
2. Update site information
3. Configure email settings
4. Save changes

## 📚 Next Steps

1. Read the full [README.md](README.md)
2. Check [ENVIRONMENT_SETUP.md](ENVIRONMENT_SETUP.md) for detailed configuration
3. Explore the admin dashboard
4. Customize the frontend
5. Configure payment gateways
6. Set up production environment

## 🆘 Need Help?

- Check the main README.md
- Review ENVIRONMENT_SETUP.md
- Create an issue in the repository
- Check Laravel documentation

---

**Happy Coding! 🎉**
