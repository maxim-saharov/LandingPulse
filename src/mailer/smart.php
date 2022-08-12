<?php

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
// это если хотим полный отчет об отправке получить

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';


try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;   //Enable verbose debug output
    // это если хотим полный отчет об отправке получить
    $mail->isSMTP();                                          //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                  //Enable SMTP authentication
    $mail->Username   = 'test@gmail.com';      //SMTP username
    $mail->Password   = 'password';
    //Наш пароль от ящика через пароль приложений!
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           //Enable implicit TLS encryption
    $mail->Port       = 465;                                   //TCP port to connect to;

    $mail->setFrom('test@gmail.com', 'Pulse');   // От кого письмо
    //Recipients
    $mail->addAddress($email);     // кому
    $mail->addBCC('test2@gmail.com');   // скрытая копия

    // https://github.com/PHPMailer/PHPMailer

    //Content
    $mail->isHTML(true);                        //Set email format to HTML
    $mail->Subject = 'Заявка с сайта Pulse';

    $mail->Body    = '
        Внесенные данные на сайте <br>
        Имя: ' . $name . ' <br>
        Номер телефона: ' . $phone . '<br><br>
        <b>E-mail</b>: ' . $email . '';
        // в пхп точка это конкатенация двух строк

    $mail->send();
    echo 'Message has been sent';

} catch (Exception $e) {

    echo "Message hasNOT been sent. Error: {$mail->ErrorInfo}";

}










