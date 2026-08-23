# MEGA BOTT

A Laravel-based **crypto trading, investment, staking, and referral management platform** designed to provide users with a centralized dashboard for managing cryptocurrency activities, investment plans, earnings, transactions, and referral-based commissions.

## Features

* 💱 **Crypto Trading** — Cryptocurrency trading functionality with support for multiple trading pairs and market data.

* 💰 **Investment Management** — Users can participate in investment plans and track their investments, returns, and transaction history.

* 📈 **Trading & Market Data** — Integration of cryptocurrency market data and pricing information for trading-related operations.

* 🪙 **Staking System** — Users can participate in staking plans and manage their staking activities and earnings.

* 🤝 **Referral & Matrix System** — Multi-level referral structure with commission and team-based earning management.

* 💳 **Wallet & Transactions** — Wallet-based balance management with deposits, withdrawals, earnings, and transaction tracking.

* 📊 **User Dashboard** — Centralized dashboard for monitoring investments, trading activities, wallet balance, earnings, and team performance.

* 🧮 **Profit & Commission Calculation** — Automated calculation of investment returns, trading-related earnings, and referral commissions.

* 🔐 **Authentication & User Management** — Secure authentication and user account management.

* 📱 **Responsive Interface** — Responsive web interface designed for desktop and mobile users.

## Tech Stack

### Backend

* PHP
* Laravel
* REST APIs

### Frontend

* Blade
* HTML5
* CSS3
* JavaScript
* jQuery
* Bootstrap
* Vite

### Database

* MySQL

### Other Technologies

* AJAX
* Cryptocurrency APIs / Market Data APIs
* Composer
* npm

## Prerequisites

* PHP = 5.6
* Composer
* Node.js & npm
* MySQL
* Git

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/abhisirohi72/megabott.git

cd megabott
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node dependencies

```bash
npm install
```

### 4. Set up environment file

```bash
cp .env.example .env

php artisan key:generate
```

### 5. Configure the database

Update the `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=megabott
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Run migrations

```bash
php artisan migrate
```

If the project contains seeders:

```bash
php artisan db:seed
```

### 7. Build frontend assets

For production:

```bash
npm run build
```

For development with hot reload:

```bash
npm run dev
```

### 8. Start the Laravel development server

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```

## Platform Workflow

```text
                    MEGA BOTT
                        │
        ┌───────────────┼────────────────┐
        │               │                │
     Trading        Investment        Staking
        │               │                │
        └───────────────┼────────────────┘
                        │
                    User Wallet
                        │
              ┌─────────┴─────────┐
              │                   │
          Earnings            Transactions
              │                   │
              └─────────┬─────────┘
                        │
                Referral / Matrix
                        │
                 Team Commissions
```

## Core Modules

### User Management

* User registration and authentication
* Profile management
* Account verification
* User dashboard
* Account activity tracking

### Wallet & Transactions

The wallet module manages user balances and financial transactions across the platform.

Supported transaction categories may include:

* Deposits
* Withdrawals
* Investment transactions
* Trading transactions
* Staking earnings
* Referral commissions
* Profit/earning transactions

### Investment Management

Users can select available investment plans and monitor:

* Investment amount
* Plan duration
* Expected returns
* Investment status
* Earnings
* Transaction history

### Trading Module

The trading module provides functionality for managing cryptocurrency trading activities, including:

* Trading pairs
* Buy / Sell operations
* Market pricing
* Order-related records
* Trading history
* Profit/loss tracking

### Staking Module

The staking module allows users to participate in available staking plans and track:

* Staking amount
* Staking duration
* Earnings
* Staking status
* Transaction history

### Referral & Matrix System

The referral system manages user relationships and multi-level team structures.

```text
                    Root User
                       │
             ┌─────────┴─────────┐
             │                   │
          User A               User B
             │                   │
        ┌────┴────┐         ┌────┴────┐
      User C    User D     User E    User F
```

The system can be used to manage:

* Referral relationships
* Team hierarchy
* Level-based commissions
* Referral earnings
* Team performance

## Project Structure

```text
megabott/

├── app/
│   ├── Console/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   └── Services/
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
│
├── public/
│
├── resources/
│   ├── views/
│   ├── js/
│   └── css/
│
├── routes/
│   ├── web.php
│   └── api.php
│
├── storage/
│
├── tests/
│
├── .env.example
├── artisan
├── composer.json
├── package.json
└── vite.config.js
```

## Security

The platform follows standard Laravel security practices including:

* Authentication and authorization
* CSRF protection
* Request validation
* Password hashing
* Session management
* API authentication
* Secure database interactions through Laravel's ORM/query builder

## Performance & Scalability

The application is designed with a modular Laravel architecture to support:

* Scalable database operations
* Reusable business logic
* API integrations
* Background processing
* Transaction management
* Modular feature development

## License

This project is proprietary software. All rights reserved.

## Project

**MEGA BOTT**
Crypto Trading & Investment Platform

## Contact

**Abhishek Sirohi**

📧 [abhisirohi72@gmail.com](mailto:abhisirohi72@gmail.com)

🔗 GitHub: https://github.com/abhisirohi72
