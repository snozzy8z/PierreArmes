<?php

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Vérifier le champ anti-spam
$website = $_POST['website']; // Champ anti-spam

if (!empty($website)) {
    // Si le champ anti-spam est rempli, c'est probablement un robot, donc ignore la soumission
    echo json_encode(array('message' => 'Spam détecté. Votre message n\'a pas été envoyé.', 'code' => 0));
    exit();
}

// Récupérer les données du formulaire
$name = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

header('Content-Type: application/json');

try {
    // Initialiser PHPMailer
    $mail = new PHPMailer(true); // Active les exceptions

    // Paramètres SMTP de Google (Gmail)
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'atoxmillenium@gmail.com'; // Ton adresse e-mail Gmail
    $mail->Password = 'zflt ouus dkke lihz'; // Ton mot de passe Gmail ou le mot de passe d'application que tu as généré
    $mail->SMTPSecure = 'tls'; // Le protocole de chiffrement
    $mail->Port = 587; // Le port SMTP

    // Paramètres du message
    $mail->setFrom($email, $name . ' ' . $prenom);
    $mail->addAddress('atoxmillenium@gmail.com'); // L'adresse e-mail à laquelle tu veux envoyer le message
    $mail->Subject = 'Nouveau message depuis le formulaire de contact';
    $mail->Body = "Nom: $name\nPrénom: $prenom\nEmail: $email\nTéléphone: $phone\nMessage: $message";

    // Envoi du message
    $mail->send();

    // Si l'e-mail est envoyé avec succès
    echo json_encode(array('message' => 'Email envoyé avec succès!', 'code' => 1));
} catch (Exception $e) {
    // En cas d'erreur
    echo json_encode(array('message' => 'Une erreur s\'est produite lors de l\'envoi de l\'email : ' . $mail->ErrorInfo, 'code' => 0));
}
