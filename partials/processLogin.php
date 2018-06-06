<?php
// include db file
require_once 'config.php';
require_once 'db.php';
require_once 'func.php';


if(isset($_POST['login'])) {
    
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    // process login
    $loggedInUser = login($email, $password);
    
    if ($loggedInUser) {
        //Creating session for login admin
        $_SESSION['user_data'] = $loggedInUser;
        return header('Location:../viewAll.php');
    } else {
        $_SESSION['msgErr'] = 'Invalid details, try agin please.';
        return header('Location:../login.php');
    }
    
}
