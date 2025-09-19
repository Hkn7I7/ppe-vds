<?php

$host = 'localhost';
$db = 'partenaires'; // Correction du nom de la base de données
$user = 'root';
$pass = ''; // Ajout de la variable $pass manquante (mot de passe vide par défaut pour localhost)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

?>
