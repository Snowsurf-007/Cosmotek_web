let cachePlats = {}; 

// 1. Récupération asynchrone des données
async function chargerPlats(filtre = 'all', recherche = '') {
    const container = document.getElementById('carte-container');
    container.innerHTML = '<p>Chargement de la carte...</p>';

    try {
        const response = await fetch(`api_plats.php?f=${encodeURIComponent(filtre)}&q=${encodeURIComponent(recherche)}`);
        cachePlats = await response.json();
        afficherPlats(cachePlats);
    } catch (error) {
        container.innerHTML = "<p>Erreur lors de la récupération des plats.</p>";
    }
}

// 2. Génération du HTML (Inclusion du formulaire Panier)
function afficherPlats(data) {
    const container = document.getElementById('carte-container');
    container.innerHTML = ""; 

    if (Object.keys(data).length === 0) {
        container.innerHTML = '<p>Aucun plat trouvé.</p>';
        return;
    }

    for (const [nomCat, plats] of Object.entries(data)) {
        let htmlSection = `
            <section class="menu-section">
                <h2>${nomCat.toUpperCase()}</h2>
                <div class="menu-grid">`;

        plats.forEach(plat => {
            // Changement ici : On injecte un formulaire POST identique à ton ancien code PHP
            htmlSection += `
                <div class="plat-card">
                    ${plat.badge ? `<span class="plat-badge">${plat.badge}</span>` : ''}
                    ${plat.image ? `<img src="${plat.image}" alt="${plat.nom}">` : ''}
                    <div class="plat-content">
                        <h3>${plat.nom}</h3>
                        <p class="plat-description">${plat.description}</p>
                        <div class="plat-price">${plat.prix}€</div>
                        
                        <form method="POST" action="ajout_panier.php">
                            <input type="hidden" name="nom" value="${plat.nom}">
                            <input type="hidden" name="prix" value="${plat.prix}">
                            <input type="hidden" name="image" value="${plat.image || ''}">
                            <button type="submit" class="btn-commander">Ajouter au panier</button>
                        </form>
                    </div>
                </div>`;
        });

        htmlSection += `</div></section>`;
        container.innerHTML += htmlSection;
    }
}

// 3. Système de tri local
document.getElementById('tri-select').addEventListener('change', function() {
    const mode = this.value;
    let copies = JSON.parse(JSON.stringify(cachePlats));

    for (let cat in copies) {
        copies[cat].sort((a, b) => {
            if (mode === 'prix-asc') return a.prix - b.prix;
            if (mode === 'prix-desc') return b.prix - a.prix;
            if (mode === 'nom-asc') return a.nom.localeCompare(b.nom);
            return 0;
        });
    }
    afficherPlats(copies);
});

// 4. Écouteurs pour les filtres et recherche
document.querySelectorAll('.btn-filter').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.btn-filter').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        chargerPlats(this.dataset.filter);
    });
});

document.getElementById('btn-recherche').addEventListener('click', () => {
    const q = document.getElementById('input-recherche').value;
    chargerPlats('all', q);
});

// Lancement initial
chargerPlats();