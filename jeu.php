<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cosmotek - Station de Jeu</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .arcade-machine {
            max-width: 1104px;
            margin: 20px auto;
            background: #000;
            border: 3px solid #00f2ff;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            min-height: 644px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #game-placeholder {
            text-align: center;
            z-index: 10;
        }

        .btn-play-now {
            background: transparent;
            color: #00f2ff;
            border: 2px solid #00f2ff;
            padding: 20px 40px;
            font-size: 1.5rem;
            cursor: pointer;
            text-transform: uppercase;
            box-shadow: 0 0 15px #00f2ff;
            transition: 0.3s;
        }

        .btn-play-now:hover {
            background: #00f2ff;
            color: #000;
        }

        iframe {
            width: 1104px;
            height: 644px;
            border: none;
            display: none; /* Caché au début */
        }
    </style>
</head>
<body>
    <?php include("header.php"); ?>

    <div class="page">
        <h1>STATION DE SIMULATION</h1>

        <div class="arcade-machine" id="container">
            <div id="game-placeholder">
                <h2 style="color:white; margin-bottom:20px;">SYSTÈME DISPONIBLE</h2>
                <button class="btn-play-now" onclick="launchGame()">Charger la simulation</button>
                <p style="color:#666; margin-top:15px;">(Cliquez pour contourner les restrictions de sécurité du navigateur)</p>
            </div>

            <iframe id="game-frame" 
                data-src="https://itch.io/embed-upload/17542393?color=333333" 
                allowfullscreen 
                allow="autoplay; fullscreen; keyboard">
            </iframe>
        </div>

        <script>
            function launchGame() {
                const frame = document.getElementById('game-frame');
                const placeholder = document.getElementById('game-placeholder');
                
                // On injecte la source au moment du clic
                frame.src = frame.getAttribute('data-src');
                
                // On bascule l'affichage
                frame.style.display = 'block';
                placeholder.style.display = 'none';
            }
        </script>

        <div style="text-align: center; margin-top: 30px;">
            <a href="accueil.php" class="bouton">RETOUR ACCUEIL</a>
        </div>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>