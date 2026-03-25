<?php
class Database
{
    private static $instance = null;
    private $conn;
    private $host = "localhost";
    private $db_name = "lashop";
    private $username = "root";
    private $password = "";

    private function __construct()
    {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};
                dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() // Singleton pattern to get the single instance of the Database class
    {
        if (self::$instance === null) { // If no instance exists, create one
            self::$instance = new Database(); // This will call the constructor and establish the connection
        }
        return self::$instance;
    }

    public function getConnection()
    {
        // echo "Connected to database successfully!";
        return $this->conn;
    }
}

$db = Database::getInstance(); // to check if the connection is successful
$conn = $db->getConnection(); // You can now use $conn to interact with the database

?>



            
        
