<div class="admin-panel">
    
    <?php
    // Afficher les messages de succès/erreur
    if (isset($_GET['success'])) {
        echo '<div style="color: green; padding: 10px; background: #d4edda; border-radius: 5px; margin-bottom: 20px;">
                <i class="fas fa-check-circle"></i> Article supprimé avec succès !
              </div>';
    }
    if (isset($_GET['error'])) {
        echo '<div style="color: red; padding: 10px; background: #f8d7da; border-radius: 5px; margin-bottom: 20px;">
                <i class="fas fa-exclamation-circle"></i> Erreur lors de la suppression.
              </div>';
    }
    ?>
    <div class="admin-panel">
    <?php
    // Afficher les messages de succès/erreur
    if (isset($_GET['success'])) {
        echo '<div style="color: green; padding: 10px; background: #d4edda; border-radius: 5px; margin-bottom: 20px;">
                <i class="fas fa-check-circle"></i> Article supprimé avec succès !
              </div>';
    }
    if (isset($_GET['error'])) {
        echo '<div style="color: red; padding: 10px; background: #f8d7da; border-radius: 5px; margin-bottom: 20px;">
                <i class="fas fa-exclamation-circle"></i> Erreur lors de la suppression.
              </div>';
    }
    // NOUVEAU : Message de modification réussie
    if (isset($_GET['modification']) && $_GET['modification'] === 'success') {
        echo '<div style="color: green; padding: 10px; background: #d4edda; border-radius: 5px; margin-bottom: 20px;">
                <i class="fas fa-check-circle"></i> Article modifié avec succès !
              </div>';
    }
    ?>
    
   
    
    <!-- ... reste du contenu ... -->
    <h2>Gestion des articles</h2>
    
    <!-- Bouton Ajouter -->
    <a href="/mglsi-news-v2/index.php?url=ajouter" class="btn btn-success" style="margin-bottom: 20px;">
        <i class="fas fa-plus"></i> Ajouter un article
    </a>
    
    <!-- Bouton Retour à l'accueil -->
    <a href="/mglsi-news-v2/index.php" class="btn" style="margin-bottom: 20px; background: #6c757d;">
        <i class="fas fa-home"></i> Retour à l'accueil
    </a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($articles) && count($articles) > 0): ?>
                <?php foreach($articles as $article): ?>
                    <tr>
                        <td><?php echo $article['id']; ?></td>
                        <td><?php echo htmlspecialchars($article['titre']); ?></td>
                        <td><?php echo htmlspecialchars($article['categorie_libelle']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($article['dateCreation'])); ?></td>
                        <td>
                            <!-- Bouton Voir -->
                            <a href="/mglsi-news-v2/index.php?url=detail/<?php echo $article['id']; ?>" 
                               class="btn" 
                               style="padding: 5px 15px; font-size: 0.8rem; background: #17a2b8;">
                                <i class="fas fa-eye"></i> Voir
                            </a>
                            
                            <!-- Bouton Modifier (si vous voulez l'ajouter plus tard) -->
                            <a href="/mglsi-news-v2/index.php?url=modifier/<?php echo $article['id']; ?>" 
   class="btn" 
   style="padding: 5px 15px; font-size: 0.8rem; background: #ffc107; color: #1a3a5c;">
    <i class="fas fa-edit"></i> Modifier
</a>
                            
                            <!-- Bouton Supprimer -->
                            <!-- Bouton Supprimer avec confirmation simple -->
                            <a href="/mglsi-news-v2/index.php?url=supprimer/<?php echo $article['id']; ?>" 
                            class="btn btn-danger" 
                            style="padding: 5px 15px; font-size: 0.8rem;"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">
                        Aucun article trouvé.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>