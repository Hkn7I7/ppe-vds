<?php

require 'connexion.php';
$id = $_GET['id'];

// récupérer les infos du partenaire
$stmt = $pdo->prepare("SELECT * FROM partenaires WHERE id = ?");
$stmt->execute([$id]);
$partenaire = $stmt->fetch();

if (isset($_POST['modifier'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $site = $_POST['site_web'];

    $sql = "UPDATE partenaires SET nom=?, description=?, site_web=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $description, $site, $id]);
    echo "✅ Modifications enregistrées";
}
?>

<form method="POST">
    Nom: <input type="text" name="nom" value="<?= htmlspecialchars($partenaire['nom']); ?>"><br>
    Description: <textarea name="description"><?= htmlspecialchars($partenaire['description']); ?></textarea><br>
    Site web: <input type="text" name="site_web" value="<?= htmlspecialchars($partenaire['site_web']); ?>"><br>
    <input type="submit" name="modifier" value="Modifier">
</form>

