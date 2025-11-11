# Women in TechPower — PHP Web Portal

## Overview
This project represents a complete web application developed in **PHP** using **XAMPP** and **PhpStorm**, designed to support and promote women in technology.  
The platform provides a collaborative environment where members can access resources, mentorship sessions, events, and job opportunities.  
Administrators can manage users, events, and mentorship activities through a dedicated dashboard.  
The application was developed as part of the **Design and Development of Websites and Web Portals** course at Babeș-Bolyai University (FSEGA).

---

## Application Features

### 1. Home Page  
The homepage introduces the platform’s purpose — empowering women in technology through education, networking, and mentorship.

![Home Page](Third%20Year/First%20semester/Design%20and%20Development%20of%20Websites%20and%20Web%20Portals/screenshots/php%20(2).png)

---

### 2. Video Resources  
A section dedicated to educational and inspirational video materials that promote women in STEM fields.

![Video Resources](Third%20Year/First%20semester/Design%20and%20Development%20of%20Websites%20and%20Web%20Portals/screenshots/php%20(1).png)

---

### 3. Admin Dashboard  
The administrator’s dashboard allows the admin to update their role description, list managed projects, and document contributions to the community.

![Admin Dashboard](Third%20Year/First%20semester/Design%20and%20Development%20of%20Websites%20and%20Web%20Portals/screenshots/php%20(3).png)

---

### 4. User Details  
Displays a list of registered users along with their roles, managed projects, and community involvement details.

![User Details](Third%20Year/First%20semester/Design%20and%20Development%20of%20Websites%20and%20Web%20Portals/screenshots/php%20(4).png)

---

### 5. Event Calendar  
Presents a table of upcoming community events for each month, including the date, name, and type (online/offline).

![Event Calendar](Third%20Year/First%20semester/Design%20and%20Development%20of%20Websites%20and%20Web%20Portals/screenshots/php%20(5).png)

---

### 6. Mentorship Session Scheduling  
Users can schedule mentorship sessions by specifying mentor name, mentee name, date, time, and subject.

![Mentorship Scheduling](Third%20Year/First%20semester/Design%20and%20Development%20of%20Websites%20and%20Web%20Portals/screenshots/php%20(6).png)

---

### 7. Jobs Board  
Includes a job filtering system where users can search and browse open positions related to technology and innovation.

![Jobs Board](Third%20Year/First%20semester/Design%20and%20Development%20of%20Websites%20and%20Web%20Portals/screenshots/php%20(7).png)

---

## Database & Structure
The database includes entities such as **Users**, **Events**, **Jobs**, **Mentorship Sessions**, and **Videos**, with clear relationships and constraints ensuring data integrity.  
The application follows a modular PHP architecture, separating logic, layout, and configuration through individual files (e.g., `config.php`, `index.php`, `dashboard.php`, etc.).  

All interface components are implemented with responsive design principles, ensuring compatibility across devices.

---

## Technologies Used
- **PHP 8.x**  
- **MySQL (via XAMPP)**  
- **HTML5, CSS3, JavaScript**  
- **Bootstrap 5**  
- **PhpStorm IDE**

---

## How to Run
1. **Install XAMPP** and start the Apache and MySQL services.  
2. Copy the project folder into: `C:\xampp\htdocs\`
3. Import the provided SQL file into **phpMyAdmin** to create the database.  
4. Open the project in **PhpStorm** (or another IDE).  
5. Access the platform in your browser at: ` http://localhost/WomenInTechPower/`
6. Log in using an **administrator** or **member** account to explore all sections of the website.


