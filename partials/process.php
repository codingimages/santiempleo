<?php
// include db file
require_once 'config.php';
require_once 'db.php';
require_once 'func.php';

/*SendGrid Library*/
require_once ('../SendGrid-API/vendor/autoload.php');

if(isset($_POST['add_appointment'])) {
    
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $date = isset($_POST['date']) ? trim($_POST['date']) : '';
    $time = isset($_POST['time']) ? trim($_POST['time']) : '';
    $purpose = is_array($_POST['purpose']) ? $_POST['purpose'] : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    
    if($purpose == '') {
        $_SESSION['msgErr'] = 'Please select at least one purpose';
        return header('Location:../booking.php');
    }
    
    // Get day from date
    $timestamp = strtotime($date);
    $day = date('l', $timestamp);
    
    if($day == 'Sunday'){
        $_SESSION['msgErr'] = 'Please select another day, sunday is not availabe right now.';
        return header('Location:../booking.php');
    }
    
    // Check current date in db
    $query = "SELECT count(*) as count FROM appointments WHERE date = $timestamp AND time = '$time'";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_object($res);
    $count = $row->count;
    
    if($count > 0) {
        $_SESSION['msgErr'] = 'Time is already taken, please try another time';
        return header('Location:../booking.php');
    }
    
    $date = strtotime($date);
    
    $query = "INSERT INTO appointments (name, email, date, time, purpose, description) VALUES ('$name', '$email', '$date', '$time', '". serialize($purpose) ."', '$description')";
    $res = mysqli_query($con, $query);
    
    $msg = "Appointment Added successfully.";
    
    foreach($purpose as $p) {
        $nPurpose .= $p . ', ';
    }
    
    // Sending Mail
    $mReceiverName = ADMIN_NAME;
    $mReceiverEmail = ADMIN_EMAIL;
    $mSubject = 'Solicitud de información';
    $mMsg = "Le solicitan informacin con los siguientes detalles...<hr><br>
             Nombre: $name<br>
             Correo: $email<br>
             Fecha: ". date('M d, Y', $date) ." at $time<br>
             Propósito: $nPurpose<br>
             Descripción: $description";
    
    $mSenderName = '';
    $mSenderEmail = '';
    
    sendMail($mReceiverName, $mReceiverEmail, $mSubject, $mMsg);
    
    $_SESSION['msg'] = $msg;
    return header('Location:../booking.php');
} else if(isset($_GET['d'])) {
    $id = $_GET['d'];
    
    if(deleteAppointment($id)) {
        $_SESSION['msg'] = 'Eliminado exitosamente';
    } else {
        $_SESSION['msg'] = 'Algo salió mal intenta nuevamente';
    }
    return header('Location:../viewAll.php');
}
