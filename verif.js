//verif cote serveur
function verifierStatutCompte() {
    // on verif 'via php'
    fetch('statut.php')
        .then(response => response.json())
        .then(data => {
            if (data.statut === "bloque") {
                alert("Votre compte a été bloqué par un administrateur. Vous allez être déconnecté.");[cite: 252]
                window.location.href = "deconnexion.php"; // Redirection immédiate
            }
        });
}
// On vérifi toutes les secondes 
setInterval(verifierStatutCompte, 1000);

function afficherErreur(message) {
    const erreur = document.getElementById("erreur");
    erreur.textContent = message;
    erreur.style.display = "block";
}

function togglePassword() {
    const mdp = document.getElementById("mdp");
    const btn = mdp.nextElementSibling;
    if (mdp.type === "password") {
        mdp.type = "text";
        btn.textContent = "Masquer le mot de passe";
    } else {
        mdp.type = "password";
        btn.textContent = "Afficher le mot de passe";
    }
}

const form = document.getElementById("formInscription");

form.addEventListener("submit", (e) => {

    // Reset erreur
    document.getElementById("erreur").style.display = "none";

    const nom     = document.getElementById("nom").value.trim();
    const prenom  = document.getElementById("prenom").value.trim();
    const adresse = document.getElementById("adresse").value.trim();
    const email   = document.getElementById("email").value.trim();
    const mdp     = document.getElementById("mdp").value;
    const date    = document.getElementById("date").value;

    // Champs vides
    if (!nom || !prenom || !adresse || !email || !mdp || !date) {
        e.preventDefault();
        afficherErreur("Veuillez remplir tous les champs obligatoires.");
        return;
    }

    // Nom / Prénom : lettres uniquement
    const regexNom = /^[a-zA-ZÀ-ÿ\s\-]+$/;
    if (!regexNom.test(nom)) {
        e.preventDefault();
        afficherErreur("Le nom ne doit contenir que des lettres.");
        return;
    }
    if (!regexNom.test(prenom)) {
        e.preventDefault();
        afficherErreur("Le prénom ne doit contenir que des lettres.");
        return;
    }

    // Email valide
    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexEmail.test(email)) {
        e.preventDefault();
        afficherErreur("Veuillez entrer une adresse email valide.");
        return;
    }

    // Mot de passe : 8 car. min, 1 majuscule, 1 chiffre
    const regexMdp = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!regexMdp.test(mdp)) {
        e.preventDefault();
        afficherErreur("Le mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre.");
        return;
    }

    // Date : passé + âge >= 13 ans
    const dateNaissance = new Date(date);
    const aujourdhui    = new Date();
    const ageLimite     = new Date();
    ageLimite.setFullYear(ageLimite.getFullYear() - 13);

    if (dateNaissance >= aujourdhui) {
        e.preventDefault();
        afficherErreur("La date de naissance doit être dans le passé.");
        return;
    }
    if (dateNaissance > ageLimite) {
        e.preventDefault();
        afficherErreur("Vous devez avoir au moins 13 ans pour vous inscrire.");
        return;
    }
});
