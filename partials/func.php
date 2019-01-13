<?php

function getTimes() {
    global $con;
    
    $query = "SELECT * FROM `available_times`";
    $res = mysqli_query($con, $query);

    $times = array();
    while($row = mysqli_fetch_assoc($res)){
        $temp = array();
        $temp['day'] = $row['day'];
        $temp['start_time'] = $row['start_time'];
        $temp['end_time'] = $row['end_time'];
        $times[] = $temp;
    }
    return $times;
}

function getAppointments() {
    global $con;
    
    $query = "SELECT * FROM `appointments` WHERE status = 'active' ORDER BY id DESC";
    $res = mysqli_query($con, $query);

    $appointments = array();
    while($row = mysqli_fetch_assoc($res)){
        $temp = array();
        $temp['id'] = $row['id'];
        $temp['name'] = $row['name'];
        $temp['email'] = $row['email'];
        $temp['date'] = $row['date'];
        $temp['time'] = $row['time'];
        $temp['purpose'] = unserialize($row['purpose']);
        $temp['description'] = $row['description'];
        $appointments[] = $temp;
    }
    return $appointments;
}

function deleteAppointment($id){
    global $con;
    
    mysqli_query($con, "UPDATE appointments SET status = 'inactive' WHERE id = $id");
    
    if(mysqli_affected_rows($con)){
        return true;
    } else {
        return false;
    }
}

// Send Mail Function
function sendMail($receiverName, $receiverEmail, $sub = null, $msg = null, $senderName = null, $senderEmail = null) {
    // setting sender
    $senderName = isset($senderName) ? $senderName : 'Admin';
    $senderEmail = isset($senderEmail) ? $senderEmail : 'admin@example.com';
    
    /*Content*/
    $from = new SendGrid\Email($senderName, $senderEmail);
    $subject = isset($sub) ? $sub : 'Example - domain.com';
    $to = new SendGrid\Email($receiverName, $receiverEmail);
    $content = new SendGrid\Content("text/html", $msg);

    /*Send the mail*/
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
    $apiKey = ('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');
    $sg = new \SendGrid($apiKey);

    /*Response*/
    $response = $sg->client->mail()->send()->post($mail);

    if($response->_status_code == 202){
        return true;
    } else {
        return false;
    }
}

//Login Function
function login($email, $password) {
    global $con;
    
    $query = "SELECT * FROM login WHERE email = '$email'";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_object($res);
    $hashed_password = $row->password;
    
    if (password_verify($password, $hashed_password)) {
        return $row;
    } else {
        return false;
    }
}

function updatePassword($id, $password) {
    global $con;
    
    mysqli_query($con, "UPDATE login SET password = '$password' WHERE id = $id");
    
    if(mysqli_affected_rows($con)){
        return true;
    } else {
        return false;
    }
}











