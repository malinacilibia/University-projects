# Women in FinTech Platform — Laravel Web Application

## Overview
This project represents a complete web application developed in **Laravel** using **PHP**, **MySQL**, and **Blade templates**, designed to support and promote women in the **FinTech industry**.  
The platform provides an administrative interface for managing members, events, and success stories.  
It allows adding, editing, filtering, and deleting records in an intuitive dashboard with a responsive, minimalist design.  
The application was developed as part of the *Design and Development of Websites and Web Portals* course .

---

## Application Features

### 1. Members List
The main page displays all registered members, including their name, email, profession, company, LinkedIn profile, and status.  
Users can **filter** members by profession, company, or activity status, and perform CRUD operations such as edit or delete.

![Members List](../screenshots/laravel%20(1).png)

---

### 2. Success Stories
Each member can have one or more success stories associated with their professional journey in FinTech.  
The admin can add, edit, or remove stories that highlight women’s achievements and career development paths.

![Success Stories](../screenshots/laravel%20(2).png)

---

### 3. Events Management
The admin dashboard allows viewing, adding, editing, and deleting events related to FinTech networking and mentoring opportunities.  
Each event includes details such as name, date, and description, and is displayed in a structured table with action buttons.

![Events Management](../screenshots/laravel%20(3).png)

---

## Technologies Used
- **Laravel 10.x (PHP Framework)**  
- **PHP 8.x**  
- **MySQL**  
- **Blade Template Engine**  
- **HTML5, CSS3**  
- **Bootstrap 5**  
- **PhpStorm / VS Code**

---

## How to Run

1. **Clone the repository**
   ```bash
   git clone https://github.com/malinacilibia/University-projects.git
2. Navigate to the Laravel project directory:
   ```bash
   git clone https://github.com/malinacilibia/University-projects.git
3. Install dependencies
   ```bash
   composer install
   npm install
4. Create a .env file
   ```bash
   cp .env.example .env
5. Update your database credentials in .env:
   ```bash
   DB_DATABASE=fintech_db
   DB_USERNAME=root
   DB_PASSWORD=
6. Generate the application key
   ```bash
   php artisan key:generate
7. Run migrations and seed data
   ```bash
   php artisan migrate --seed
8. Start the local development server
   ```bash
   php artisan serve
9. Start the local development server
      ```bash
      php artisan serve











