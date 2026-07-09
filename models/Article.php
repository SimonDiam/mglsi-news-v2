<?php
// Connexion directe pour éviter les problèmes
class Article {
    private $pdo;
    
    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host=localhost;dbname=mglsi_news;charset=utf8",
                "root",
                ""
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Erreur PDO : " . $e->getMessage());
            die("Erreur de connexion à la base de données");
        }
    }
    
    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT a.*, c.libelle as categorie_libelle 
            FROM Article a 
            LEFT JOIN Categorie c ON a.categorie = c.id 
            ORDER BY a.dateCreation DESC
        ");
        return $stmt->fetchAll();
    }
    
    public function getByCategorie($categorieId) {
        $stmt = $this->pdo->prepare("
            SELECT a.*, c.libelle as categorie_libelle 
            FROM Article a 
            LEFT JOIN Categorie c ON a.categorie = c.id 
            WHERE a.categorie = ? 
            ORDER BY a.dateCreation DESC
        ");
        $stmt->execute([$categorieId]);
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $stmt = $this->pdo->prepare("
            SELECT a.*, c.libelle as categorie_libelle 
            FROM Article a 
            LEFT JOIN Categorie c ON a.categorie = c.id 
            WHERE a.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function create($titre, $contenu, $categorie) {
        $stmt = $this->pdo->prepare("INSERT INTO Article (titre, contenu, categorie) VALUES (?, ?, ?)");
        return $stmt->execute([$titre, $contenu, $categorie]);
    }
    
    // NOUVELLE MÉTHODE : Mise à jour d'un article
    public function update($id, $titre, $contenu, $categorie) {
        $stmt = $this->pdo->prepare("
            UPDATE Article 
            SET titre = ?, 
                contenu = ?, 
                categorie = ?,
                dateModification = NOW()
            WHERE id = ?
        ");
        return $stmt->execute([$titre, $contenu, $categorie, $id]);
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Article WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>