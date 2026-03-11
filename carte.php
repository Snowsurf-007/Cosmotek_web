<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmotek - Carte</title>
    <link href="Photos/Logo.png" alt="Logo planete" rel="icon">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="accueil.html" class="logo-link">
                <img src="Photos/Logo.png" alt="Cosmotek Logo" class="header-logo">
                <span class="site-name">Cosmotek</span>
            </a>
            <nav class="header-nav">
                <a href="carte.html">CARTE</a>
                <a href="inscription.html">INSCRIPTION</a>
                <a href="connexion.html">CONNEXION</a>
                <a href="profil.html">PROFIL</a>
                <a href="avis.html">AVIS</a>
            </nav>
        </div>
    </header>
   
    <div class="page carte">
        <h1>CARTE DU RESTAURANT</h1>
        
        <div>
            <span>Filtrer :</span>
            <br> <br>
            <button class="filter" data-filter="all"> Tout</button>
            <button class="filter" data-filter="entrees"> Entrées</button>
            <button class="filter" data-filter="plats"> Plats</button>
            <button class="filter" data-filter="desserts"> Desserts</button>
            <button class="filter" data-filter="boissons"> Boissons</button>
            <button class="filter" data-filter="menus"> Menus</button>
            <br> <br>
            <button class="filter" data-filter="vege"> Végé</button>
            <button class="filter" data-filter="viande"> Viande</button>
            <button class="filter" data-filter="alcool"> Alcool</button>
            <button class="filter" data-filter="sansalcool"> Sans Alcool</button>
            <button class="filter" data-filter="substance"> Substances</button>
            <button class="filter" data-filter="sanssubstance"> Sans Substances</button>
        </div>
        
        <br><br>
        <h2>RECHERCHER UN PLAT</h2>
        <input type="text" placeholder="Rechercher..." />
        <button>Rechercher</button>
        <br>

        <!-- ENTRÉES -->
        <h1></h1>
        <h2>ENTRÉES</h2>
        <div class="menu-grid">
            <div class="plat-card">
                <span class="plat-badge">Populaire</span>
                <img src="Photos/Jambon-melon.jpg" alt="Jambon Melon">
                <div class="plat-content">
                    <h3>Le Jambon Melon</h3>
                    <p class="plat-description">Jambon de Parme et melon frais de saison</p>
                    <div class="plat-price">9€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <img src="Photos/Salade.png" alt="Salade">
                <div class="plat-content">
                    <h3>Salade</h3>
                    <p class="plat-description">Salade fraîche du jour avec vinaigrette maison</p>
                    <div class="plat-price">8€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <span class="plat-badge">2 personnes</span>
                <img src="Photos/Planchefoncedalle.jpeg" alt="Planche Foncedalle">
                <div class="plat-content">
                    <h3>Planche Foncedalle</h3>
                    <p class="plat-description">Assortiment de charcuterie et fromages</p>
                    <div class="plat-price">18€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>
        </div>

        <!-- PLATS -->
        <h1></h1>
        <h2>PLATS</h2>
        <div class="menu-grid">
            <div class="plat-card">
                <span class="plat-badge">Plat du jour</span>
                <img src="Photos/pizza.png" alt="Pizza Cosmique">
                <div class="plat-content">
                    <h3>Pizza Cosmique</h3>
                    <p class="plat-description">Pizza maison garnie façon spatiale</p>
                    <div class="plat-price">13€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <img src="Photos/Pates-pesto.jpeg" alt="Pâtes Pestoverde">
                <div class="plat-content">
                    <h3>Pâtes Pestoverde</h3>
                    <p class="plat-description">Pâtes fraîches au pesto basilic</p>
                    <div class="plat-price">12€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <span class="plat-badge">Populaire</span>
                <img src="Photos/Burger.jpg" alt="Burger Spatial">
                <div class="plat-content">
                    <h3>Burger Spatial</h3>
                    <p class="plat-description">Burger maison avec frites croustillantes</p>
                    <div class="plat-price">15€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>
        </div>

        <!-- DESSERTS -->
        <h1></h1>
        <h2>DESSERTS</h2>
        <div class="menu-grid">
            <div class="plat-card">
                <img src="Photos/Tartemyrtillles.jpg" alt="Tarte Blueberry">
                <div class="plat-content">
                    <h3>Tarte Blueberry</h3>
                    <p class="plat-description">Tarte aux myrtilles fraîches</p>
                    <div class="plat-price">5.5€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <span class="plat-badge">Populaire</span>
                <img src="Photos/Space-cake.jpg" alt="Gâteau Spatial">
                <div class="plat-content">
                    <h3>Gâteau Spatial</h3>
                    <p class="plat-description">Gâteau signature de la maison</p>
                    <div class="plat-price">8€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <img src="Photos/Glace.jpeg" alt="Glace Crystal">
                <div class="plat-content">
                    <h3>Glace Crystal</h3>
                    <p class="plat-description">Glace artisanale aux cristaux givrants</p>
                    <div class="plat-price">4.5€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>
        </div>

        <!-- BOISSONS -->
        <h1></h1>
        <h2>BOISSONS</h2>
        <div class="menu-grid">
            <div class="plat-card">
                <img src="Photos/eau.jpg" alt="Eau">
                <div class="plat-content">
                    <h3>Monoxyde de Dihydrogène</h3>
                    <p class="plat-description">Eau minérale naturelle</p>
                    <div class="plat-price">2€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <img src="Photos/Eau-petillante.jpg" alt="Eau Pétillante">
                <div class="plat-content">
                    <h3>Eau Pétillante</h3>
                    <p class="plat-description">Eau gazeuse rafraîchissante</p>
                    <div class="plat-price">2.5€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <img src="Photos/Jagerbomb.jpg" alt="Jäger Bomb">
                <div class="plat-content">
                    <h3>Jäger Bomb</h3>
                    <p class="plat-description">Cocktail énergétique explosif</p>
                    <div class="plat-price">6€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <img src="Photos/TEK-PAF.jpg" alt="Tek Paf">
                <div class="plat-content">
                    <h3>Tek Paf</h3>
                    <p class="plat-description">Shot spécial maison</p>
                    <div class="plat-price">7€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <img src="Photos/Biere.jpg" alt="Rince Cochon">
                <div class="plat-content">
                    <h3>Rince Cochon (50cl)</h3>
                    <p class="plat-description">Bière artisanale locale</p>
                    <div class="plat-price">4.5€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <img src="Photos/absinthe.jpeg" alt="Absinthe">
                <div class="plat-content">
                    <h3>Absinthe (shot)</h3>
                    <p class="plat-description">La fée verte authentique</p>
                    <div class="plat-price">7.5€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <span class="plat-badge">Populaire</span>
                <img src="Photos/gel-hydroalcoolique.jpg" alt="Gel Hydroalcoolique">
                <div class="plat-content">
                    <h3>Gel Hydroalcoolique</h3>
                    <p class="plat-description">Pour les aventuriers téméraires</p>
                    <div class="plat-price">3€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>
        </div>

        <!-- MENUS -->
        <h1></h1>
        <h2>LES MENUS</h2>
        <p>Tous les jours</p>
        <div class="menu-grid">

            <div class="plat-card">
                <div class="plat-content">
                    <h3>Formule Entrée + Plat</h3>
                    <p class="plat-description">
                        <strong>Entrée :</strong> Salade, Le Jambon Melon<br>
                        <strong>Plat :</strong> Pâtes Pestoverde, Burger Spatial
                    </p>
                    <div class="plat-price">16€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <div class="plat-content">
                    <h3>Formule Plat + Dessert</h3>
                    <p class="plat-description">
                        <strong>Plat :</strong> Pâtes Pestoverde, Burger Spatial<br>
                        <strong>Dessert :</strong> Tarte Blueberry, Glace Crystal
                    </p>
                    <div class="plat-price">13€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <div class="plat-content">
                    <h3>Formule Complète</h3>
                    <p class="plat-description">
                        <strong>Entrée :</strong> Salade, Le Jambon Melon<br>
                        <strong>Plat :</strong> Pâtes Pestoverde, Burger Spatial<br>
                        <strong>Dessert :</strong> Tarte Blueberry, Glace Crystal<br>
                        <strong>Boisson :</strong> Eau, Eau pétillante, Rince Cochon (50cl), Gel Hydroalcoolique
                    </p>
                    <div class="plat-price">20€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>

            <div class="plat-card">
                <div class="plat-content">
                    <h3>Menu Enfant</h3>
                    <p class="plat-description">
                        <strong>Entrée :</strong> Salade, Le Jambon Melon<br>
                        <strong>Plat :</strong> Pâtes Pestoverde, Burger Spatial<br>
                        <strong>Dessert :</strong> Tarte Blueberry, Glace Crystal<br>
                        <strong>Boisson :</strong> Eau, Eau pétillante, Rince Cochon (50cl), Gel Hydroalcoolique
                    </p>
                    <div class="plat-price">11€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>
        </div>

        <div class="menu-grid">
            <div class="plat-card">
                <span class="plat-badge">Premium</span>
                <img src="Photos/dégustation.jpg" alt="Table dégustation">
                <div class="plat-content">
                    <h3>Formule Dégustation</h3>
                    <p class="plat-description">
                        <strong>Entrée :</strong> Jambon de Parme, Caviar<br>
                        <strong>Plat :</strong> Saumon, Pièce du boucher<br>
                        <strong>Dessert :</strong> Tarte Tatin, Profiteroles
                    </p>
                    <div class="plat-price">45€</div>
                    <button class="btn-commander">Commander</button>
                </div>
            </div>
        </div>

        <br><br>
        <a href="#top">RETOUR HAUT DE PAGE</a>
    </div>

<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h4>À PROPOS</h4>
            <p>Cosmotek - Restaurant intergalactique depuis 2026</p>
            <p>Une expérience culinaire hors du commun</p>
        </div>
        
        <div class="footer-section">
            <h4>NAVIGATION</h4>
            <ul class="footer-links">
                <li><a href="accueil.html">Accueil</a></li>
                <li><a href="carte.html">Notre Carte</a></li>
                <li><a href="inscription.html">Inscription</a></li>
                <li><a href="connexion.html">Connexion</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4>CONTACT</h4>
            <p>📍 Galaxie Andromède, Secteur 7G</p>
            <p>📞 +33 (0)1 23 45 67 89</p>
            <p>✉️ contact@Cosmotek</p>
        </div>
        
        <div class="footer-section">
            <h4>HORAIRES</h4>
            <p>Lun - Ven: 11h00 - 23h00</p>
            <p>Sam - Dim: 10h00 - 00h00</p>
            <p>🚀 Livraison spatiale disponible</p>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2026 Cosmotek - Tous droits réservés | Mentions légales | Politique de confidentialité</p>
    </div>
</footer>
</body>
</html>
