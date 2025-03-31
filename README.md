# **Emporia - Classified Ads Management System**

## **Project Overview**
The **Classified Ads Management System** is a web-based platform that allows users to **post advertisements** while providing administrators with tools to **manage and filter ads efficiently**. It includes advanced filtering options for **districts, towns, price ranges, and categories** to enhance the user experience.

This project was developed using **Laravel** for both the **frontend and backend**, following an API-driven architecture. The system features a **dynamic admin panel** for managing users and advertisements.

## **Collaboration with Nemo Technologies (Pvt) Ltd**
This project was developed in collaboration with **Nemo Technologies (Pvt) Ltd**. After reaching out to them, they assigned us the project, which we successfully developed and handed over to the company upon completion.

---

## **Features**
### **User Features:**
✅ User **authentication** with **Google login, Facebook login, Mobile OTP, and email/password login**.  
✅ Post **free and paid advertisements** with images and details.  
✅ **Filter ads** based on **location, price, and category**.  

### **Admin Panel Features:**
✅ **Manage users** (view, edit, delete accounts).  
✅ **Approve, reject, or delete ads**.  
✅ **Filter and search ads** dynamically.  

### **Technical Features:**
✅ **AWS S3 Integration** for secure image storage.  
✅ **API-driven** architecture for **seamless communication** between frontend and backend.  
---

## Folder Structure

### Backend (API) - `backend/`
The backend is built using **Laravel** and serves as the API for the system. It handles user authentication, ad management, and filtering.

#### Key Directories:
- **app/**: Contains the main logic of the application, including controllers, models, and middleware.
- **bootstrap/**: Initializes the application.
- **config/**: Stores configuration files for services such as mail, database, and session.
- **database/**: Contains migrations, factories, and seeders for database tables.
- **public/**: Publicly accessible files like `index.php` to serve the application.
- **resources/**: Contains Blade views for backend admin panel templates and other assets.
- **routes/**: Defines the API and web routes for the application.
- **storage/**: Used for caching, logs, and other file storage needs.
- **tests/**: Includes unit and feature tests for the application.

### Frontend (Admin Panel) - `frontend/`
The frontend is built using **Laravel Blade templates**, **Bootstrap**, and **AJAX**. It communicates with the backend API to provide a dynamic and responsive interface for users and administrators.

#### Key Directories:
- **app/**: Contains the frontend application logic, including controllers and models.
- **bootstrap/**: Initializes the frontend application.
- **config/**: Stores configuration files for frontend-specific services like session and views.
- **database/**: Holds migrations and seeders for frontend-related data.
- **public/**: Contains frontend assets such as images, CSS, and JavaScript files.
- **resources/**: Includes Blade templates for frontend views and static assets like CSS and JavaScript.
- **routes/**: Defines web routes for the frontend application.
- **storage/**: Used for storing frontend-related files.
- **tests/**: Contains feature and unit tests for the frontend application.

---

## Setup Guide
### **1. Clone the Repository**
```sh
git clone https://github.com/MinjanaAP/Software-Project-2nd-Year.git
cd FreeAdsSystem
```

### **2. Backend Setup (Laravel API & Admin Panel)**
```sh
cd backend
composer install
cp .env.example .env
php artisan key:generate
```

- Configure `.env` with your **database** and **AWS S3 credentials**
- Run migrations:
```sh
php artisan migrate --seed
```
- Start the server:
```sh
php artisan serve --port=8008
```

### **3. Frontend Setup (Laravel Blade UI)**
```sh
cd frontend
npm install
npm run dev
```
- Another terminal Run
```sh
php artisan serve
```
---

## API Endpoints
### **Authentication**
- `POST /api/login` – User login
- `POST /api/register` – User registration
- `POST /api/logout` – Logout

### **Admin Panel**
- `GET /api/admin/getTodaysPaidAds` – Get today's paid ads & next ads
- `GET /api/admin/filterAds` – Filter ads by district, town, category, and price

### **Ads Management**
- `POST /api/ads/create` – Post a new ad
- `GET /api/ads` – Get all live ads
- `DELETE /api/ads/{id}` – Delete an ad

---

## Contributions & Credits

### Team Members:

- [**Basuru Jithmal**](https://github.com/basurujithmal)  
  ![Basuru Jithmal](https://avatars.githubusercontent.com/u/username?v=4)  
  _Role: Team Leader_

- [**Pasan Athuluwage**](https://github.com/MinjanaAP)  
  <img src="https://github.com/MinjanaAP.png" alt="Pasan Athuluwage" width="50" height="50" style="border-radius: 50;">  
  _Role: Project Manager & Developer_

- [**Ishari Abesooriya**](https://github.com/ishariabesooriya)  
  ![Ishari Abesooriya](https://avatars.githubusercontent.com/u/username?v=4)  
  _Role: BA & Developer_

- [**Wethma Sithumini**](https://github.com/wethmasithumini)  
  ![Wethma Sithumini](https://avatars.githubusercontent.com/u/username?v=4)  
  _Role: Developer_

- [**Ashini Hasara**](https://github.com/ashinihasara)  
  ![Ashini Hasara](https://avatars.githubusercontent.com/u/username?v=4)  
  _Role: Developer_

---

### Special Thanks to **Nemo Technologies Pvt. Ltd.** for their collaboration and support throughout the project.


I handled **User Authentication, Admin Panel functionalities (User & Ads Management), and all major backend functionalities.**

---

## License
This project is licensed under the MIT License.

---

## Contact
For any queries or collaboration, feel free to reach out to me!

📧 Email: pasanathuluwage28@gmail.com  
👨‍💻 GitHub: [yourusername](https://github.com/MinjanaAP)

