# Ecommerce Laravel Application

A comprehensive ecommerce platform built with Laravel 10, featuring a modern admin dashboard, multi-language support, and advanced ecommerce functionality.

## 🚀 Features

- **Multi-language Support** (Arabic & English)
- **Admin Dashboard** with comprehensive management tools
- **Product Management** with categories and subcategories
- **Shopping Cart & Wishlist** functionality
- **Order Management** system
- **User Authentication & Authorization**
- **Email Notifications** system
- **Contact Form** with admin notifications
- **Product Reviews & Ratings**
- **Search & Filter** functionality
- **Responsive Design** with Tailwind CSS
- **PDF Generation** for invoices
- **Queue System** for background jobs
- **Role-based Permissions** (Spatie)

## 📋 Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Redis (for queues)

## 🛠️ Installation

### 1. Clone the repository
```bash
git clone <repository-url>
cd ecommerce
```

### 2. Install PHP dependencies
```bash
composer install
```

### 3. Install Node.js dependencies
```bash
npm install
```

### 4. Environment Setup
Create a `.env` file from the example:
```bash
cp .env.example .env
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Database Configuration
Update your `.env` file with database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 7. Run Migrations
```bash
php artisan migrate
```

### 8. Seed the Database
```bash
php artisan db:seed
```

### 9. Create Storage Link
```bash
php artisan storage:link
```

### 10. Build Assets
```bash
npm run build
```

## 🚀 Development

### Start Development Server
```bash
# Start Laravel server
php artisan serve

# In another terminal, start Vite for asset compilation
npm run dev
```

### Queue Worker (Important!)
For email notifications and background jobs, start the queue worker:
```bash
php artisan queue:work
```

## 📧 Email Configuration

### SMTP Settings
Update your `.env` file with SMTP credentials:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Your Store Name"
```

### Gmail Setup
1. Enable 2-Factor Authentication on your Gmail account
2. Generate an App Password:
   - Go to Google Account settings
   - Security → 2-Step Verification → App passwords
   - Generate a password for "Mail"
3. Use the generated password in `MAIL_PASSWORD`

### Other SMTP Providers
- **Mailgun**: Use `smtp.mailgun.org`
- **SendGrid**: Use `smtp.sendgrid.net`
- **Amazon SES**: Use your SES SMTP endpoint

## 🔧 Queue Configuration

### Database Queue (Recommended for development)
```env
QUEUE_CONNECTION=database
```

### Redis Queue (Recommended for production)
```env
QUEUE_CONNECTION=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### Start Queue Worker
```bash
# For development
php artisan queue:work

# For production (with supervisor)
php artisan queue:work --daemon
```

## 🌐 Multi-language Support

The application supports Arabic and English languages. Language files are located in:
- `resources/lang/en/`
- `resources/lang/ar/`

### Adding New Languages
1. Create language files in `resources/lang/[language]/`
2. Update `config/laravellocalization.php`
3. Add language switcher to your views

## 👥 User Roles & Permissions

The application uses Spatie Laravel Permission package:

- **Super Admin**: Full access to all features
- **Admin**: Manage products, orders, customers
- **Customer**: Browse, purchase, manage profile

### Seeding Roles & Permissions
```bash
php artisan db:seed --class=UserRolePermissionSeeder
```

## 📱 Admin Dashboard

Access the admin dashboard at `/admin` with the following features:

- **Dashboard**: Analytics and overview
- **Products**: Manage products, categories, subcategories
- **Orders**: View and manage customer orders
- **Customers**: Manage user accounts
- **Settings**: Configure site settings
- **Content**: Manage sliders, testimonials, posts

## 🛒 Ecommerce Features

### Product Management
- Product creation with images
- Category and subcategory management
- Product variants and attributes
- Inventory tracking
- SEO-friendly URLs

### Shopping Experience
- Shopping cart functionality
- Wishlist feature
- Product search and filtering
- Product reviews and ratings
- Related products

### Order Management
- Order processing workflow
- Order status tracking
- Invoice generation (PDF)
- Email notifications

## 🔒 Security Features

- CSRF protection
- XSS prevention
- SQL injection protection
- Password hashing
- Role-based access control
- Input validation and sanitization

## 📦 Package Dependencies

### Laravel Packages
- **Laravel Cashier**: Stripe payment integration
- **Spatie Permission**: Role and permission management
- **Laravel Localization**: Multi-language support
- **Laravel PDF**: PDF generation
- **Laravel Charts**: Dashboard analytics

### Frontend Packages
- **Tailwind CSS**: Utility-first CSS framework
- **Alpine.js**: Lightweight JavaScript framework
- **Vite**: Modern build tool

## 🚀 Deployment

### Production Checklist
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Run `php artisan config:cache`
4. Run `php artisan route:cache`
5. Run `php artisan view:cache`
6. Set up queue workers with supervisor
7. Configure web server (Nginx/Apache)
8. Set up SSL certificate
9. Configure backup strategy

### Environment Variables for Production
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password

QUEUE_CONNECTION=redis
REDIS_HOST=your-redis-host
REDIS_PASSWORD=your-redis-password
```

## 🧪 Testing

```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter=TestName
```

## 📝 API Documentation

The application includes API endpoints for:
- User authentication
- Product management
- Order processing
- Cart operations

API routes are defined in `routes/api.php`

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🆘 Support

For support and questions:
- Create an issue in the repository
- Contact the development team
- Check the documentation

## 🔄 Changelog

### Version 1.0.0
- Initial release
- Basic ecommerce functionality
- Admin dashboard
- Multi-language support
- Email notifications
- Queue system

---

**Happy Coding! 🎉**
