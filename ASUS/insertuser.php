<?php
include_once 'dbconnector.php';

if (isset($_POST['register'])) {
    session_start();
    $firstname = strtolower($_POST['firstname']);
    $middleInitial = strtolower($_POST['middleInitial']);
    $lastname = strtolower($_POST['lastname']);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    $gender = $_POST['gender'];
    $address = strtolower($_POST['address']);
    $SELECT = "SELECT username From user Where username = ? Limit 1";
    $INSERT = "INSERT Into user (firstname, middleInitial, lastname, username, password, gender, address) values(?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    if ($rnum == 0) {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sssssss", ucwords($firstname), ucwords($middleInitial), ucwords($lastname), $username, $hashedpassword, $gender, ucwords($address));
        $stmt->execute();
        $_SESSION['success'] = "Registered successfully.";
        unset($_SESSION['firstname'], $_SESSION['middleInitial'], $_SESSION['lastname'], $_SESSION['password'], $_SESSION['confirmPassword'], $_SESSION['gender'], $_SESSION['address']);
        header('Location:register.php');
    } else {
        $_SESSION['firstname'] = $firstname;
        $_SESSION['middleInitial'] = $middleInitial;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['password'] = $password;
        $_SESSION['confirmPassword'] = $password;
        $_SESSION['gender'] = $gender;
        $_SESSION['address'] = $address;
        $_SESSION['fail'] = "This username is taken.";
        header('Location:register.php');
    }
    $stmt->close();
    $conn->close();
}
