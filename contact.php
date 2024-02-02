<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $message = nl2br(htmlspecialchars($_POST["message"]));

    // Adresse e-mail de destination
    $to = "atoxmillenium@gmail.com";

    // Sujet du message
    $subject = "Nouveau message de $nom $prenom";

    // Corps du message (vous pouvez personnaliser cela selon vos besoins)
    $messageBody = "
        <p>Vous avez reçu un nouveau message de $nom $prenom.</p>
        <p><strong>Nom :</strong> $nom</p>
        <p><strong>Prénom :</strong> $prenom</p>
        <p><strong>Email :</strong> $email</p>
        <p><strong>Téléphone :</strong> $phone</p>
        <p><strong>Message :</strong></p>
        <p>$message</p>
    ";

    // En-têtes du message
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";

    // Envoyer l'e-mail
    $send = mail($to, $subject, $messageBody, $headers);

    // Vérifier si l'e-mail a été envoyé avec succès
    if ($send) {
        echo "Le message a été envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi du message. Veuillez réessayer.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contactez-nous chez Pierre Armes. Utilisez ce formulaire pour nous envoyer un message ou poser une question.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Contact - Pierre Armes</title>
</head>

<body>
    <header class="bg-dark text-white text-center py-4">
        <img src="assets/img/pierrearmes-logo.png" alt="Pierre Armes" class="img-fluid" id="logo">
        <p class="fs-5">Votre spécialiste en Armurerie depuis 1985</p>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.html">Accueil</a>
            <a class="navbar-brand" href="produits.html">Produits</a>
            <a class="navbar-brand" href="contact.html">Contact</a>
        </div>
    </nav>

    <section class="container my-4  justify-content-center align-items-center">
        <h2 class="display-4 text-center mb-4">Contactez-nous</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input name="nom" type="text" class="form-control" id="nom" placeholder="Votre nom">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input name="prenom" type="text" class="form-control" id="prenom" placeholder="Votre prénom">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Votre adresse email">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Téléphone</label>
                <input name="phone" type="tel" class="form-control" id="phone" placeholder="Votre numéro de téléphone">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" rows="4" placeholder="Votre message"></textarea>
            </div>
            <div class="d-grid">
                <button name="send" type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>

    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">&copy; 2024 Pierre Armes - Tous droits réservés</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-eJqCymofRgDMxm8JmT5dIOWPDwy5JNzROc6CPa3KJCzPBy1dG8hliZgM5u5o18m" crossorigin="anonymous"></script>
</body>

</html>