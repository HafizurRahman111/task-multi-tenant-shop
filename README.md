# Project Title

## Table of Contents
- [Project Overview](#project-overview)
- [Features](#features)
- [Setup Instructions](#setup-instructions)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Running the Application](#running-the-application)
- [Login Credentials](#login-credentials)
- [Video & Screenshots](#video--screenshots)
- [Contributing](#contributing)
- [License](#license)

## Project Overview
This project is a comprehensive web application designed to manage and streamline product, category, and store data management. Built with Laravel and utilizing multi-tenant architecture, the system allows for seamless organization and management of products, categories, and stores across different tenants. It supports functionalities for store and product management, including CRUD operations for categories and products, making it an ideal solution for e-commerce businesses.

## Features
### Role-Based Authentication
- **Admin**: Full access to all features.
- **Merchant**: Limited access (can only manage their own tenant's data).

### Authentication and Registration
- **Admin Login**: Redirects to Admin Dashboard.
- **Merchant Login**: Redirects to Merchant Dashboard.
- **Merchant Registration**: Admins create tenants; merchants register under an existing tenant.

### Tenant Management
- Admins can create, edit, and delete tenants.
- Merchants cannot manage tenants directly.

### Merchant Management
- Admin can view the list of all merchants, their details, and delete merchants.
- Merchants cannot manage other merchants.

### Store Management
- Admin can manage stores across all tenants, including creating, updating, and deleting stores.
- Merchants can only see and manage stores created under their own tenant. Both Admin and Merchant can view their store’s custom website by clicking on the website link in the store's information.
- The store’s website will display categories and products associated with that store.

### Category & Product Management
- **Admins**: Manage all categories and products.
- **Merchants**: Manage only their own tenant’s categories and products.
- Products are displayed on the store’s custom e-commerce website.

### Custom E-commerce Storefront:
- Merchants and Admins can view their store's website, which is a custom e-commerce storefront.

### Profile Management
- Admins and Merchants can view their profiles and tenant information.

### Multi-Tenant Support
- Each store operates independently, ensuring data privacy and segregation.

### User-Friendly Interface
- Intuitive design for easy navigation and management.

## Setup Instructions
### Prerequisites
Ensure the following are installed:
- PHP (8.1+)
- Laravel (9.x+)
- MySQL
- Web Server (Apache/Nginx)
- Composer
- Node.js & npm
- Git

### Installation
#### Clone the Repository
```bash
git clone <repository-url>
cd <project-folder>
```

#### Install Dependencies
```bash
composer install
```

#### Set Up Database
1. Start your web server (e.g., XAMPP, WAMP, Laravel Homestead).
2. Create a new MySQL database:
```sql
CREATE DATABASE <database-name>;
```
3. Update `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<database-name>
DB_USERNAME=root
DB_PASSWORD=
```

#### Generate Application Key
```bash
php artisan key:generate
```

#### Run Migrations & Seeders
```bash
php artisan migrate --seed
```

#### Install Front-End Dependencies (Optional)
```bash
npm install
npm run dev
```

## Running the Application
```bash
php artisan serve
```
Access at:
```
http://127.0.0.1:8000
```

## Login Credentials
### Admin Account
- **Email**: `admin@example.com`
- **Password**: `admin1234`

### Merchant Accounts
- **Merchant 1**
  - **Email**: `merchant11@example.com`
  - **Password**: `merchant11`
- **Merchant 2**
  - **Email**: `merchant22@example.com`
  - **Password**: `merchant22`

### Tenant Created for a New Merchant registration
- **Tenant Info**
 - **Name**: `Test Tenant Merchant`
- **Email**: `test@example.com`

## Video & Screenshots
- **Demo Video**: [Link]
- **Screenshots**: [Link]

## Contributing


## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Additional Notes
- Ensure `.env` is properly configured.
- Use `php artisan serve` for local development.
- For production, configure a web server (e.g., Apache, Nginx) to serve the Laravel application.
