# Palatul Copiilor Cluj — Web Application & Software Testing Project

## Overview
This project represents a complete web application developed in **PHP** using **WAMP** and **PhpStorm**, designed for managing educational and recreational activities for the *Palatul Copiilor Cluj-Napoca*.  
The system supports two user roles — **Professor** and **Participant** — each with distinct permissions and interfaces.  
In addition, the project includes a **software testing component**, documented separately in the attached Word report.


## Application Features

### 1. Home Page
The homepage introduces the platform’s purpose — managing activities, participants, schedules, and payments efficiently.

![First Page](../screenshots/First%20page.png)


### 2. Professor Dashboard
After login, professors have access to a dashboard summarizing all available management options: participants, employees, activities, schedules, and payments.

![Professor Page](../screenshots/Profesor%20page.png)


### 3. Participants Management (Professor Role)
Professors can view, add, edit, or delete participants, and filter them by group or name.

![Participants Page](../screenshots/Participants%20page.png)


### 4. Appointments Management (Professor Role)
This section allows professors to see all scheduled activities, including date, start and end time, and participant names.

![All Appointments Page](../screenshots/All%20apointments%20page.png)


### 5. Users Management (Professor Role)
Professors can manage all users registered on the platform, viewing their avatars, emails, and assigned roles.

![Users Page](../screenshots/Users%20page.png)


### 6. Appointments (Participant Role)
Participants can log in and manage their own appointments — adding new ones or checking upcoming scheduled activities.

![Participant Appointment Page](../screenshots/Participant%20appointment%20page%20.png)


### 7. Help and Support
The **Help** page provides guidance for using the platform, including details on how to manage activities, schedule sessions, handle payments, and contact administrators.  
It also includes sections for **frequently asked questions (FAQ)** and **contact support** for additional assistance.

![Help Page](../screenshots/Help%20page.png)



## Database & Localization
The database is structured around the main entities: **Participants**, **Employees**, **Activities**, **Appointments**, **Payments**, and **Users**, ensuring referential integrity.  
The application includes **multi-language support (Romanian and English)** via dedicated translation files located in the `lang` directory, with a **language selector** available in the navigation bar.


## Software Testing Summary
The project includes a detailed testing process described in the document  
**`Proiect testarea produselor software.docx`**, covering:

- Functional testing of login, CRUD operations, and access control  
- Bug reports with severity levels  
- Test cases covering 100% of the main functionalities  
- Automation using **AutoIt scripts** for repetitive tasks (login, registration, activity creation)  
- Performance testing for page load times  
- Localization testing for multilingual support  

All metrics, bug lists, and detailed test results can be found in the accompanying Word document.



## Technologies Used
- **PHP 8.x**  
- **MySQL (via WAMP)**  
- **HTML, CSS, JavaScript**  
- **PhpStorm IDE**  
- **AutoIt** (for test automation)


## How to Run
1. **Install WAMP** and start Apache and MySQL services.  
2. Place the project folder in: C:\wamp64\www\
3. Import the provided SQL file into **phpMyAdmin**.  
4. Open the project in **PhpStorm** (or your preferred IDE).  
5. Access the application at: http://localhost/palatul-copiilor/
6. Log in using either a **Professor** or **Participant** account to explore the different features.
