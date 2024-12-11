<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "Mehdi@123";
    private $database = "ElMountada";

    public function connectDb() {
        $dsn = "mysql:host=" . $this->servername . ";dbname=" . $this->database;
        try {
            $conn = new PDO($dsn, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully to the database"; 
            return $conn;
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
            exit();
        }
    }

    public function disconnectDb(&$conn) {
        $conn = null;
    }

    public function executeQuery($conn, $query, $params = []) {
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "Query failed: " . $ex->getMessage();
            return [];
        }
    }
}
?>
