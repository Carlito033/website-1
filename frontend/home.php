<?php
require "../backend/user.php";
require "../backend/transaction.php";
User::isLoggedIn();
Transaction::getTransaction();
$transactions = Transaction::getTransaction();

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-...<copy actual hash from source>..." crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-...<copy actual hash from source>..." crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Lashop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <form method="POST" action="">
                                <input type="submit" name="logout" value="Logout">
                            </form>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                        </a> -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <p>Transaction Logs</p>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>

                        <th scope="col">Transaction ID</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Upddated At</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($transactions); $i++) { ?>
                        <tr>
                            <td><?php echo $transactions[$i]['transaction_id']; ?></td>
                            <td><?php echo $transactions[$i]['amount']; ?></td>
                            <td><?php echo $transactions[$i]['created_at']; ?></td>
                            <td><?php echo $transactions[$i]['updated_at']; ?></td>
                            <td><?php echo $transactions[$i]['date']; ?></td>
                            <td>
                                <a href="../frontend/update.php/?id=<?php echo $transactions[$i]['transaction_id']; ?>">View</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</body>

</html>