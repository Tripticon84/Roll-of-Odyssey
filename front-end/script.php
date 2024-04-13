<?php

function logPage($title) {
        // Ouverture du fichier d'inscription
        $log = fopen($_SERVER['DOCUMENT_ROOT'] . '\logs\pages.txt', 'a+');
        // Création de la ligne à ajouter : jj/mm/AAAA - hh:mm:ss -  Tentative de connexion réussie/échouée de : {email}
        $line = "\n" . getenv("REMOTE_ADDR") . ' - ' . date('d/m/Y - H:i:s') . ' - ' . ' - ' . $title . ' - ' . (isset($_SESSION['email']) ? $_SESSION['email'] : 'Anonyme');
    
        // Ajout de la ligne au fichier ouvert 
        fputs($log, $line);
    
        // Fermeture du fichier ouvert
        fclose($log);
}

function PDOConnect() {

    require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

    $attr = DB_HOST == 'localhost' ? [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] : [];
    try {
         $bdd = new PDO('mysql:host=' . DB_HOST . ':' . DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        // $bdd = new PDO('mysql:host=localhost:8889;dbname=roll-of-odyssey', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    return $bdd;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function sendMail($email, $subject, $message)
{

    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/Exception.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/PHPMailer.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/SMTP.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/config.php';

    $mail = new PHPMailer(true);

    $mail->isSMTP();

    $mail->SMTPDebug = SMTP::DEBUG_OFF;

    $mail->Host = 'smtp.gmail.com';

    $mail->Port = 465;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    $mail->SMTPAuth = true;

    $mail->Username = USERNAME;
    $mail->Password = PASSWORD;

    $mail->setFrom(USERNAME);
    $mail->addReplyTo($email);
    $mail->addAddress($email);

    $mail->Subject = $subject;
    $mail->Body = $message;
    

    if (!$mail->send()) {
        return "Email non envoyé." . $mail->ErrorInfo;
    } else {
        return "Email envoyé.";
    }
}
