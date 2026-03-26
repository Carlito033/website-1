<?php
require "../backend/user.php";
User::isLoggedIn();
echo $_SESSION['username'] . " is logged in!"; // Display the logged-in user's username 

$buttonClicked = $_POST['logout'] ?? false; // Check if the logout button was clicked
if ($buttonClicked) {
    User::logoutUser(); // Call the logoutUser method to handle the logout process
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Welcome to Lashop!</h1>
    <form method="POST" action="">
        <input type="submit" name="logout" value="Logout">
    </form>

    <div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
</body>

</html>