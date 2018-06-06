<?php
session_start();

/*SendGrid Library*/
require_once ('vendor/autoload.php');

/*Content*/
$from = new SendGrid\Email($senderName, $sendAddress);
$subject = '';
$to = new SendGrid\Email($receiver, $receiverAddress);
$content = new SendGrid\Content("text/html", "Write Your Content here.");

/*Send the mail*/
$mail = new SendGrid\Mail($from, $subject, $to, $content);
$apiKey = ('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');
$sg = new \SendGrid($apiKey);

/*Response*/
$response = $sg->client->mail()->send()->post($mail);

if($response->_status_code == 202){
    $_SESSION['msg'] = "Message has been sent successfully.";
} else {
    $_SESSION['msg'] = "Message has not been sent successfully.";
}
