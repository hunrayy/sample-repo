Wallet Transaction System

This project is a wallet transaction system built with Laravel, providing core functionalities such as transferring money between wallets, logging transactions, and retrieving wallet details.

Features

User Wallets:

Users can have wallets associated with their accounts.

Wallets store a balance that can be updated during transactions.

Money Transfer:

Users can transfer funds between wallets.

The system validates the transaction details to ensure accuracy and prevent errors (e.g., insufficient balance).

Transaction Logs:

All transactions are logged with details such as sender wallet, receiver wallet, and amount.

Each transaction can be retrieved for reference or auditing purposes.

Error Handling:

Comprehensive error handling ensures users are notified of any issues, such as invalid wallet IDs or insufficient balance.

API Endpoints:

Retrieve all wallets.

Get specific wallet details.

Transfer money between wallets.

Installation and Setup

Prerequisites

PHP 8.1 or higher

Composer

Laravel 10

MySQL

A web server (e.g., Apache, Nginx)

Steps to Set Up

Clone the repository:

git clone <repository-url>
cd <repository-folder>

Install dependencies:

composer install

Configure the .env file:

Set your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<your-database-name>
DB_USERNAME=<your-database-username>
DB_PASSWORD=<your-database-password>

Run migrations:

php artisan migrate

Start the development server:

php artisan serve

Access the application in your browser at http://127.0.0.1:8000.

API Endpoints

2. Retrieve All users

Endpoint: GET /api/get-all-users

Description: Retrieves a list of all registered users.

Response Example:

[
    {
        "id": 1,
        "name": "John Doe",
        "email": "johndoe@gmail.com",
        "email_verified_at": null,
        "created_at": "2024-12-16T16:18:28.000000Z",
        "updated_at": "2024-12-16T16:18:28.000000Z"
    },
    {
        "id": 2,
        "name": "Jane Smith",
        "email": "janesmith@gmail.com",
        "email_verified_at": null,
        "created_at": "2024-12-16T16:18:28.000000Z",
        "updated_at": "2024-12-16T16:18:28.000000Z"
    }
]

2. Retrieve All Wallets

Endpoint: GET /api/get-all-wallets

Description: Fetches a list of all wallets with associated user and wallet type details.

Response Example:

[
    {
        "id": 1,
        "user_id": 1,
        "wallet_type_id": 1,
        "balance": "9900.00",
        "created_at": "2024-12-16T16:18:30.000000Z",
        "updated_at": "2024-12-16T16:18:37.000000Z",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "johndoe@gmail.com",
            "email_verified_at": null,
            "created_at": "2024-12-16T16:18:28.000000Z",
            "updated_at": "2024-12-16T16:18:28.000000Z"
        },
        "wallet_type": {
            "id": 1,
            "name": "Premium Wallet",
            "minimum_balance": "5000.00",
            "monthly_interest_rate": "2.50",
            "created_at": "2024-12-16T16:18:27.000000Z",
            "updated_at": "2024-12-16T16:18:27.000000Z"
        }
    }
]

3. Retrieve Wallet Details

Endpoint: GET /api/get-single-wallet/{id}

Description: Fetches details of a specific wallet by its ID.

Response Example:

{
        "id": 3,
        "user_id": 3,
        "wallet_type_id": 3,
        "balance": "4000.00",
        "created_at": "2024-12-16T16:18:30.000000Z",
        "updated_at": "2024-12-16T16:18:30.000000Z",
        "user": {
            "id": 3,
            "name": "John Smith",
            "email": "johnsmith@gmail.com",
            "email_verified_at": null,
            "created_at": "2024-12-16T16:18:28.000000Z",
            "updated_at": "2024-12-16T16:18:28.000000Z"
        },
        "wallet_type": {
            "id": 3,
            "name": "Silver Wallet",
            "minimum_balance": "2000.00",
            "monthly_interest_rate": "1.80",
            "created_at": "2024-12-16T16:18:27.000000Z",
            "updated_at": "2024-12-16T16:18:27.000000Z"
        }
}

4. Transfer Money Between Wallets

Endpoint: POST /api/transactions

Description: Transfers a specified amount of money from one wallet to another.

Request Body:

{
  "from_wallet_id": 1,
  "to_wallet_id": 2,
  "amount": 50.00
}

Response Example:

{
  "message": "Transaction completed successfully! You have successfully transferred $50.00 to Jane Doe.",
  "code": "success",
  "data": {
    "from_wallet_id": 1,
    "to_wallet_id": 2,
    "amount": 50.00
  }
}

Error Responses:

Insufficient balance:

{
  "message": "Opps, looks like you have an insufficient balance",
  "code": "error
}

Invalid wallet IDs:

{
  "error": "Wallet not found"
}

Models and Relationships

Wallet Model

Attributes:

id

user_id

wallet_type_id

balance

Relationships:

user: Each wallet belongs to a user.

walletType: Each wallet is associated with a wallet type.

Transaction Model

Attributes:

id

from_wallet_id

to_wallet_id

amount

Relationships:

fromWallet: A transaction belongs to a sender wallet.

toWallet: A transaction belongs to a receiver wallet.

Error Handling

The application ensures all error scenarios are properly handled with meaningful messages.

Examples:

Invalid wallet IDs.

Insufficient funds in the sender’s wallet.

Attempting to transfer funds to the same wallet.

Security Measures

Validation: All user inputs are validated to prevent malicious activities.

Mass Assignment Protection: Models explicitly define fillable attributes.

Transaction Integrity: Balance updates and transaction logging are atomic to prevent data inconsistencies.











































<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->
