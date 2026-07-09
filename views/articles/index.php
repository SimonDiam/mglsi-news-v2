<?php if (isset($articles) && count($articles) > 0): ?>
    <?php foreach($articles as $article): ?>
        <div class="actualite-card">
            <span class="categorie-badge"><?php echo htmlspecialchars($article['categorie_libelle']); ?></span>
            <h2><?php echo htmlspecialchars($article['titre']); ?></h2>
            <div class="meta"><?php echo date('d/m/Y', strtotime($article['dateCreation'])); ?></div>
            <p><?php echo htmlspecialchars(substr($article['contenu'], 0, 200)); ?>...</p>
<a href="/mglsi-news-v2/index.php?url=detail/<?php echo $article['id']; ?>" class="btn">Lire la suite</a>        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun article trouvé.</p>
<?php endif; ?>