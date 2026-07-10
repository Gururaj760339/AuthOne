# AutoOne - Automotive Platform

AutoOne is a multilingual automotive platform designed for the Middle East market.  
The platform provides car browsing, car import requests, rental services, finance applications, maintenance booking, and automotive service management.

---

# Setup Instructions

Follow these steps to run the AutoOne project locally.

## Requirements

Make sure you have installed:

- PHP >= 8.2
- Composer
- MySQL
- Laravel Framework
- XAMPP

---

## Installation

### 1. Clone Repository

```bash
git clone https://github.com/your-username/autoone.git

cd autoone

###2. Install Dependencies
##Install Laravel dependencies:
#composer install

###3. Database Configuration
##Open .env file and update your database information:
#DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=autoone
DB_USERNAME=root
DB_PASSWORD=

#Create a MySQL database:
autoone

###4. Run Migration
##Create database tables:
#php artisan migrate

###5. Storage Setup
##Create storage link for uploaded files:
#php artisan storage:link

###6. Run Application
php artisan serve

##Open in browser:
http://127.0.0.1:8000



##Features
- Multilingual support (English, Arabic, German)
- RTL layout support for Arabic language
- Car listing and browsing
- Car import request system
- Car rental service
- Finance application
- Maintenance booking
- Contact inquiry system
- Admin dashboard
- Responsive design

##Technology Stack
-Backend
-PHP
-Laravel
-MySQL
-Frontend
-Blade Template Engine
-Tailwind CSS
-JavaScript

##Tools
-Composer
-NPM

Developed by Guru Raj
-Git
