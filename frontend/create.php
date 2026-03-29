<?php
require_once '../backend/user.php';
require_once '../backend/transaction.php';
User::isLoggedIn();
$amount = $_POST['amount'] ?? '';
if (isset($_POST['submit'])) {
    Transaction::createTransaction($amount);
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
    <div>
        <form method="post" action="">
            <input type="text" name="amount" id="amount" placeholder="Amount">
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    
</body>
</html>