# 📅 Appointments Booking API

A comprehensive RESTful API built with Laravel 12 for managing appointment bookings between service providers and clients. The API supports JWT authentication via Laravel Sanctum, email notifications, and a complete appointment management system.

## 🚀 Features

- **User Management**: Support for multiple user roles (Admin, Provider, Client)
- **Service Management**: Create and manage services offered by providers
- **Appointment Booking**: Complete appointment lifecycle management
- **Available Slots**: Manage provider availability
- **JWT Authentication**: Secure API authentication using Laravel Sanctum
- **Email Notifications**: Built-in email support for appointment confirmations
- **Role-based Access**: Different permissions for different user types

## 🛠️ Tech Stack

- **Framework**: Laravel 12
- **PHP Version**: ^8.2
- **Authentication**: Laravel Sanctum (JWT)
- **Database**: MySQL/PostgreSQL/SQLite
- **Email**: Laravel Mail with multiple driver support
- **Testing**: PHPUnit

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- Database (MySQL, PostgreSQL, or SQLite)
- Mail server (optional, for email notifications)

## ⚡ Quick Start

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd Appointments_Booking
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure your `.env` file**
   ```env
   # Database Configuration
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=appointments_booking
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

   # Mail Configuration
   MAIL_MAILER=smtp
   MAIL_HOST=your_smtp_host
   MAIL_PORT=587
   MAIL_USERNAME=your_email@example.com
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your_email@example.com
   MAIL_FROM_NAME="Appointments Booking"

   # Sanctum Configuration
   SANCTUM_STATEFUL_DOMAINS=localhost:3000,127.0.0.1:3000
   ```

5. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   # Or use the dev script for full development environment
   composer run dev
   ```

## 🗄️ Database Schema

### Users Table
- `id`: Primary key
- `name`: User's full name
- `email`: Email address (unique)
- `password`: Hashed password
- `role`: User role (admin, provider, client)
- `phone`: Contact phone number
- `email_verified_at`: Email verification timestamp

### Services Table
- `id`: Primary key
- `provider_id`: Foreign key to users table
- `name`: Service name
- `description`: Service description
- `price`: Service price (decimal)
- `duration_minutes`: Service duration in minutes

### Appointments Table
- `id`: Primary key
- `client_id`: Foreign key to users table
- `provider_id`: Foreign key to users table
- `service_id`: Foreign key to services table
- `date`: Appointment date
- `start_time`: Appointment start time
- `end_time`: Appointment end time
- `status`: Appointment status (pending, confirmed, cancelled, completed)
- `notes`: Additional notes

### Available Slots Table
- `id`: Primary key
- `provider_id`: Foreign key to users table
- Additional time slot management fields

## 🔐 Authentication

The API uses Laravel Sanctum for JWT-based authentication. 

### Getting Started with Authentication

1. **Register/Create a user** (if registration endpoint exists)
2. **Login to get a token**
   ```bash
   POST /api/login
   {
     "email": "user@example.com",
     "password": "password"
   }
   ```
3. **Use the token in subsequent requests**
   ```bash
   Authorization: Bearer {your_token}
   ```

### Protected Routes
Most API endpoints require authentication. Include the `Authorization` header with your Bearer token.

## 📚 API Endpoints

### Users
- `GET /api/users` - List all users
- `POST /api/users` - Create a new user
- `GET /api/users/{id}` - Get user by ID
- `PUT /api/users/{id}` - Update user
- `DELETE /api/users/{id}` - Delete user

### Services
- `GET /api/services` - List all services
- `POST /api/services` - Create a new service
- `GET /api/services/{id}` - Get service by ID
- `PUT /api/services/{id}` - Update service
- `DELETE /api/services/{id}` - Delete service
- `GET /api/services/provider/{id}` - Get services by provider

### Appointments
- `GET /api/appointments` - List all appointments
- `POST /api/appointments` - Create a new appointment
- `GET /api/appointments/{id}` - Get appointment by ID
- `PUT /api/appointments/{id}` - Update appointment
- `DELETE /api/appointments/{id}` - Delete appointment
- `GET /api/appointment/client/{id}` - Get appointments by client
- `GET /api/appointment/provider/{id}` - Get appointments by provider
- `GET /api/appointment/service/{id}` - Get appointments by service

### Available Slots
- `GET /api/available-slots` - List all available slots
- `POST /api/available-slots` - Create a new slot
- `GET /api/available-slots/{id}` - Get slot by ID
- `PATCH /api/available-slots/{id}` - Update slot
- `DELETE /api/available-slots/{id}` - Delete slot
- `GET /api/available-slots/provider/{id}` - Get slots by provider

## 📧 Email Configuration

The application supports multiple email drivers:

### SMTP Configuration (Recommended)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

### Other Supported Drivers
- **Postmark**: Set `MAIL_MAILER=postmark`
- **Amazon SES**: Set `MAIL_MAILER=ses`
- **Resend**: Set `MAIL_MAILER=resend`
- **Log**: Set `MAIL_MAILER=log` (for development)

## 👥 User Roles

The system supports three user roles:

### 🔧 Admin
- Full system access
- Can manage all users, services, and appointments
- System configuration access

### 👨‍⚕️ Provider
- Can create and manage their services
- Can manage their available time slots
- Can view and manage their appointments
- Can update appointment status

### 👤 Client
- Can view available services
- Can book appointments
- Can view their own appointments
- Can cancel their appointments

## 🧪 Testing

Run the test suite:

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/AppointmentTest.php
```

