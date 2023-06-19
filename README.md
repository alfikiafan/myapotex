# MyApotex

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)

## Choose Language
[Bahasa Indonesia](README-ID.md) | [English](README.md)

MyApotex is a pharmacy management application built using Laravel. This application provides features to facilitate the management of medicines, user data, sales transactions, and account management.

## 🌟 Features

- **Login**: Login feature that allows admins and cashiers to log into the system.
- **Logout**: Logout feature that allows admins and cashiers to log out of the system.
- **Medicine Data**: Feature that provides information about medicine data, including name, brand, category, stock/quantity, discount, and price.
- **Medicine Search**: Search feature for filtering or searching medicine data based on desired keywords, available for admins and cashiers.
- **Medicine Management**: Feature for admins to add new medicine data, edit existing medicine data, and delete unwanted medicine data.
- **User Accounts**: Feature that provides information about user accounts, including name, email, role, and join date.
- **User Account Search**: Search feature for filtering or searching user accounts based on desired keywords, available for admins.
- **User Account Management**: Feature for admins to add new user accounts and delete unwanted user accounts.
- **Sales Transactions**: Feature that allows admins to view all sales transactions.
- **Create Sales Transaction**: Feature that allows cashiers to add new sales transactions.
- **Profile Editing**: Feature that allows admins and cashiers to view and modify profile information such as name, email, and password.

## ⚙️ Installation

Here are the steps to install MyApotex on your local environment:

1. Clone this repository to your local directory:

```
git clone https://github.com/username/repo.git
```
or download this repository as a zip file.

2. Navigate to the project directory:

```
cd MyApotex
```

3. Copy the `.env.example` file to `.env`:

```
cp .env.example .env
```

4. Set up the database configuration in the `.env` file according to your environment.

5. Run the following command to install PHP dependencies:

```
composer install
```

6. Generate the application key:

```
php artisan key:generate
```

7. Run migrations and seed data:

```
php artisan migrate --seed
```

8. Start the Laravel development server:

```
php artisan serve
```

9. Open your browser and access `http://localhost:8000` to see the MyApotex application.

## 🙌 Credits

MyApotex is built using several resources and libraries, including:

- [Laravel](https://laravel.com)
- [Faker](https://fakerphp.github.io)
- [jQuery](https://jquery.com)
- [Corporate UI](https://www.creative-tim.com/product/corporate-ui-dashboard)

## 👨‍💻 Developer Team

- [Alfiki Diastama Afan Firdaus](https://github.com/alfikiafan)
- [Afif Nur Fauzi](https://github.com/alscheift)
- [Faiz Fathoni](https://github.com/faizfathoni)
- [Hafidh Muhammad Akbar](https://github.com/hafidhmuhammadakbar)

## 🚀 Version

**Current Version: 1.0.0**

## 📄 License

MyApotex is licensed under the [MIT License](https://opensource.org/licenses/MIT).