<?php
// include db file
require_once 'db.php';

$output = '';

$dayTime = [
    'Monday' => array('8 AM', '9 AM', '10 AM', '11 AM', '12 PM', '1 PM', '2 PM', '3 PM', '4 PM', '5 PM',),
    'Tuesday' => array('8 AM', '9 AM', '10 AM', '11 AM', '12 PM', '1 PM', '2 PM', '3 PM', '4 PM', '5 PM',),
    'Wednesday' => array('8 AM', '9 AM', '10 AM', '11 AM', '12 PM', '1 PM', '2 PM', '3 PM', '4 PM', '5 PM',),
    'Thursday' => array('8 AM', '9 AM', '10 AM', '11 AM', '12 PM', '1 PM', '2 PM', '3 PM', '4 PM', '5 PM',),
    'Friday' => array('8 AM', '9 AM', '10 AM', '11 AM', '12 PM', '1 PM', '2 PM', '3 PM', '4 PM', '5 PM',),
    'Saturday' => array('10 AM', '11 AM', '12 PM', '1 PM', '2 PM', '3 PM', '4 PM', '5 PM',),
    'Sunday' => array('12 PM', '1 PM', '2 PM', '3 PM', '4 PM', '5 PM',),
];

if(isset($_POST['date'])) {
    $date = $_POST['date'];

    // Get day from date
    $timestamp = strtotime($date);
    $day = date('l', $timestamp);

    if($day != 'Sunday') {
        foreach($dayTime[$day] as $dt){
            $output .= '<option>'. $dt .'</option>';
        }
    } else {
        $output .= '<option>not available</option>';
    }
}

echo $output;
