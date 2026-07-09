<div class="admin-panel">
    <h2>Ajouter un article</h2>
    
    <?php if (isset($message) && $message): ?>
        <div style="color: green; padding: 10px; background: #d4edda; border-radius: 5px; margin-bottom: 20px;">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="titre">Titre *</label>
            <input type="text" id="titre" name="titre" required placeholder="Entrez le titre de l'article">
        </div>
        
        <div class="form-group">
            <label for="categorie">Catégorie *</label>
            <select id="categorie" name="categorie" required>
                <option value="">-- Sélectionner une catégorie --</option>
                <?php if (isset($categories)): ?>
                    <?php foreach($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>">
                            <?php echo htmlspecialchars($cat['libelle']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="contenu">Contenu *</label>
            <textarea id="contenu" name="contenu" required placeholder="Écrivez le contenu de l'article..."></textarea>
        </div>
        
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Ajouter
        </button>
    <a href="/mglsi-news-v2/index.php?url=admin" class="btn">Annuler</a>    </form>
</div>