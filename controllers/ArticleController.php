<?php
require_once __DIR__ . '/../models/Article.php';
require_once __DIR__ . '/../models/Categorie.php';

class ArticleController {
    private $articleModel;
    private $categorieModel;
    
    public function __construct() {
        try {
            $this->articleModel = new Article();
            $this->categorieModel = new Categorie();
        } catch(Exception $e) {
            die("Erreur dans le contrôleur : " . $e->getMessage());
        }
    }
    
    public function index() {
        try {
            $articles = $this->articleModel->getAll();
            $categories = $this->categorieModel->getAll();
            $view = 'articles/index';
            include __DIR__ . '/../views/layout/main.php';
        } catch(PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    
    public function details($id) {
        try {
            $article = $this->articleModel->getById($id);
            $view = 'articles/details';
            include __DIR__ . '/../views/layout/main.php';
        } catch(PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    
    public function admin() {
    try {
        $articles = $this->articleModel->getAll();
        $categories = $this->categorieModel->getAll();
        $view = 'admin/index';
        include __DIR__ . '/../views/layout/main.php';
    } catch(PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}
    
   public function ajouter() {
    try {
        $categories = $this->categorieModel->getAll();
        $message = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'];
            $contenu = $_POST['contenu'];
            $categorie = $_POST['categorie'];
            
            if ($this->articleModel->create($titre, $contenu, $categorie)) {
                // CHANGEMENT ICI : URL complète avec index.php
                header('Location: /mglsi-news-v2/index.php?url=admin');
                exit;
            } else {
                $message = 'Erreur lors de l\'ajout';
            }
        }
        
        $view = 'admin/ajouter';
        include __DIR__ . '/../views/layout/main.php';
    } catch(PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}
    
   public function supprimer($id) {
    try {
        if ($this->articleModel->delete($id)) {
            // Rediriger vers l'admin avec un message de succès
            header('Location: /mglsi-news-v2/index.php?url=admin&success=1');
            exit;
        } else {
            header('Location: /mglsi-news-v2/index.php?url=admin&error=1');
            exit;
        }
    } catch(PDOException $e) {
        header('Location: /mglsi-news-v2/index.php?url=admin&error=' . urlencode($e->getMessage()));
        exit;
    }
}
   public function modifier($id) {
    try {
        $categories = $this->categorieModel->getAll();
        $article = $this->articleModel->getById($id);
        $message = '';
        
        // Vérifier si l'article existe
        if (!$article) {
            header('Location: /mglsi-news-v2/index.php?url=admin&error=article_introuvable');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'];
            $contenu = $_POST['contenu'];
            $categorie = $_POST['categorie'];
            
            // Validation
            if (empty($titre) || empty($contenu) || empty($categorie)) {
                $message = '<div style="color: red; padding: 10px; background: #f8d7da; border-radius: 5px;">Tous les champs sont obligatoires !</div>';
            } else {
                // Mise à jour dans la base de données
                if ($this->articleModel->update($id, $titre, $contenu, $categorie)) {
                    // Rediriger vers l'admin avec message de succès
                    header('Location: /mglsi-news-v2/index.php?url=admin&modification=success');
                    exit;
                } else {
                    $message = '<div style="color: red; padding: 10px; background: #f8d7da; border-radius: 5px;">Erreur lors de la modification.</div>';
                }
            }
        }
        
        $view = 'admin/modifier';
        include __DIR__ . '/../views/layout/main.php';
    } catch(PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}

   public function api($categorie = 'all') {
    // IMPORTANT : définir le header avant tout affichage
    header('Content-Type: application/json');
    
    try {
        if ($categorie !== 'all') {
            $articles = $this->articleModel->getByCategorie($categorie);
        } else {
            $articles = $this->articleModel->getAll();
        }
        
        echo json_encode($articles);
    } catch(Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
}
?>