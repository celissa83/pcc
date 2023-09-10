<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
/*error_reporting(E_ALL);
ini_set("display_errors", 1);*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$response = "";

$mail = new PHPMailer(TRUE);
$mail->isSMTP();

$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Username = "laetitia.gamba.spitz@gmail.com";
$mail->Password = "btcoozooerraccxn";
$mail->Body = htmlentities($_POST['Message']);
$mail->SetFrom($_POST['email'], $_POST['name']);
$objet = "Demande de Contact de la part de  :" . $_POST['name'] . '/' . $_POST['email'] . ".";
$mail->Subject = $objet;
$mail->AddAddress('laetitia.gamba.spitz@gmail.com');
$mail->isHTML(true);
$mail->SMTPDebug = 0;
$mail->CharSet = "utf-8";
$mail->send();

if (!$mail->send()) {

 } else {
    $response = "OK";
    $mailRetour = new PHPMailer(TRUE);
    $mailRetour->isSMTP();
    $mailRetour->Host = 'smtp.gmail.com';
    $mailRetour->Port = 587;
    $mailRetour->SMTPAuth = true;
    $mailRetour->SMTPSecure = 'tls';
    $mailRetour->Username = "laetitia.gamba.spitz@gmail.com";
    $mailRetour->Password = "btcoozooerraccxn";
    $objetReponse = "Cher client, j'ai bien reçu votre demande et vous en remercie.
    Je prendrai contact avec vous dans les plus brefs délais.
    Laetitia SPITZ";
    $mailRetour->Body = htmlentities($objetReponse);
    $mailRetour->SetFrom($_POST['email'], $_POST['name']);

    $titre = "Accusé de réception";
    //$titre = utf8_encode($titre);
    $mailRetour->Subject = $titre;

    $mailRetour->AddAddress($_POST['email']);
    $mailRetour->isHTML(true);
    $mailRetour->SMTPDebug = 0;
    $mailRetour->send();
}


return $response;