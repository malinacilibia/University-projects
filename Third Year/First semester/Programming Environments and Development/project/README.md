# Devine Beauty Salon — ASP.NET Core Web Application

## Overview
This project is a web-based salon management system developed in **ASP.NET Core MVC** as part of the *Programming Environments and Development* course.  
The application allows administrators and clients to manage appointments, services, employees, and feedback through an intuitive web interface.  
It follows the required structure by implementing **CRUD operations**, **data validation**, and **authentication & authorization mechanisms**.


## Features

### 1. Home Page
The homepage introduces the salon and its main services, allowing users to explore available options and navigate easily through the platform.

### 2. Administrator Dashboard
After logging in, the administrator has access to a dashboard displaying key management functionalities such as viewing appointments, managing employees, services, and client feedback.

### 3. Appointments Management (Admin)
The administrator can view, search, add, edit, and delete all appointments in the system. Each record includes client, employee, service, date, duration, and status details.

### 4. Client Management
The admin can also view and manage the list of registered clients, including their personal data and contact information.

### 5. Services Management
Administrators can manage the salon’s services — add new ones, edit details, delete existing ones, or filter by category.

### 6. Appointments (Client View)
Clients can log in to view only their own appointments, filtered by date and status, with options to create or cancel appointments.

### 7. Feedback Management
Users can submit and view feedback for services they have used. Feedback includes comments, ratings, and the employee who provided the service.



## Database Structure
The system uses a **relational database** containing the following main entities:

- **Client** — client information and login credentials  
- **Employee** — staff details and assigned roles  
- **Service** — service name, duration, price, and category  
- **Appointment** — links clients, employees, and services with date and status  
- **Feedback** — stores ratings and comments for services and employees  

Each entity supports CRUD operations implemented through dedicated controllers and Razor views.



## Technologies Used
- **ASP.NET Core MVC (C#)**  
- **Entity Framework Core**  
- **SQL Server Database**  
- **Razor Views & Bootstrap**  
- **Authentication and Authorization**

 

## How to Implement
1. **Clone or download the repository.**  
2. Open the solution in **Visual Studio 2022** (or higher).  
3. Configure the connection string in `appsettings.json` to match your local SQL Server instance.  
4. Open the **Package Manager Console** and run the following command to apply migrations:
   ```bash
   update-database
5. Run the project (Ctrl + F5).
6. Register a new account or log in using admin credentials to explore all functionalities.
