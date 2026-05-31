// verif en direct
function verifstat() {
    //on verif avec php
    fetch('../php/statut.php')
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur réseau ou fichier statut.php introuvable");
            }
            return response.json();
        })
        .then(data => {
            console.log("Statut reçu du serveur :", data.statut);

            if (data.statut === "bloque") {
                alert("Votre compte a été bloqué par un administrateur. Vous allez être déconnecté.");
                window.location.href = "../php/bloque.php";
            }
        })
        .catch(error => {
            console.error("Erreur lors de la vérification du statut :", error);
        });
}

// Verif toutes les secondes 
setInterval(verifstat, 1000);
