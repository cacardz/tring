<?php
require('ban.php');
checkIfBanned();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styler.css">
    <!--<link rel="website icon" type="png" href="images/icons8-r-64.png">!-->
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['firstname'], $_SESSION['middleInitial'], $_SESSION['lastname'], $_SESSION['password'], $_SESSION['confirmPassword'], $_SESSION['gender'], $_SESSION['address'])) {
        $_SESSION['firstname'] = "";
        $_SESSION['middleInitial'] = "";
        $_SESSION['lastname'] = "";
        $_SESSION['password'] = "";
        $_SESSION['confirmPassword'] = "";
        $_SESSION['gender'] = "";
        $_SESSION['address'] = "";
    }
    ?>
    <div class="container mt-3">

        <?php
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success" role="alert">'
                . $_SESSION['success'] .
                '</div>';
            unset($_SESSION['success']);
            header("refresh: 2");
        }
        ?>

        <?php
        if (isset($_SESSION['fail'])) {
            echo '<div class="alert alert-warning" role="alert">'
                . $_SESSION['fail'] .
                '</div>';
            unset($_SESSION['fail']);
            header("refresh: 2");
        }
        ?>
    </div>
    </div>

    <form action="insertuser.php" method="post">
        <div class="cardRegister">
            <div class="card-body">
                <h5 class="card-title">Sign up</h5>
                <div class="grid-container">
                    <div class="grid-firstname">
                        <div class="inputGroup">
                            <input value="<?php echo $_SESSION['firstname']; ?>" id="firstname" type="text" name="firstname" autocomplete="off" required="">
                            <label for="firstname">First Name</label>
                            <p id="notifierSaFname" class="text-danger errorMessage"></p>
                        </div>
                    </div>
                    <div class="grid-middleInitial">
                        <div class="inputGroup">
                            <input value="<?php echo $_SESSION['middleInitial']; ?>" id="middleInitial" type="text" name="middleInitial" autocomplete="off" maxlength="2" required="">
                            <label for="middleInitial">Middle Initial</label>
                            <p id="notifierSaMname" class="text-danger errorMessage"></p>

                        </div>
                    </div>
                    <div class="grid-lastname">
                        <div class="inputGroup">
                            <input value="<?php echo $_SESSION['lastname']; ?>" id="lastname" type="text" name="lastname" autocomplete="off" required="">
                            <label for="lastname">Last Name</label>
                            <p id="notifierSaLname" class="text-danger errorMessage"></p>
                        </div>
                    </div>
                    <div class="grid-username">
                        <div class="inputGroup">
                            <input id="username" type="text" name="username" autocomplete="off" required maxlength="20">
                            <label for="username">Username</label>
                            <p id="notifierSaUsername" class="text-danger errorMessage"></p>
                        </div>
                    </div>
                    <div class="grid-password">
                        <div class="inputGroup" id='password_container'>
                            <input value="<?php echo $_SESSION['password']; ?>" id="PassEntry" type="password" name="password" autocomplete="off" required>
                            <label for="password">Password</label>
                        </div>
                        <span id="StrengthDisp" class="text"></span>
                    </div>
                    <div class="grid-cpassword">
                        <div class="inputGroup">
                            <input value="<?php echo $_SESSION['confirmPassword']; ?>" id="confirmPassword" type="password" name="confirmPassword" autocomplete="off" required>
                            <label for="confirmPassword">Confirm Password</label>
                            <p id="notifierSaPassword" class="text-danger errorMessage"></p>
                        </div>
                    </div>
                    <div class="grid-gender">
                        <div class="inputGroup">
                            <select value="<?php echo $_SESSION['gender']; ?>" class="gender" name="gender" autocomplete="off" id="gender" required>
                                <option selected="true">Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <p id="notifierSaGender" class="text-danger errorMessage"></p>
                        </div>
                    </div>
                    <div class="grid-address">
                        <div class="inputGroup">
                            <input value="<?php echo $_SESSION['address']; ?>" id="address" type="text" name="address" autocomplete="off" required>
                            <label for="address">Address</label>
                        </div>
                    </div>
                    <div class="grid-button">
                        <button id="signupbtn" name="register">
                            Sign up
                            <div class="arrow-wrapper">
                                <div class="arrow"></div>
                            </div>
                        </button>
                    </div>
                    <div class="grid-a">
                        <p class="toRegister">Already registered?
                            <a href="login.php" class="card-link">Login here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="js/sanitizerSaRegister.js"></script>
    <script src="js/passwordStrengthCheck.js"></script>

</body>

</html>