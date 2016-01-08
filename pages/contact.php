<?php

require('libraries/sendgrid-php.php');


$email_to = 'alcouch65@gmail.com';
$subject = 'Contact Us Form Submission';
function isValidEmail($email){
    return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
}
function printError($error) {
    echo '<div class="alert alert-danger" style="padding:10px; margin: 10px; margin-bottom: 50px;">';
    echo $error;
    echo '</div>';
}
function printSuccess($success) {
    echo '<div class="alert alert-success" style="padding:10px; margin: 10px; margin-bottom: 50px;">';
    echo $success;
    echo '</div>';
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        printError('<b class="error">All fields are required!</b>');
    }else {
        if(!isValidEmail($_POST['email'])) {
            printError('<b class="error">Invalid email!</b>');
        } else {
            $message = $_POST['message'];
            $api_user = getenv("SENDGRID_USERNAME");
            $api_key = getenv("SENDGRID_PASSWORD");

            $sendgrid = new SendGrid($api_user, $api_key);

            $email = new SendGrid\Email();

            $email->addTo($email_to)
                  ->setFrom("no-reply@quickfixnetwork.net")
                  ->setSubject($subject)
                  ->setHtml($message);

            $sendgrid->send($email);
            printSuccess('Message sent successfully!');
        }
    }
}

?>
