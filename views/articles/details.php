<?php if (isset($article)): ?>
    <div class="actualite-card" style="border-left-color: #1a3a5c;">
        <span class="categorie-badge"><?php echo htmlspecialchars($article['categorie_libelle']); ?></span>
        <h1><?php echo htmlspecialchars($article['titre']); ?></h1>
        <div class="meta"><?php echo date('d/m/Y à H:i', strtotime($article['dateCreation'])); ?></div>
        <div style="margin-top: 20px; line-height: 1.8;">
            <?php echo nl2br(htmlspecialchars($article['contenu'])); ?>
        </div>
        <a href="/mglsi-news-v2/index.php" class="btn" style="margin-top: 20px;">
    </div>
<?php else: ?>
    <p>Article non trouvé.</p>
<?php endif; ?>