## 🚀 Development

### Using the Development Script
```bash
composer run dev
```
This command starts:
- Laravel development server
- Queue worker
- Log monitoring (Pail)
- Vite development server

### Code Quality
```bash
# Format code with Pint
./vendor/bin/pint

# Run static analysis
./vendor/bin/phpstan analyse
```

## 📦 Deployment

### Production Setup

1. **Environment Configuration**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Database Migration**
   ```bash
   php artisan migrate --force
   ```

3. **Optimize for Production**
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan optimize
   ```

## 🔧 Configuration

### Queue Configuration
For email notifications and background jobs:
```env
QUEUE_CONNECTION=database
# Or use Redis for better performance
QUEUE_CONNECTION=redis
```

### Sanctum Configuration
```env
SANCTUM_STATEFUL_DOMAINS=your-frontend-domain.com
SESSION_DRIVER=cookie
SESSION_LIFETIME=120
```

## 📝 Example Usage

### Creating an Appointment
```bash
POST /api/appointments
Authorization: Bearer {token}
Content-Type: application/json

{
  "client_id": 1,
  "provider_id": 2,
  "service_id": 1,
  "date": "2024-01-15",
  "start_time": "09:00:00",
  "end_time": "10:00:00",
  "notes": "First-time consultation"
}
```

### Response
```json
{
  "message": "Appointment created successfully",
  "appointment": {
    "id": 1,
    "client_id": 1,
    "provider_id": 2,
    "service_id": 1,
    "date": "2024-01-15",
    "start_time": "09:00:00",
    "end_time": "10:00:00",
    "status": "pending",
    "notes": "First-time consultation",
    "created_at": "2024-01-10T10:00:00.000000Z",
    "updated_at": "2024-01-10T10:00:00.000000Z"
  }
}
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

If you encounter any issues or have questions:

1. Check the [Issues](../../issues) section
2. Create a new issue if your problem isn't already reported
3. Provide detailed information about your environment and the problem

## 🙏 Acknowledgments

- Built with [Laravel](https://laravel.com/)
- Authentication powered by [Laravel Sanctum](https://laravel.com/docs/sanctum)
- Email functionality via [Laravel Mail](https://laravel.com/docs/mail)

---

**Happy Coding! 🎉**
