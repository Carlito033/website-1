<?php

require_once "../backend/user.php";
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$username = $_POST['username'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userOjb = new User($email, $password, $username); // Create an instance of the User class
    $userOjb->createUser($email, $password, $username); // This will attempt to create a new user
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-...<copy actual hash from source>..." crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-...<copy actual hash from source>..." crossorigin="anonymous"></script>
    <title>Lashop</title>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center vh-100">
        <form action="" method="post" class="shadow-sm p-3 mb-5 bg-body rounded">
            <h1>Register to Lashop!</h1>
            <div class="input-group mb-3">
                <input class="form-control" type="username" name="username" id="username" placeholder="User Name" required>
            </div>
            <div class="input-group mb-3">
                <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="input-group mb-3">
                <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
            </div>

            <!-- <div class="input-group mb-3">
                <input class="form-control" type="password" name="second-password" id="password" placeholder="Re-enter Password" required>
            </div>

            <div class="input-group mb-3">
                <input class="form-control" type="text" name="firstName" id="firstName" placeholder="First Name" required>
            </div> -->

            <div class="input-group mb-3">
                <input class="btn btn-primary form-control" type="submit" value="Submit">
            </div>
            <a href="login.php" class="text-decoration-none">Have an account? Login here!</a>
        </form>

    </div>


</body>

</html>