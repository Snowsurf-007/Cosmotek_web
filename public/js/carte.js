let cachePlats = {};

async function chargerPlats(filtre = 'all', recherche = '') {
    const container = document.getElementById('carte-container');
    container.innerHTML = '<p>Chargement...</p>';

    try {
        const response = await fetch(`../php/api_plats.php?f=${encodeURIComponent(filtre)}&q=${encodeURIComponent(recherche)}`);
        cachePlats = await response.json();
        afficherPlats(cachePlats);
    } catch (error) {
        console.error("Détail de l'erreur :", error);
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

            let htmlBadge = "";
            if (plat.badge && plat.badge.trim() !== "") {
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
    document.querySelectorAll('.filter').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.filter').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            chargerPlats(this.dataset.filter);
        });
    });

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

    const inputRecherche = document.getElementById('input-recherche');

    document.getElementById('btn-recherche').addEventListener('click', () => {
        if (inputRecherche) {
            chargerPlats('all', inputRecherche.value);
        }
    });

    if (inputRecherche) {
        inputRecherche.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                chargerPlats('all', inputRecherche.value);
            }
        });
    }

    const urlParams = new URLSearchParams(window.location.search);
    const rechercheIndex = urlParams.get('q');

    if (rechercheIndex) {
        if (inputRecherche) {
            inputRecherche.value = rechercheIndex;
        }
        chargerPlats('all', rechercheIndex);
    } else {
        chargerPlats();
    }
});
