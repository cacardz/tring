<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}
if (isset($_POST['logout'])) {
    header('Location: logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

<center> <h1>Hello <?php echo $_SESSION['name']; ?></h1><center>
    <br>
    <center><a href="logout.php" class="btn btn-danger btn-outline-danger my-2 my-sm-0">Logout</a></center>
</body>

</html>