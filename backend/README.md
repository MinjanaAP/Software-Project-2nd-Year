

# Classified Ads Management System - Backend

This is the backend for the **Classified Ads Management System**, developed using **Laravel**. The system allows users to post classified ads, and administrators can manage and filter these ads based on various parameters such as location, category, and price range. The backend is responsible for handling authentication, managing ads, and providing an API for the frontend to interact with.

## Table of Contents
- [Installation](#installation)
- [Environment Variables](#environment-variables)
- [Endpoints](#endpoints)
- [Project Structure](#project-structure)
- [Technologies Used](#technologies-used)
- [Contributions & Credits](#contributions--credits)

## Installation

### Requirements
- PHP >= 8.0
- Laravel 8.x or above
- Composer
- MySQL or other database engines supported by Laravel
- Redis (for caching and sessions)
- Node.js (for running frontend assets)

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/MinjanaAP/Software-Project-2nd-Year.git
   cd backend


2. **Install Dependencies**
   Run the following command to install the required dependencies via Composer:
   ```bash
   composer install
   ```

3. **Set Up Environment Variables**
   Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```

4. **Configure Environment Variables**
   Open the `.env` file and update the database and other environment variables like:
   - `DB_CONNECTION`
   - `DB_HOST`
   - `DB_PORT`
   - `DB_DATABASE`
   - `DB_USERNAME`
   - `DB_PASSWORD`

5. **Generate Application Key**
   Run the following Artisan command to generate the application key:
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations**
   Run the migrations to set up the database tables:
   ```bash
   php artisan migrate
   ```

7. **Install Frontend Dependencies**
   Run the following command to install frontend dependencies using npm:
   ```bash
   npm install
   ```

8. **Run the Application**
   After configuring everything, run the server using:
   ```bash
   php artisan serve --port=8008
   ```
   The backend should now be running on `http://127.0.0.1:8008`.

## Environment Variables

This project requires the following environment variables to be set up in the `.env` file:

- **APP_NAME**: Name of the application.
- **APP_ENV**: The environment the application is running in (e.g., local, production).
- **APP_KEY**: Application key (generated using `php artisan key:generate`).
- **APP_DEBUG**: Set to `true` for debugging purposes in development.
- **DB_CONNECTION**: The database connection type (e.g., `mysql`).
- **DB_HOST**: Database server address.
- **DB_PORT**: Database port (default is `3306`).
- **DB_DATABASE**: The name of the database.
- **DB_USERNAME**: Database username.
- **DB_PASSWORD**: Database password.
- **CACHE_DRIVER**: Cache driver (set to `redis` for better performance).

## Endpoints

### Authentication
- **POST** `/api/login`: Login with email and password.
- **POST** `/api/register`: Register a new user.
- **POST** `/api/google-login`: Google login integration.
- **POST** `/api/facebook-login`: Facebook login integration.
- **POST** `/api/otp-login`: Login using OTP sent via SMS.

### Ads Management
- **GET** `/api/ads`: Get all live ads.
- **POST** `/api/ads`: Create a new ad (admin only).
- **PUT** `/api/ads/{id}`: Update an ad (admin only).
- **DELETE** `/api/ads/{id}`: Delete an ad (admin only).
- **GET** `/api/ads/{id}`: Get details of a specific ad.

### Admin Panel
- **GET** `/api/admin/ads`: Get all ads in the admin panel (live, pending, and archived).
- **POST** `/api/admin/ads/filter`: Filter ads based on district, town, price range, and category.

### User Management
- **GET** `/api/users`: Get all users (admin only).
- **GET** `/api/users/{id}`: Get details of a specific user (admin only).

## Project Structure

The Laravel project is organized as follows:

```
/classified-ads-backend
│
├── /app
│   ├── /Http
│   │   ├── /Controllers         # All controller classes (AdsController, AuthController, etc.)
│   │   └── /Middleware          # Custom middleware classes
│   ├── /Models                  # Eloquent models (Ad, User, Category, etc.)
│   └── /Providers               # Service providers
│
├── /database
│   ├── /migrations              # Database migrations
│   ├── /seeds                   # Database seeders
│   └── /factories               # Factory files for generating test data
│
├── /routes
│   ├── api.php                  # API route definitions
│   └── web.php                  # Web route definitions (if needed)
│
├── /config                      # Configuration files (database, cache, etc.)
├── /resources
│   ├── /views                   # Blade views for admin panel (if using Laravel’s Blade for admin panel)
│   └── /lang                    # Language files for translations
│
├── /public                       # Publicly accessible files like images, scripts
│   └── /uploads                  # Folder for uploaded images, documents, etc.
│
├── /tests                        # Test files
├── /vendor                       # Installed dependencies
└── .env                           # Environment variables
```

### Key Files:
- **/app/Http/Controllers/AdsController.php**: Manages the logic for creating, updating, and retrieving ads.
- **/app/Http/Controllers/AuthController.php**: Handles user authentication (login, registration, OTP, etc.).
- **/app/Models/Ad.php**: Eloquent model for the ads table.
- **/routes/api.php**: Contains all API routes for ads, users, authentication, etc.

## Technologies Used

- **Laravel**: PHP framework used for building the backend.
- **MySQL**: Database system for storing user and ad data.
- **Redis**: Used for caching and session management.
- **JWT Authentication**: Used for secure user authentication.
- **Google, Facebook, OTP**: Third-party authentication methods for user login.

## Contributions & Credits

This project is a collaboration with **Nemo Technologies Pvt. Ltd.**, which provided support and guidance throughout the development process.

### Team Members:
- **[Basuru Jithmal](https://github.com/basurujithmal)** - Developer
- **[Pasan Athuluwage](https://github.com/MinjanaAP)** - PM & Developer
- **[Ishari Abesooriya](https://github.com/ishariabesooriya)** - BA & Developer
- **[Wethma Sithumini](https://github.com/wethmasithumini)** - Developer
- **[Ashini Hasara](https://github.com/ashinihasara)** - Developer

---

### Special Thanks to **Nemo Technologies Pvt. Ltd.** for their collaboration and support throughout the project.
```

This README file will provide a clear and comprehensive guide to your backend project. You can update the GitHub links for the team members to their respective profiles.
