<?php
session_start();

// Autoloader simple
spl_autoload_register(function($className) {
    $paths = [
        __DIR__ . '/models/' . $className . '.php',
        __DIR__ . '/controllers/' . $className . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Récupérer l'URL
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$urlParts = explode('/', $url);

$controller = isset($urlParts[0]) && !empty($urlParts[0]) ? $urlParts[0] : 'accueil';
$action = isset($urlParts[1]) ? $urlParts[1] : '';
$param = isset($urlParts[2]) ? $urlParts[2] : null;

// Router
if ($controller === 'api') {
    $articleCtrl = new ArticleController();
    $articleCtrl->api($action);
} elseif ($controller === 'supprimer') {
    $articleCtrl = new ArticleController();
    $articleCtrl->supprimer($action);
} elseif ($controller === 'detail') {
    $articleCtrl = new ArticleController();
    $articleCtrl->details($action);
} elseif ($controller === 'admin') {
    $articleCtrl = new ArticleController();
    $articleCtrl->admin();
} elseif ($controller === 'ajouter') {
    $articleCtrl = new ArticleController();
    $articleCtrl->ajouter();
    } elseif ($controller === 'modifier') {
    $articleCtrl = new ArticleController();
    $articleCtrl->modifier($action);
    
} else {
    $articleCtrl = new ArticleController();
    $articleCtrl->index();
    
}

?>