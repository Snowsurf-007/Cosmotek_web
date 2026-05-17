# 🪐 Cosmotek

### Interface de ravitaillement galactique

**CY Tech – préING2 – 2025/2026**

---

## 🎯 Description du projet

**Cosmotek** est une application web multi-utilisateurs simulant un système de restauration destiné aux explorateurs galactiques.

L’application couvre l’ensemble du cycle de commande :
de la sélection des produits par l’explorateur jusqu’à la livraison finale par navette.

---

## 🧩 Architecture

### 🚀 Phase #1

La première phase repose sur :

* Une **interface graphique statique** développée en **HTML5**
* Une **charte graphique immersive** centralisée dans un unique fichier CSS
* Une **adaptation multi-terminaux** (ordinateur, tablette, smartphone)

---

### ⚙️ Phase #2

La deuxième phase introduit une **dimension dynamique côté serveur**.

Elle permet de rendre l’application **fonctionnelle avec gestion des données et interactions utilisateurs**.

* Utilisation de **PHP** pour générer des pages dynamiques
* Mise en place d’un **stockage de données** (JSON)
* Organisation du projet avec séparation entre **vues, logique et données**

---

### ⚡ Phase #3

La troisiéme phase ajoute la partie asynchrone

* **Zéro rechargement** : Utilisation intensive de **JavaScript (DOM)** et de requêtes asynchrones pour modifier l'interface en temps réel.
* **Persistance locale** : Stockage des préférences d'affichage dans les cookies.
* **Sécurisation front-end** : Validation des formulaires côté client avant envoi au serveur.

---

## ⚙️ Fonctionnalités

### 🖥️ 1. Interfaces de navigation (Front-end)

Modules visuels développés pour **4 profils utilisateurs** :

#### 👨‍🚀 Client

* Accueil
* Consultation de la carte des produits
* Inscription, Connexion et profil
* Système de notation
* Panier et commande (phase 2)
* Historique et suivi des commandes

#### 🍳 Restaurateur

* Interface adaptée aux tablettes
* Préparation des commandes
* Gestion des commandes (en attente, en cours, livrées)

#### 🚀 Livreur

* Interface adaptée aux téléphones mobiles
* Accès aux livraisons assignées
* Mise à jour du statut des livraisons

#### 💻 Administrateur

* Interface permettant de voir les dernières commandes
* Gestion des utilisateurs (consultation, statuts)

---

### 🔐 2. Gestion des données et accès

* **Authentification fonctionnelle**

  * Inscription utilisateur
  * Connexion sécurisée

* **Gestion des rôles**

  * Client
  * Restaurateur
  * Livreur
  * Administrateur

* **Données gérées**

  * Utilisateurs
  * Plats et menus
  * Commandes
  * Paiements
  * Options (réductions, personnalisations)

---

### 🛒 3. Système de commande

#### 👨‍🚀 Client

* Ajout d’articles au panier
* Validation et paiement de commande
* Suivi du statut (préparation, livraison, livré)
* Historique des commandes
* Notation après livraison

#### 🍳 Restaurateur

* Consultation des commandes
* Accès aux détails
* Changement de statut (préparation → livraison)
* Attribution à un livreur

#### 🚀 Livreur

* Accès aux commandes assignées
* Informations de livraison
* Validation de livraison

#### 💻 Administrateur

* Accès aux profils utilisateurs
* Gestion des comptes (blocage, statuts…)

---

## 🛠️ Installation & Exécution

### 1️⃣ Cloner le dépôt

```bash
git clone https://github.com/Snowsurf-007/Cosmotek_web
cd Cosmotek_web
```

### 2️⃣ Lancer l’application

* Le fichier `accueil.html` (ou `.php` en phase 2) constitue le point d’entrée utilisateur

### 📱 Simulation Mobile (Livreur)

1. Ouvrir les outils de développement (`F12`)
2. Activer le mode **responsive**
3. Choisir un format smartphone (ex : 360 x 740)

---

## 📂 Structure du projet

* `accueil.html / .php` → Page d’accueil

* `admin.html / .php` → Interface administrateur

* `carte.html / .php` → Consultation des produits

* `inscription.html / .php` → Inscription

* `connexion.html / .php` → Connexion

* `profil.html / .php` → Profil utilisateur

* `commande.html / .php` → Interface restaurateur

* `livraison.html / .php` → Interface livreur

* `avis.html / .php` → Notation

* `style.css` → Charte graphique

---

## 📄 Documentation

* **Charte graphique**
* **Rapport de mission** :

  * Phase #1
  * Phase #2
  * Phase #3
  * conception + organisation
  * modèle de données, choix techniques, problèmes rencontrés et solutions

---

## 👥 Auteurs

* **Ibrahima TRAORE**
* **Hugo TRENY**
* **Lucien LEHEUDRE--EPSTEIN**

---

## 🌌 Univers graphique

Charte visuelle immersive inspirée :
**Boite techno / Néon / Interface futuriste**
