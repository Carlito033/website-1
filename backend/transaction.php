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

    public static function getTransaction()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        try {
            $stmt = $conn->prepare("SELECT * FROM user_transactions");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching data transaction " . $e->getMessage();
        }
    }

    public static function createTransaction($amount)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        try {
            $stmt = $conn->prepare("INSERT INTO user_transactions (amount) VALUES (:amounth");
            $stmt->bindParam(":amount", $amount);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error creating transaction: " . $e->getMessage();
        }
    }
    public static function updateTransaction($id, $amount)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        try {
            $stmt = $conn->prepare("UPDATE user_transactions SET amount = :amount WHERE transaction_id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":amount", $amount);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error update transaction:" . $e->getMessage();
        }
    }

    public static function getSpecificTransaction($id)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        try {
            $stmt = $conn->prepare("SELECT * FROM user_transactions WHERE transaction_id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching specific transcation:" . $e->getMessage();
        }
    }

    public static function deleteTransaction($id)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        try {
            $stmt = $conn->prepare("DELETE FROM user_transactions WHERE transaction_id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute(); 
        } catch (PDOException $e) {
            echo "Error delete transaction: " . $e->getMessage();
        }
    }
}
