<?php

require_once "../../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Activar o desactivar excepciones mediante variable
$debug = true;
try {
    // Crear instancia de la clase PHPMailer
    $mail = new PHPMailer($debug);
    if ($debug) {
        // Genera un registro detallado
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    }
    // Autentificación con SMTP
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    // Login
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = "jhonlozano2000@gmail.com";
    $mail->Password = "izjr mhhw onzr siwv";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->setFrom('jhonlozano2000@gmail.com', 'name');
    $mail->addAddress('jhonlozano2000@gmail.com', 'name');
    $mail->addAttachment("../../public/assets/img/cover_pic.png");
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->isHTML(true);
    $mail->Subject = 'Asunto de tu correo';
    $mail->Body = 'El contenido de tu correo en HTML. Los elementos en <b>negrita</b> también están permitidos.';
    $mail->AltBody = 'Texto como elemento de texto simple';
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: " . $e->getMessage();
}
