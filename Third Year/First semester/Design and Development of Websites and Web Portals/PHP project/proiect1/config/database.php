<?php
class Database {
    // proprietatea care specifica host-ul serverului MySQL
    private $host = "localhost";
    // numele bazei de date
    private $db_name = "women_tech_power";
    // numele utilizatorului pentru conectare
    private $username = "root";
    // parola utilizatorului
    private $password = "";
    // obiectul conexiunii la baza de date
    public $conn;

    // metoda care initializeaza conexiunea la baza de date
    public function getConnection() {
        $this->conn = null; // initializeaza conexiunea cu null
        try {
            // creeaza o noua conexiune PDO cu parametrii specificati
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password);

            // seteaza modul de raportare a erorilor ca exceptii
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            // afiseaza un mesaj de eroare daca conexiunea esueaza
            echo "Conexiune esuata: " . $exception->getMessage();
        }
        // returneaza conexiunea la baza de date
        return $this->conn;
    }
}
?>
