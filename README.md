# Vehicle Tax Reminder

A Laravel-based web application to help users manage vehicle data and remind them of vehicle tax payment schedules.

## Features

- User authentication (login & logout)
- Main dashboard
- Vehicle data management (add, edit)
- Vehicle tax reminder/renewal
- Notifications (integrated with Twilio for SMS)
- User-friendly web interface

## Installation

1. Clone this repository
2. Run `composer install`
3. Copy the `.env.example` file to `.env` and adjust the database and Twilio configuration
4. Run `php artisan key:generate`
5. Run the database migration: `php artisan migrate`
6. Start the local server: `php artisan serve`

## Configuration

- Make sure to fill in the database configuration in the `.env` file
- For SMS notifications, provide the Twilio configuration in the `.env` file