<?php
session_start();
require_once 'database.php';
class User
{
    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct($email, $password)
    { // This constructor will initialize the user's properties when a new User object is created
        $this->email = $email;
        $this->password = $password;
    }

    public static function getUserByEmail($email)
    { // This method will retrieve a user's information from the database based on their email

        $db = Database::getInstance();
        $conn = $db->getConnection();
        try {
            $stmt = $conn->prepare("SELECT * FROM user_login WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching user: " . $e->getMessage();
        }
    }

    public function showUserInfo()
    { // This method will display the user's information
        echo "User ID: " . $this->id . "<br>";
        echo "Username: " . $this->username . "<br>";
        echo "Email: " . $this->email . "<br>";
    }

    public static function createUser($email, $username, $password)
    { // This method will create a new user in the database
        $db = Database::getInstance();
        $conn = $db->getConnection();
        try {
            $stmt = $conn->prepare("INSERT INTO user_login (email, username, password_hash) VALUES (:email, :username, :password_hash)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password_hash', $password); // In a real application, make sure to hash the password before storing it
            $stmt->execute();
            echo "User created successfully!";
        } catch (PDOException $e) {
            echo "Error creating user: " . $e->getMessage();
        }
    }

    public static function loginUser($email, $password)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        try {
            $stmt = $conn->prepare("SELECT * FROM user_login WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($password == $user['password_hash']) { // In a real application, you should use password_verify() to compare the hashed password
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                Header("Location: /website-1/frontend/home.php"); // Redirect to the home page after successful login

                // You can also return the user information or set session variables here
            } else {
                // print_r($user);
                echo "Invalid email or password.";
            }
        } catch (PDOException $e) {
            echo "Error loggin in user:" . $e->getMessage();
        }
    }

    public static function logoutUser()
    {
        session_unset();
        session_destroy();
        header("Location: /website-1/frontend/login.php");
        exit();
    }

    public static function isLoggedIn()
    {
        try {
            if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
                return true; // User is logged in
            } else {
                Header("Location: /website-1/frontend/login.php"); // Redirect to login page if not logged in
                exit();
            }
        } catch (Exception $e) {
            echo "Error checking login status: " . $e->getMessage();
        }
    }

    public static function getUserInformation($user_id)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        try {
            $stmt = $conn->prepare("SELECT * FROM user_login WHERE id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching user: " . $e->getMessage();
        }
    }
}

// $user = User::getUserByEmail("engocarl03@gmail.com"); //  This will fetch the user information from the database based on the provided email
// $userObj = new User(1, "engocarl03", "engocarl03@gmail.com", "hashed_password");  // This will create a new User object with the fetched information (you should replace the hardcoded values with the actual data from the database)
// $userObj->showUserInfo(); // This will display the user's information using the showUserInfo method of the User class
// $userObj->createUser("newuser", "newuser@gmail.com", "newhashed_password"); // This will create a new user in the database with the provided username, email, and password (make sure to hash the password before calling this method in a real application)
// $userLogin = new User("engocarl03@gmail.com", 12341); // Create an instance of the User class
// $userLogin->loginUser("engocarl03@gmail.com", 1234); // This will attempt to log in the user with the provided email and password (make sure to replace "your_password" with the actual password you want to test)
