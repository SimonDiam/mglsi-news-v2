<div class="admin-panel">
    <h2>Modifier l'article</h2>
    
    <?php if ($message): ?>
        <?php echo $message; ?>
    <?php endif; ?>
    
    <?php if (isset($article) && $article): ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="titre">Titre *</label>
            <input type="text" id="titre" name="titre" required 
                   value="<?php echo htmlspecialchars($article['titre']); ?>">
        </div>
        
        <div class="form-group">
            <label for="categorie">Catégorie *</label>
            <select id="categorie" name="categorie" required>
                <option value="">-- Sélectionner une catégorie --</option>
                <?php foreach($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" 
                        <?php echo ($cat['id'] == $article['categorie']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cat['libelle']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="contenu">Contenu *</label>
            <textarea id="contenu" name="contenu" required><?php 
                echo htmlspecialchars($article['contenu']); 
            ?></textarea>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Enregistrer les modifications
            </button>
            <a href="/mglsi-news-v2/index.php?url=admin" class="btn">
                <i class="fas fa-times"></i> Annuler
            </a>
        </div>
    </form>
    <?php else: ?>
        <p style="color: red;">Article non trouvé.</p>
        <a href="/mglsi-news-v2/index.php?url=admin" class="btn">Retour à l'admin</a>
    <?php endif; ?>
</div>