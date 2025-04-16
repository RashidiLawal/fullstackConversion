# Places App - PHP Version

This is a PHP version of the Places App, which allows users to manage and share places.

## Features

- User authentication (login/logout)
- View all users
- Add new places
- Edit existing places
- Delete places
- View places by user

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- PDO PHP Extension
- MySQL PHP Extension

## Installation

1. Clone the repository to your web server's document root:
   ```bash
   git clone <repository-url> places-app
   ```

2. Create a MySQL database:
   ```sql
   CREATE DATABASE places_app;
   ```

3. Import the database schema:
   ```bash
   mysql -u your_username -p places_app < config/schema.sql
   ```

4. Configure the application:
   - Copy `config/config.php` to `config/config.local.php`
   - Update the database credentials and site URL in `config/config.local.php`

5. Set up your web server:
   - Point the document root to the `public` directory
   - Ensure the web server has write permissions for the session directory

## Configuration

Edit `config/config.local.php` with your settings:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'places_app');
define('SITE_URL', 'http://localhost/places-app');
```

## Usage

1. Access the application through your web browser
2. Register a new user or login with existing credentials
3. Start adding and managing places

## Security Features

- Password hashing using PHP's built-in functions
- Prepared statements to prevent SQL injection
- Input validation and sanitization
- Session-based authentication
- CSRF protection for forms

## Directory Structure

```
places-app/
├── config/
│   ├── config.php
│   ├── config.local.php
│   ├── database.php
│   └── schema.sql
├── public/
│   └── index.php
└── src/
    ├── places/
    │   └── pages/
    ├── users/
    │   └── pages/
    └── shared/
        └── components/
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details. 