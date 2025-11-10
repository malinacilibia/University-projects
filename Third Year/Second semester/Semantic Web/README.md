# Semantic Web Data Transfer — RDF4J, JSON & GraphQL Integration

## Overview  
This project, titled **RadioShows**, was developed as part of the *Semantic Web* course.  
It demonstrates a complete data transfer flow between multiple servers using **HTTP requests**, **NoSQL data formats**, and **semantic data modeling** principles.  
The system integrates **RDF4J**, **JSON-Server**, **GraphQL-Server**, and a **custom PHP backend** to simulate a realistic multi-source data exchange pipeline.

The application showcases how data about **radio shows and their episodes** can be retrieved, transferred, and extended across multiple servers, preserving relationships and semantic integrity.

---

## Structure  
The project includes the following core components:

1. **Front-End (HTML + JavaScript)**  
   - Interactive page with buttons triggering each transfer step.  
   - AJAX requests to the PHP backend for asynchronous operations.  
   - Dynamic rendering of unified HTML tables after each transfer.  
   - Form for inserting a new record related to an existing radio show via a dropdown list.

2. **Back-End (PHP)**  
   - Manages HTTP communication between all servers.  
   - Executes and chains the 5 data transfer steps:  
     1. Fetch partial data from RDF4J.  
     2. Send retrieved data to JSON-Server (REST).  
     3. Query JSON-Server and re-display unified table.  
     4. Add new data from form + existing data into JSON-GraphQL-Server.  
     5. Retrieve filtered data from GraphQL-Server and display unified result.  
   - Implements data filtering to ensure at least one record remains unqueried.

3. **Dataset (RDF4J Graph: `grafexamen`)**  
   - Modeled after two entities in a one-to-many relationship:  
     - `RadioShow` (one) — show title, host, broadcast day, duration.  
     - `Episode` (many) — guest name, date, topic, related show ID.  
   - Contains at least four properties from **Schema.org** besides `name` and `description`.

---

## Implementation  
- **RDF4J** hosts the initial dataset and exposes it through REST queries.  
- **PHP backend** acts as an intermediary that performs asynchronous requests between servers.  
- **AJAX front-end** visualizes intermediate results and the final unified table.  
- Each transfer uses filtered queries instead of complete dumps, ensuring selective data flow.  
- The system demonstrates both semantic data interoperability and NoSQL communication.

---

## How to Install  

### Prerequisites  
- [XAMPP](https://www.apachefriends.org/) with PHP ≥ 7.4  
- [RDF4J Workbench](https://rdf4j.org/) (default port **8080**)  
- [JSON-Server](https://github.com/typicode/json-server) (port **4000**)  
- [JSON-GraphQL-Server](https://github.com/marmelab/json-graphql-server) (port **3000**)  
- Google Chrome (recommended)

### Setup Steps  

1. **Start RDF4J**  
   - Open [http://localhost:8080/rdf4j-workbench/](http://localhost:8080/rdf4j-workbench/).  
   - Create a new repository named **grafexamen**.  
   - Import the RDF dataset from the `data` folder.

2. **Start JSON-Server**  
   ```bash
   json-server --watch db.json --port 4000
3. **Start JSON-GraphQL-Server**
   ```bash
   json-graphql-server db2.json --port 3000
4. **Run PHP Backend**
- Copy the project folder into htdocs (e.g. C:\xampp\htdocs\CilibiaMalina_RusuNicola).
- Start Apache in XAMPP Control Panel.
- Access the project via:
   ```bash
   http://localhost/CilibiaMalina_RusuNicola/index.html
5. **Interact with the Application**
- Click each button in order (1→5) to execute every transfer step.
- The intermediate and final tables will appear below on the same page.
- Use the form to add a new Episode linked to an existing RadioShow.

---

## Technologies Used  
- **RDF4J (REST API)**  
- **PHP (Backend Logic)**  
- **HTML, CSS, JavaScript (AJAX Front-End)**  
- **JSON-Server (REST)**  
- **JSON-GraphQL-Server (GraphQL)**  
- **Schema.org Ontology**  
- **HTTP Request Handling and Data Filtering**

