# Classified Ads Management System - Frontend

This is the frontend for the **Classified Ads Management System**, developed using **Laravel**. The frontend allows users to view, filter, and interact with the ads posted by users, and administrators can manage the ads through a dynamic admin panel.

The frontend uses **Laravel Blade** for templating, **Bootstrap** for responsive design, and **AJAX** for dynamic content loading. It interacts with the backend API to display and manage classified ads.

## Table of Contents
- [Installation](#installation)
- [Environment Variables](#environment-variables)
- [Frontend Structure](#frontend-structure)
- [Technologies Used](#technologies-used)
- [Contributions & Credits](#contributions--credits)

## Installation

### Requirements
- PHP >= 8.0
- Laravel 8.x or above
- Composer
- Node.js (for running frontend assets)

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/MinjanaAP/Software-Project-2nd-Year.git
   cd frontend


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
   Open the `.env` file and update the necessary environment variables like:
   - `APP_URL`: URL of your frontend (e.g., `http://localhost`).
   - `BACKEND_URL`: URL of the backend API (e.g., `http://localhost:8008`).

5. **Generate Application Key**
   Run the following Artisan command to generate the application key:
   ```bash
   php artisan key:generate
   ```

6. **Install Frontend Dependencies**
   Run the following command to install frontend dependencies using npm:
   ```bash
   npm install
   ```

7. **Compile Assets**
   After installing the dependencies, compile the frontend assets:
   ```bash
   npm run dev
   ```

8. **Run the Application**
   After everything is set up, run the Laravel server using:
   ```bash
   php artisan serve
   ```
   The frontend should now be running on `http://127.0.0.1:8000`.

## Environment Variables

This project requires the following environment variables to be set up in the `.env` file:

- **APP_NAME**: The name of the application.
- **APP_ENV**: The environment the application is running in (e.g., local, production).
- **APP_KEY**: Application key (generated using `php artisan key:generate`).
- **APP_URL**: URL for the frontend application (e.g., `http://localhost`).
- **BACKEND_URL**: URL for the backend API (e.g., `http://localhost:8000`).

## Frontend Structure

The Laravel frontend is organized as follows:

```
/classified-ads-frontend
│
├── /app
│   ├── /Http
│   │   ├── /Controllers         # All controller classes (e.g., AdminController, AdController)
│   ├── /Models                  # Eloquent models (e.g., Ad, Category, User)
│   └── /Providers               # Service providers
│
├── /resources
│   ├── /views                   # Blade views for displaying pages
│   ├── /js                      # JavaScript files (AJAX calls for dynamic content)
│   └── /sass                    # SCSS or CSS files
│
├── /public                       # Publicly accessible files like images, scripts
│   └── /uploads                  # Folder for uploaded images, documents, etc.
│
├── /routes
│   └── web.php                  # Web routes definitions for frontend views
│
├── /resources/lang               # Language files for translations
├── /config                       # Configuration files for frontend
└── .env                           # Environment variables
```

### Key Files:
- **/app/Http/Controllers/AdController.php**: Handles displaying ads on the frontend.
- **/resources/views/**: Contains the Blade views that structure the frontend pages (e.g., home page, ads listing, ad details, admin panel).
- **/resources/js/**: JavaScript files for dynamic interaction using AJAX (e.g., handling ad filtering).
- **/routes/web.php**: Contains all routes for serving Blade views and handling frontend logic.

## Technologies Used

- **Laravel**: PHP framework for building the frontend.
- **Bootstrap**: CSS framework used for responsive design.
- **AJAX/jQuery**: Used to dynamically load ads and manage interactions without refreshing the page.
- **Blade**: Templating engine used to structure the HTML views.
- **SASS/SCSS**: CSS preprocessor for styling.
- **Laravel Mix**: Asset compilation tool for managing frontend assets like JavaScript, CSS, and images.

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

