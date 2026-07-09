<?php
require_once 'config/database.php';

global $pdo;

echo "<h1>Test de connexion à la base de données</h1>";

if (isset($pdo)) {
    echo "<p style='color:green;'>✅ Connexion PDO établie avec succès !</p>";
    
    try {
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM Article");
        $result = $stmt->fetch();
        echo "<p>📊 Nombre d'articles : " . $result['total'] . "</p>";
        
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM Categorie");
        $result = $stmt->fetch();
        echo "<p>📊 Nombre de catégories : " . $result['total'] . "</p>";
        
        echo "<h2>Liste des articles :</h2>";
        $stmt = $pdo->query("SELECT * FROM Article LIMIT 5");
        while($row = $stmt->fetch()) {
            echo "<p>- " . htmlspecialchars($row['titre']) . "</p>";
        }
    } catch(PDOException $e) {
        echo "<p style='color:red;'>❌ Erreur SQL : " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color:red;'>❌ PDO n'est pas défini !</p>";
}
?>