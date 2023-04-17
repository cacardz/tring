<?php
include 'ban.php';
// Connect to the database
$string = "mysql:host=localhost; dbname=asus";
if (!$con = new PDO($string, 'root', '')) {
    die("could not connect");
}
// kwaon nato ang ip address sa client
$ipAddress = $_SERVER['REMOTE_ADDR'];
// andamon ang statement
$sql = 'SELECT * FROM banneduser WHERE ipAddress = :ipAddress';
$stmts = $con->prepare($sql);
//e bind ang values
$stmts->bindValue(':ipAddress', $ipAddress, PDO::PARAM_STR);
//e execute ang statement
$stmts->execute();
//e fetch ang data
$data = $stmts->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styler.css">
    <!--<link rel="website icon" type="png" href="images/icons8-r-64.png">!-->
    <style>

    </style>
</head>

<body>

    <form action="ban.php" method="post">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                <div class="grid-container">
                    <div class="grid-password">

                        <div class="alert alert-danger">
                            Limit reach!
                            <p id="remainingTime"></p>
                        </div>

                        <input type="hidden" id="startingTime" value="<?php echo $data['startingTime']; ?>">

                        <div class="inputGroup">
                            <input id="username" type="text" name="username" autocomplete="off" class="disabledInput" disabled>
                            <label for="username">User Name</label>
                            <p id="notifier" class="text-danger "></p>
                        </div>

                        <div class="inputGroup">
                            <input type="password" name="password" autocomplete="off" class="disabledInput" disabled>
                            <label for="password">Password</label>
                        </div>

                        <div class="grid-login-button">
                            <button id="loginbtn" name="login" disabled>
                                Login
                                <div class="arrow-wrapper">
                                    <div class="arrow"></div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="grid-a">
                        <p class="toRegister">Not yet registered?
                            <a href="register.php" class="card-link">Register here</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <script src="js/timer.js"></script>
</body>

</html>