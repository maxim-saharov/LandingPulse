<?php

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
// this is if we want to receive a full dispatch report

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';


try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;   //Enable verbose debug output
    // this is if we want to receive a full dispatch report
    $mail->isSMTP();                                          //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                  //Enable SMTP authentication
    $mail->Username   = 'test@gmail.com';      //SMTP username
    $mail->Password   = 'password';
    //Our password from the box through the application password!
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           //Enable implicit TLS encryption
    $mail->Port       = 465;                                   //TCP port to connect to;

    $mail->setFrom('test@gmail.com', 'Pulse');   // From whom is the letter
    //Recipients
    $mail->addAddress($email);     // to whom
    $mail->addBCC('test2@gmail.com');   // hidden copy

    // https://github.com/PHPMailer/PHPMailer

    //Content
    $mail->isHTML(true);                        //Set email format to HTML
    $mail->Subject = 'Заявка с сайта Pulse';

    $mail->Body    = '
        Entered data on the site <br>
            Name: ' . $name . ' <br>
            Phone number: ' . $phone . '<br><br>
            <b>Email</b>: ' . $email . '';
            // in php dot is the concatenation of two strings

    $mail->send();
    echo 'Message has been sent';

} catch (Exception $e) {

    echo "Message hasNOT been sent. Error: {$mail->ErrorInfo}";

}










