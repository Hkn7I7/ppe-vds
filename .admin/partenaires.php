<?php
require 'connexion.php';

// --- AJOUTER ---
if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'] ?? '';
    $site_web = $_POST['site_web'] ?? '';

    try {
        $sql = "INSERT INTO partenaires (nom, description, site_web) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $description, $site_web]);
        echo "<div style='color: green;'>✅ Partenaire ajouté avec succès!</div>";
    } catch (PDOException $e) {
        echo "<div style='color: red;'>❌ Erreur lors de l'ajout : " . $e->getMessage() . "</div>";
    }
}

$table = 'partenaires';
$sql = "SHOW TABLES LIKE ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$table]);

if ($stmt->rowCount() > 0) {
    echo "✅ La table '$table' existe.";
} else {
    echo "❌ La table '$table' n'existe pas. <a href='init_db.php'>Cliquez ici pour l'initialiser</a>";
}

// --- LISTER ---
try {
    $sql = "SELECT * FROM partenaires ORDER BY created_at DESC";
    $stmt = $pdo->query($sql);
    $partenaires = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "<div style='color: red;'>❌ Erreur lors de la récupération : " . $e->getMessage() . "</div>";
    $partenaires = [];
}
?>

<h1>Gestion des partenaires</h1>

<h2>Ajouter un partenaire</h2>
<form method="POST">
    Nom: <input type="text" name="nom" required><br>
    Description: <textarea name="description"></textarea><br>
    Site web: <input type="text" name="site_web"><br>
    <input type="submit" name="ajouter" value="Ajouter">
</form>

<h2>Liste des partenaires</h2>
<?php foreach ($partenaires as $p): ?>
    <div>
        <h3><?= htmlspecialchars($p['nom']); ?></h3>
        <p><?= htmlspecialchars($p['description']); ?></p>
        <a href="modifier_partenaire.php?id=<?= $p['id']; ?>">Modifier</a>
        <a href="supprimer_partenaire.php?id=<?= $p['id']; ?>">Supprimer</a>
    </div>
<?php endforeach; ?>