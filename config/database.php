<?php
// Configuration de la base de données
$host = 'localhost';
$dbname = 'mglsi_news';
$username = 'root';
$password = '';

try {
    // Créer la connexion PDO
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );
    
    // Configurer PDO pour qu'il lance des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Rendre $pdo disponible DANS TOUT LE SCRIPT
    // Méthode 1: Variable globale
    $GLOBALS['pdo'] = $pdo;
    
    // Méthode 2: Constante
    define('DB_PDO', $pdo);
    
} catch(PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>