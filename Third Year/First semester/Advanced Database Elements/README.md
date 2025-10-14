# Children's Palace of Cluj-Napoca — PL/SQL & MongoDB Database Project

## Overview  
This project extends the initial relational database developed for the Children's Palace of Cluj-Napoca by integrating new functionalities and a non-relational (MongoDB) version.  
The goal was to enhance the existing Oracle database using **PL/SQL packages, triggers, and stored procedures** while also **adapting the schema to MongoDB** for document-based data management.  
The system ensures efficient handling of participants, activities, teachers, payments, and scheduling while maintaining data integrity and consistency.


## Structure  
The project includes two main parts:  

1. **PL/SQL Database (Oracle APEX)**  
   - Extension of the original database with new entities and constraints.  
   - Implementation of packages, triggers, and stored procedures for automation and validation.  
   - New tables added: `feedback`, `istoric_plati`, and extended structures with additional columns like `status` and `durata_totala`.  

2. **MongoDB Database**  
   - Document-based redesign of the relational schema.  
   - Creation of three main collections: `participant`, `programare`, and `angajat`.  
   - Use of embedded documents and ObjectId references to represent relationships.  
   - Implementation and testing of CRUD operations and queries using MongoDB Compass and CMD.

## Implementation  

### PL/SQL Section  
- Added new functionalities for tracking appointment overlaps, payment statuses, and participant feedback.  
- Implemented a **package (`palatul_copiilor_package`)** containing public and private procedures and functions:  
  - `adauga_programare`, `seteaza_durata_totala`, `actualizeaza_status_plata`, `afiseaza_feedback_detalii`, `adauga_grupa_varsta`, and `total_si_detalii_tarife`.  
- Created **private functions and procedures** for internal logic such as calculating appointment durations and inserting payment history.  
- Added **triggers** for ensuring data validity:  
  - `trg_check_programare_suprapunere` prevents overlapping appointments.  
  - `trg_check_plati_suma_valida` validates payment amounts and sets default bank names.  

### MongoDB Section  
- Recreated the Oracle database as a document-based schema using embedded data structures.  
- Collections created:  
  - `participant` — stores participant data with nested `tarife` and `adresa` objects.  
  - `programare` — includes activity and payment details within each document.  
  - `angajat` — contains an array of embedded `activitati` objects for each employee.  
- Indexed collections for optimized queries (`experienta`, `salariu`, `grupa_gvd`, `adresa.strada`).  
- Implemented **complex MongoDB queries**, including:  
  - Sorting participants and employees.  
  - Aggregating and grouping by difficulty level.  
  - Calculating the average participant age per age group.


## Purpose  
The project demonstrates an end-to-end approach to database management including **relational design and PL/SQL logic** and **NoSQL document modeling**.  
It provides an integrated system that supports both transactional operations (Oracle) and flexible data management (MongoDB), suitable for real-world educational institutions.

## Technologies Used  
- **Oracle SQL / PL/SQL (Oracle APEX)**  
- **MongoDB & MongoDB Compass**  
- **PL/SQL Packages, Triggers, Cursors, Sequences**  
- **Data Normalization & Referential Integrity**  
- **Aggregation Framework (MongoDB)**
