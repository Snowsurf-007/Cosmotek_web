let cachePlats = {};

async function chargerPlats(filtre = 'all', recherche = '') {
    const container = document.getElementById('carte-container');
    container.innerHTML = '<p>Chargement...</p>';

    try {
        const response = await fetch(`../php/api_plats.php?f=${encodeURIComponent(filtre)}&q=${encodeURIComponent(recherche)}`);
        cachePlats = await response.json();
        afficherPlats(cachePlats);
    } catch (error) {
        console.error("Détail de l'erreur :", error); // Ajoute ceci pour voir l'erreur dans la console
        container.innerHTML = "<p>Erreur de ravitaillement.</p>";
    }
}

function afficherPlats(data) {
    const container = document.getElementById('carte-container');
    container.innerHTML = "";

    if (Object.keys(data).length === 0) {
        container.innerHTML = '<p>Aucun plat trouvé.</p>';
        return;
    }

    for (const [nomCat, plats] of Object.entries(data)) {
        let htmlSection = `<section class="menu-section"><h2>${nomCat.toUpperCase()}</h2><div class="menu-grid">`;
        plats.forEach(plat => {

            // --- INJECTION DE TON BADGE D'ORIGINE ---
            let htmlBadge = "";
            if (plat.badge && plat.badge.trim() !== "") {
                // On utilise stricto sensu la classe .plat-badge définie dans ton CSS
                htmlBadge = `<span class="plat-badge">${plat.badge}</span>`;
            }

            htmlSection += `
                <div class="plat-card">
                    ${htmlBadge} <img src="../${plat.image}" alt="${plat.nom}">
                    <div class="plat-content">
                        <h3>${plat.nom}</h3>
                        <p>${plat.description}</p>
                        <div class="plat-price">${plat.prix}€</div>
                        <form method="POST" action="../php/ajout_panier.php">
                            <input type="hidden" name="nom" value="${plat.nom}">
                            <input type="hidden" name="prix" value="${plat.prix}">
                            <input type="hidden" name="image" value="${plat.image}">
                            <button type="submit" class="btn-commander">Ajouter au panier</button>
                        </form>
                    </div>
                </div>`;
        });
        htmlSection += `</div></section>`;
        container.innerHTML += htmlSection;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Écouteurs de filtres
    document.querySelectorAll('.filter').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.filter').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            chargerPlats(this.dataset.filter);
        });
    });

    // Tri
    document.getElementById('tri-select').addEventListener('change', function () {
        let copies = JSON.parse(JSON.stringify(cachePlats));
        const mode = this.value;
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

    // Recherche
    document.getElementById('btn-recherche').addEventListener('click', () => {
        chargerPlats('all', document.getElementById('input-recherche').value);
    });

    chargerPlats(); // Lancement
});