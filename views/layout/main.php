<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MGLSI News - MVC</title>
    <link rel="stylesheet" href="/mglsi-news-v2/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <h1><span>M1IABD</span> NEWS <small style="font-size: 14px;">version 2 avec MVC</small></h1>
    </header>
    
    <nav class="nav">
        <ul>
            <li><a href="/mglsi-news-v2/index.php" class="active"><i class="fas fa-home"></i> Accueil</a></li>
            <?php 
            if (isset($categories)) {
                foreach($categories as $cat) {
                    $icone = '';
                    if(strtolower($cat['libelle']) == 'sport') $icone = 'fa-futbol';
                    else if(strtolower($cat['libelle']) == 'santé') $icone = 'fa-heart';
                    else if(strtolower($cat['libelle']) == 'education') $icone = 'fa-graduation-cap';
                    else if(strtolower($cat['libelle']) == 'politique') $icone = 'fa-landmark';
                    echo '<li><a href="#" data-categorie="' . $cat['id'] . '"><i class="fas ' . $icone . '"></i> ' . htmlspecialchars($cat['libelle']) . '</a></li>';
                }
            }
            ?>
            <li><a href="/mglsi-news-v2/index.php?url=admin" style="background: #f4c430; color: #1a3a5c;"><i class="fas fa-cog"></i> Admin</a></li>
        </ul>
    </nav>
    
    <div class="container">
        <?php
        if (isset($view)) {
            include __DIR__ . '/../' . $view . '.php';
        }
        ?>
    </div>
    
    <footer class="footer">
        <p>Copyright © DGI 2026 - Version MVC</p>
    </footer>
    
    <script src="/mglsi-news-v2/public/js/script.js"></script>
</body>
</html>