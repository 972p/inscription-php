<!DOCTYPE html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Connexion </title>
    <style>
        .navbar{
            position : fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: black;
            padding: 10px 20px;
            z-index: 1000;
        }

        body{
            margin-top: 80px;
        }

        .navbar-logo{
            height: 70px;
        }

        .navbar-right a {
            color : white;
            text-decoration: none;
            padding: 15px 20px;
            font-family: Arial, sans-serif;
        }

        .navbar-right a:hover{
            background-color: #555;
            border-radius: 80%;
        }
    </style>
</head>
<body>
<?php
if (session_status()=== PHP_SESSION_NONE){
    session_start();
}
?>

    <div class="navbar">
        <div class ="navbar-left">
            <a href='accueil.php'><img src="images/logo fr.png" alt="logo" class="navbar-logo"> </a>
        </div>  


    <div class="search-bar">
        <form action="search.php" method="get" style="display: flex; align-items: center;">
            <input type="text" name="query" placeholder="Rechercher une vidéo...">
            <buttton type="submit" style="background: none; border: none; padding: 0; margin-left: 5px;">
                <img src="images/recherche.png" alt="recherche" class="search-icon" width="30px">
            </button>
        </form>
    </div>

    <div class="navbar-right">
        <?php if(!isset($_SESSION['loggeed in'])):?>
            <a href='cart.php'><img src="images/traits.png" alt="panier" width = 30px height = 30px></a>
            <a href='compte.php'><img src="images/utilisateur.png" alt="profil" width = 30px height = 30px></a>
            <a href='connexion.php'><img src="images/login.png" alt="login" width = 30px height = 30px></a>
            <a href='inscription.php'><img src="images/inscription.png" alt="inscription" width = 30px height = 30px></a>
            <?php else: ?>
                <a href='accueil.php'>Accueil</a>
                <a href='index.php'>Cours de beatmaking</a>
                <a href='compte.php'>Compte</a>
                <a href='logout.php'>Deconnexion</a>
            <?php endif; ?>
        </div>         
    </div>
</body>
</html>