<?php
// include db file
require_once 'config.php';
require_once 'db.php';
require_once 'func.php';


if(isset($_POST['submit'])) {
    
    $id = isset($_POST['id']) ? trim($_POST['id']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // process login
    
    if (updatePassword($id, $password)) {
        //Creating session for login admin
        $_SESSION['msg'] = 'Contrasena actualizada';
        return header('Location:../profile.php');
    } else {
        $_SESSION['msgErr'] = 'Something went wrong, try again.';
        return header('Location:../profile.php');
    }
    
}
