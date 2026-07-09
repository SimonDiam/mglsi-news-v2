document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav a[data-categorie]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            
            const categorie = this.getAttribute('data-categorie');
            chargerArticles(categorie);
        });
    });
});

function chargerArticles(categorie) {
    const container = document.querySelector('.container');
    
    container.innerHTML = `
        <div style="text-align: center; padding: 50px;">
            <div class="spinner"></div>
            <p style="margin-top: 20px;">Chargement...</p>
        </div>
    `;
    
    fetch(`/mglsi-news-v2/index.php?url=api/${categorie}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                container.innerHTML = `<p style="color:red;">Erreur : ${data.error}</p>`;
                return;
            }
            
            if (data.length === 0) {
                container.innerHTML = '<p style="text-align:center;">Aucun article dans cette catégorie.</p>';
                return;
            }
            
            let html = '';
            data.forEach(article => {
                const date = new Date(article.dateCreation);
                const dateFormatee = date.toLocaleDateString('fr-FR');
                
                html += `
                    <div class="actualite-card">
                        <span class="categorie-badge">${article.categorie}</span>
                        <h2>${article.titre}</h2>
                        <div class="meta">${dateFormatee}</div>
                        <p>${article.contenu.substring(0, 200)}...</p>
                        <a href="#" class="btn">Lire la suite</a>
                    </div>
                `;
            });
            
            container.innerHTML = html;
        })
        .catch(error => {
            container.innerHTML = `<p style="color:red;">Erreur : ${error.message}</p>`;
        });
}

// Ajouter le style du spinner
const style = document.createElement('style');
style.textContent = `
    .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #f4c430;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
`;
document.head.appendChild(style);