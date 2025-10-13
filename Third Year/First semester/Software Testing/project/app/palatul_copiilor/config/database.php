<?php
// definim clasa Database care gestioneaza conexiunea la baza de date
class Database {
    // proprietatile clasei: informatii despre serverul bazei de date
    private $host = "localhost"; // adresa serverului (de obicei "localhost" pentru dezvoltare locala)
    private $db_name = "gestionare_programari"; // numele bazei de date
    private $username = "root"; // utilizatorul bazei de date (de obicei "root" pentru server local)
    private $password = ""; // parola utilizatorului bazei de date (de obicei goala pentru server local)
    public $conn; // variabila publica pentru stocarea conexiunii

    // metoda pentru obtinerea conexiunii la baza de date
    public function getConnection() {
        $this->conn = null; // initializam conexiunea cu valoarea null
        try {
            // incercam sa cream o noua conexiune PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // setam modul de raportare a erorilor pentru conexiunea PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            // daca apare o eroare, o afisam
            echo "Connection error: " . $exception->getMessage();
        }
        // returnam conexiunea (sau null daca nu s-a realizat)
        return $this->conn;
    }
}
?>
