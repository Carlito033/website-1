<?php
require_once '../backend/user.php';
require_once '../backend/transaction.php';
$transaction_id = $_GET['id'] ?? '';
User::isLoggedIn();
$transactions = Transaction::getSpecificTransaction($transaction_id);

if (isset($_POST['delete'])) {
    Transaction::deleteTransaction($transaction_id);
    header("Location:../home.php");
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $amount = $_POST['amount'] ?? '';
        Transaction::updateTransaction($transaction_id, $amount);
        header("Location:../home.php");
    }
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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Lashop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../home.php">Home</a>
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

<body>


    <div class="d-flex justify-content-around">
        <div class="card" style="width: 18rem;">
            <div class="card-body ">
                <h5 class="card-title">
                    <h1>Users Detail</h1>
                </h5>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Transaction ID</label>
                        <input disabled type="text" name="transaction_id" id="" value="<?php echo $transactions['transaction_id']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Transaction Amount</label>
                        <input type="text" name="amount" id="" value="<?php echo $transactions['amount']; ?>">
                    </div>
                    <input type="submit" value="Update" name="update" class="btn btn-primary">
                    <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>


</body>

</html>