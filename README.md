# iPhone Store E-Commerce Platform

A modern e-commerce platform built with PHP for selling iPhones and related accessories. This project provides a complete shopping experience with user authentication, product management, shopping cart functionality, and order processing.

## Features

- 🛍️ **Product Management**
  - Browse products by categories
  - Detailed product descriptions
  - Product search and filtering
  - Admin product management (add/edit/delete)

- 👤 **User Features**
  - User registration and authentication
  - User profile management
  - Wishlist functionality
  - Order history

- 🛒 **Shopping Experience**
  - Shopping cart functionality
  - Checkout process
  - Order summary
  - Category-based browsing

- 👨‍💼 **Admin Panel**
  - Product management
  - Category management
  - Order management
  - User management

## Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Composer (for PHPMailer)

## Installation

1. Clone the repository:
   ```bash
   git clone [repository-url]
   ```

2. Create a MySQL database named `shopping_cart`

3. Configure the database connection:
   - Open `partials/db_connect.php`
   - Update the database credentials:
     ```php
     $server = 'localhost';
     $username = 'your_username';
     $password = 'your_password';
     $db_name = 'shopping_cart';
     ```

4. Import the database schema:
   - Import the provided SQL file into your MySQL database

5. Set up your web server:
   - Point your web server to the project directory
   - Ensure proper permissions are set for file uploads

6. Install PHPMailer dependencies:
   ```bash
   composer install
   ```

## Project Structure

```
iPhone-Store/
├── _admin/           # Admin panel files
├── assets/           # Static assets (CSS, JS, images)
├── auth/             # Authentication related files
├── partials/         # Reusable PHP components
├── PHPMailer/        # Email functionality
├── action.php        # Form actions handler
├── add_product.php   # Add new products
├── all_products.php  # Product listing
├── cart.php          # Shopping cart
├── checkout.php      # Checkout process
├── index.php         # Homepage
└── ...               # Other core files
```

## Usage

1. **User Registration**
   - Navigate to the registration page
   - Fill in your details
   - Verify your email (if configured)

2. **Shopping**
   - Browse products by category
   - Add items to cart
   - Proceed to checkout
   - Complete the order

3. **Admin Panel**
   - Access the admin panel
   - Manage products and categories
   - View and process orders
   - Manage user accounts

## Security Features

- Password hashing
- SQL injection prevention
- XSS protection
- Session management
- Secure file upload handling

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, please open an issue in the GitHub repository or contact the project maintainers.

## Acknowledgments

- PHPMailer for email functionality
- Bootstrap for frontend components
- Font Awesome for icons 
