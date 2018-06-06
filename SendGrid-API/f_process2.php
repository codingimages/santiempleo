<?php
session_start();

/*SendGrid Library*/
require_once ('vendor/autoload.php');

/*Post Data*/
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$message = trim($_POST['message']);
$file = $_FILES['file'];

// getting file extension
$array = explode('.', $_FILES['file']['name']);
$ext = end($array);


if(empty($name) && empty($email) && empty($message) && empty($phone)) {
    if($file['error'] == 4){
        $_SESSION['msgFile'] = 'Selecciona el resume';
    }
    $_SESSION['msgFields'] = "Ingresa toda la informacion requerida";
    return header("Location:../aplicar.php");
} else {
    if($file['error'] == 4){
        $_SESSION['msgFile'] = 'Selectiona el resume';
        return header("Location:../aplicar.php");
    }
    
    /*Content*/
    $from = new SendGrid\Email($name, $email);
    $subject = "Aplicacion de trabajo - santiempleo.com";
    $to = new SendGrid\Email("Aplicacion recibida - Santi Empleo", "carlos@santistaffingsolutions.com");
    $content = new SendGrid\Content(
        "text/html", 
        "Aplicacion nueva con los siguientes detalles<hr>.<br>Nombre: $name<br><br>Telefono: $phone<br><br>Correo Electronico: $email<br><br>Mensaje:<br><br> $message"
    );
    
    /* Adding an attachment to mail */
    $file_encoded = base64_encode(file_get_contents($file['tmp_name']));
    $attachment = new SendGrid\Attachment();
    $attachment->setContent($file_encoded);
    $attachment->setType("application/text");
    $attachment->setDisposition("attachment");
    $attachment->setFilename("resume.$ext");

    /*Send the mail*/
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
    $mail->addAttachment($attachment);
    $apiKey = ('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');
    $sg = new \SendGrid($apiKey);

    /*Response*/
    $response = $sg->client->mail()->send()->post($mail);
    
    if($response->_status_code == 202){
        $_SESSION['msg'] = "Su mensaje fue enviado correctamente.";
    } else {
        $_SESSION['msg'] = "Hubo un error al enviar el mensaje.";
    }
    
    /*Redirect Link after mail submission*/
    header("Location:../aplicar.php");
}
