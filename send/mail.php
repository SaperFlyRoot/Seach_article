<?php
// Файлы phpmailer
require 'class.phpmailer.php';
require 'class.smtp.php';

$name = $_POST['name'];
$number = $_POST['tel'];
$email = $_POST['email'];
$message = $_POST['message'];
// Настройки
$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'smtp.yandex.ru';
$mail->SMTPAuth = true;
$mail->Username = 'maletich.pavel'; // Ваш логин в Яндексе. Именно логин, без @yandex.ru
$mail->Password = 'zver2015'; // Ваш пароль
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('maletich.pavel@yandex.ru'); // Ваш Email
$mail->addAddress('ablyatipov.ramazan.i.1.16@gmail.com'); // Еще один email, если нужно.

// Письмо
$mail->isHTML(true);
$mail->Subject = "Заголовок"; // Заголовок письма
$mail->Body    = "Имя $name . Телефон $number . Почта $email . Текст $message" ; // Текст письма

// Результат
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'ok';
}
?>
