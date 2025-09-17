# Environment Setup Guide

This guide will help you configure your environment variables for the Ecommerce Laravel Application.

## 📋 Required Environment Variables

### 1. Application Configuration
```env
APP_NAME="Ecommerce Store"
APP_ENV=local
APP_KEY=base64:your-generated-key
APP_DEBUG=true
APP_URL=http://localhost:8000
```

### 2. Database Configuration
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Email Configuration (SMTP)

#### Gmail SMTP
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

#### Outlook/Hotmail SMTP
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp-mail.outlook.com
MAIL_PORT=587
MAIL_USERNAME=your-email@outlook.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@outlook.com
MAIL_FROM_NAME="Ecommerce Store"
```

#### Yahoo SMTP
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mail.yahoo.com
MAIL_PORT=587
MAIL_USERNAME=your-email@yahoo.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@yahoo.com
MAIL_FROM_NAME="Ecommerce Store"
```

#### Custom SMTP Server
```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-server.com
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="Ecommerce Store"
```

### 4. Queue Configuration
```env
# For development (uses database)
QUEUE_CONNECTION=database

# For production (uses Redis)
QUEUE_CONNECTION=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 5. Cache Configuration
```env
CACHE_DRIVER=file
SESSION_DRIVER=database
```

### 6. Payment Configuration (Stripe)
```env
STRIPE_KEY=pk_test_your_stripe_public_key
STRIPE_SECRET=sk_test_your_stripe_secret_key
```

### 7. File Storage (AWS S3 - Optional)
```env
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your-access-key
AWS_SECRET_ACCESS_KEY=your-secret-key
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
```

## 🔧 Setup Instructions

### Step 1: Create .env File
```bash
cp .env.example .env
```

### Step 2: Generate Application Key
```bash
php artisan key:generate
```

### Step 3: Configure Database
1. Create a MySQL database named `ecommerce_db`
2. Update the database credentials in `.env`
3. Run migrations:
```bash
php artisan migrate
```

### Step 4: Configure Email
1. Choose your email provider
2. Update the mail configuration in `.env`
3. For Gmail, enable 2FA and create an App Password

### Step 5: Configure Queue
1. For development, use database queue
2. For production, install Redis and use Redis queue
3. Start the queue worker:
```bash
php artisan queue:work
```

## 📧 Email Provider Setup

### Gmail Setup
1. Enable 2-Factor Authentication
2. Go to Google Account → Security → 2-Step Verification
3. Generate App Password for "Mail"
4. Use the generated password in `MAIL_PASSWORD`

### Outlook Setup
1. Enable 2-Factor Authentication
2. Go to Microsoft Account → Security
3. Create App Password
4. Use the generated password in `MAIL_PASSWORD`

### Yahoo Setup
1. Enable 2-Factor Authentication
2. Go to Yahoo Account Security
3. Generate App Password
4. Use the generated password in `MAIL_PASSWORD`

## 🔄 Queue Setup

### Database Queue (Development)
```bash
# Run migrations to create jobs table
php artisan queue:table
php artisan migrate

# Start queue worker
php artisan queue:work
```

### Redis Queue (Production)
```bash
# Install Redis
# Ubuntu/Debian
sudo apt-get install redis-server

# macOS
brew install redis

# Start Redis
redis-server

# Start queue worker
php artisan queue:work redis
```

## 🚀 Production Environment

### Security Settings
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

### Performance Settings
```env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### SSL Configuration
```env
FORCE_HTTPS=true
```

## 🧪 Testing Environment

### Local Testing
```env
APP_ENV=testing
APP_DEBUG=true
DB_DATABASE=ecommerce_test
MAIL_MAILER=log
```

### Staging Environment
```env
APP_ENV=staging
APP_DEBUG=false
APP_URL=https://staging.yourdomain.com
```

## 🔍 Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check database credentials
   - Ensure MySQL is running
   - Verify database exists

2. **Email Not Sending**
   - Check SMTP credentials
   - Verify App Password (for Gmail)
   - Check firewall settings
   - Ensure queue worker is running

3. **Queue Jobs Not Processing**
   - Start queue worker: `php artisan queue:work`
   - Check Redis connection (if using Redis)
   - Check database connection (if using database queue)

4. **Storage Link Error**
   - Run: `php artisan storage:link`
   - Check file permissions

### Debug Commands
```bash
# Check configuration
php artisan config:show

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Check queue status
php artisan queue:monitor

# Test email configuration
php artisan tinker
>>> Mail::raw('Test email', function($msg) { $msg->to('test@example.com')->subject('Test'); });
```

## 📝 Environment Checklist

- [ ] Application key generated
- [ ] Database configured and migrated
- [ ] Email SMTP configured
- [ ] Queue worker running
- [ ] Storage link created
- [ ] Cache configured
- [ ] Payment gateway configured (if needed)
- [ ] File storage configured (if using S3)
- [ ] SSL certificate installed (production)
- [ ] Environment variables secured

## 🔒 Security Notes

1. Never commit `.env` file to version control
2. Use strong passwords for database and email
3. Enable 2FA for email accounts
4. Use App Passwords instead of regular passwords
5. Regularly rotate API keys and passwords
6. Use environment-specific configurations
7. Enable HTTPS in production
8. Configure proper file permissions

---

**Need Help?** Check the main README.md or create an issue in the repository.
