<?php
$name = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$website = $_POST['website']; // Champ anti-spam

header('Content-Type: application/json');

if (!empty($website)) {
    // Si le champ anti-spam est rempli, c'est probablement un robot, donc ignore la soumission
    print json_encode(array('message' => 'Spam détecté. Votre message n\'a pas été envoyé.', 'code' => 0));
    exit();
}

if ($name === '') {
    print json_encode(array('message' => 'Le nom ne peut pas être vide.', 'code' => 0));
    exit();
}

if ($prenom === '') {
    print json_encode(array('message' => 'Le prénom ne peut pas être vide.', 'code' => 0));
    exit();
}

if ($email === '') {
    print json_encode(array('message' => 'L\'email ne peut pas être vide.', 'code' => 0));
    exit();
} else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        print json_encode(array('message' => 'Format d\'email invalide.', 'code' => 0));
        exit();
    }
}

if ($phone === '') {
    print json_encode(array('message' => 'Le téléphone ne peut pas être vide.', 'code' => 0));
    exit();
}

if ($message === '') {
    print json_encode(array('message' => 'Le message ne peut pas être vide.', 'code' => 0));
    exit();
}

$contenu = "Nom: $name\nPrénom: $prenom\nEmail: $email\nTéléphone: $phone\nMessage: $message";
$destinataire = "youremail@here.com"; // Remplace par ton adresse email

$entete = "From: $email\r\n";

// Envoi du mail
if (mail($destinataire, 'Nouveau message depuis le formulaire de contact', $contenu, $entete)) {
    print json_encode(array('message' => 'Email envoyé avec succès!', 'code' => 1));
} else {
    print json_encode(array('message' => 'Une erreur s\'est produite lors de l\'envoi de l\'email.', 'code' => 0));
}
?>
