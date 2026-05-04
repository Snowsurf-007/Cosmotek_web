// Variable globale pour stocker le numéro de commande sélectionné
let commandeActive = null;

/**
 * Ouvre la fenêtre modale et affiche le numéro de la commande
 */
function ouvrirModalLivreur(numeroCommande) {
    commandeActive = numeroCommande;
    document.getElementById('displayNumCommande').innerText = "#" + numeroCommande;
    document.getElementById('modalLivreur').style.display = "block";
}

/**
 * Ferme la fenêtre modale
 */
function fermerModal() {
    document.getElementById('modalLivreur').style.display = "none";
    commandeActive = null;
}

/**
 * Redirige vers la page de changement de statut avec le nom du livreur
 */
function validerLivraison(nomLivreur) {
    if (commandeActive) {
        // Construction de l'URL vers changement.php
        // On passe le numéro et le livreur choisi
        const url = "changement.php?numero=" + commandeActive + "&livreur=" + encodeURIComponent(nomLivreur);
        window.location.href = url;
    }
}

/**
 * Ferme la modale si l'utilisateur clique en dehors du cadre
 */
window.onclick = function(event) {
    const modal = document.getElementById('modalLivreur');
    if (event.target == modal) {
        fermerModal();
    }
}