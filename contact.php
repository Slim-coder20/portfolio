<?php
// Charger l'autoloader généré par Composer pour pouvoir utiliser PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nettoyer les données entrantes
    $nom = htmlspecialchars(trim($_POST['nom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Vérifier que tous les champs sont remplis
    if (!empty($nom) && !empty($email) && !empty($message)) {
        // Créer une instance de PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuration SMTP pour envoyer des emails via un serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Remplace par l'adresse de ton serveur SMTP, par exemple smtp.gmail.com
            $mail->SMTPAuth = true;
            $mail->Username = 'slimabida21@gmail.com'; // Remplace par ton adresse email
            $mail->Password = 'nuwq cnnq sbvq wmsp'; // Remplace par ton mot de passe
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Utiliser TLS pour la sécurité
            $mail->Port = 587; // Port SMTP (587 pour TLS, 465 pour SSL)

            // Paramètres de l'email
            $mail->setFrom($email, $nom);
            $mail->addAddress('slimabida21@gmail.com'); // Remplace par l'adresse où tu veux recevoir les messages
            $mail->Subject = 'Nouveau message depuis votre portfolio';
            $mail->Body = "Nom: $nom\nEmail: $email\n\nMessage:\n$message";

            // Envoyer l'email
            $mail->send();
            echo "<p>Merci, votre message a bien été envoyé !</p>";
        } catch (Exception $e) {
            echo "<p>Erreur : Le message n'a pas pu être envoyé. Erreur de PHPMailer : {$mail->ErrorInfo}</p>";
        }
    } else {
        echo "<p>Veuillez remplir tous les champs du formulaire.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <h1>Contactez-moi</h1>
    <form action="contact.php" method="POST">
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Message :</label><br>
        <textarea id="message" name="message" rows="5" required></textarea><br><br>

        <input type="submit" value="Envoyer">
    </form>
</body>

</html>