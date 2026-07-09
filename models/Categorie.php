<?php
require_once __DIR__ . '/../config/database.php';

class Categorie {
    private $pdo;
    
    public function __construct() {
        if (defined('DB_PDO')) {
            $this->pdo = DB_PDO;
        } elseif (isset($GLOBALS['pdo'])) {
            $this->pdo = $GLOBALS['pdo'];
        } else {
            try {
                $this->pdo = new PDO(
                    "mysql:host=localhost;dbname=mglsi_news;charset=utf8",
                    "root",
                    ""
                );
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                die("Erreur de connexion dans Categorie : " . $e->getMessage());
            }
        }
    }
    
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM Categorie ORDER BY libelle");
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Categorie WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>