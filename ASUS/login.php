<?php
require('ban.php');
checkIfBanned();
require_once 'loginprocess.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<title>Login</title>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styler.css">
  <!--  <link rel="website icon" type="png" href="images/icons8-r-64.png">!-->
    <style>

    </style>
</head>

<body>
    <form action="loginprocess.php" method="post">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                <div class="grid-container">
                    <div class="grid-password">
                        <div class="inputGroup">
                            <input id="username" type="text" name="username" autocomplete="off" required>
                            <label for="username">User Name</label>
                            <p id="notifier" class="text-danger "></p>
                        </div>
                        <div class=" text-danger" role="alert">
                            <?php
                            if (isset($_SESSION['notRegistered'])) {
                                echo $_SESSION['notRegistered'];
                                unset($_SESSION['notRegistered']);
                            }
                            ?>
                        </div>

                        <div class="inputGroup">
                            <input type="password" name="password" autocomplete="off" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="text-danger" role="alert">
                            <?php
                            if (isset($_SESSION['wrongPass'])) {
                                echo $_SESSION['wrongPass'];
                                unset($_SESSION['wrongPass']);
                            }
                            ?>
                        </div>

                        <div class="grid-login-button">
                            <button id="loginbtn" name="login">
                                Login
                                <div class="arrow-wrapper">
                                    <div class="arrow"></div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="grid-a">
                        <p class="toRegister">Dont have an account registered ?
                            <a href="register.php" class="card-link">Register here</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </form>
</body>

</html>