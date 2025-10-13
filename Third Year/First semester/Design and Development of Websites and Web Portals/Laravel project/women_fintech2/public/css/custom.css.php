/* Fundal general */
body {
    background-color: #f4f0f7; /* Mov deschis */
    font-family: 'Arial', sans-serif;
}

/* Titlul principal */
h1 {
    font-size: 2.5rem;
    font-weight: bold;
    text-align: center;
    color: #6a1b9a;
}

/* Formularul de filtrare */
form {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

/* Tabele */
table {
    border-collapse: collapse;
    width: 100%;
    background-color: #ffffff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

table th, table td {
    padding: 15px;
    text-align: left;
}

table th {
    background-color: #6a1b9a;
    color: #ffffff;
    text-transform: uppercase;
}

table tr:hover {
    background-color: #f2e6ff; /* Fundal mov deschis la hover */
}

/* Butoane */
.btn {
    border-radius: 5px;
    padding: 10px 15px;
    text-transform: uppercase;
    font-weight: bold;
    transition: background-color 0.3s ease-in-out, transform 0.2s ease;
}

.btn:hover {
    transform: scale(1.05);
}

.btn-primary {
    background-color: #6a1b9a;
    color: white;
}

.btn-primary:hover {
    background-color: #7b2cbf;
}

.btn-secondary {
    background-color: #5c5470;
    color: white;
}

.btn-secondary:hover {
    background-color: #73648a;
}

.btn-light {
    background-color: #f4f0f7;
    color: #6a1b9a;
    border: 1px solid #6a1b9a;
}

.btn-light:hover {
    background-color: #e0d4f1;
}

/* Badge-uri */
.badge-success {
    background-color: #4caf50;
}

.badge-secondary {
    background-color: #9e9e9e;
}
