<?php
// Script d'initialisation de la base de données

$host = 'localhost';
$user = 'root';
$pass = '';

try {
    // Connexion sans spécifier de base de données
    $pdo = new PDO("mysql:host=$host;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Créer la base de données si elle n'existe pas
    $pdo->exec("CREATE DATABASE IF NOT EXISTS partenaires CHARACTER SET utf8 COLLATE utf8_general_ci");
    echo "✅ Base de données 'partenaires' créée ou existe déjà.<br>";

    // Sélectionner la base de données
    $pdo->exec("USE partenaires");

    // Créer la table partenaires si elle n'existe pas
    $sql = "CREATE TABLE IF NOT EXISTS partenaires (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        description TEXT,
        site_web VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

    $pdo->exec($sql);
    echo "✅ Table 'partenaires' créée ou existe déjà.<br>";

    echo "<br><a href='partenaires.php'>Retour à la gestion des partenaires</a>";

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
