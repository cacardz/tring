<?php
include_once 'dbconnector.php';
include_once('ban.php');
if (isset($_POST['login'])) {
    session_start();
    // adnamon ang sql para ma likayan ang sql injection
    if ($stmt = $conn->prepare('SELECT id, password FROM user WHERE username = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        // i butang ang result para ma check kung naa na ba ni nga account sa database
        $stmt->store_result();
    }
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // kay naa man ang account, atong e verify ang password.
        if ($_POST['password'] === $password) {
            // mag buhat ug session para mahibaw-an nato nga naka login na ang user
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            checkIfBanned(true, true);
            header('Location: index.php');
            die;
        } else {
            $_SESSION['wrongPass'] = 'Incorrect Password.';
            checkIfBanned(true, false);
            header('Location: login.php');
        }
    } else {
        checkIfBanned(true, false);
        $_SESSION['notRegistered'] = 'Username does not exist.';
        header('Location:login.php');
    }
    $stmt->close();
}
