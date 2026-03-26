<?php
require_once "database.php";
require_once "user.php";

class Transaction extends User
{
    public $amount;

    public function __contruct($amount)
    {
        $this->amount = $amount;
    }

    public static function getTranscation()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        try {
            $stmt = $conn->prepare("SELECT * FROM user_transcation");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching data transcation " . $e->getMessage();
        }
    }

    public static function createTranscation($amount)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        try {
            $stmt = $conn->prepare("INSERT INTO user_transcation (amount) VALUES (:amounth");
            $stmt->bindParam(":amounth", $amount);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error creating transcation: " . $e->getMessage();
        }
    }
    public static function deleteTranscation($id)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        try {
            $stmt = $conn->prepare("DELETE FROM user_transcation WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error delete transcation: " . $e->getMessage();
        }
    }
    public static function updateTranscation($id, $amount)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        try {
            $stmt = $conn->prepare("UPDATE user_transcation SET amount = :amount WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":amount", $amount);
        } catch (PDOException $e) {
            echo "Error update transcation:" . $e->getMessage();
        }
    }
}
