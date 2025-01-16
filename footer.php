<!DOCTYPE html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .footer{
            position : fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            background-color: black;
            padding: 10px;
            z-index: 1000;
            color: white;
            font-family: Arial, sans-serif;
        }



        .footer a {
            color : white;
            text-decoration: none;
            padding: 0px 10px;
        }

        .footer a:hover{
            text-decoration: underline;
        }
        
        
    </style>

</head>
<body>
<div class="footer">
        <php>&copy; <?php echo date('Y'); ?> Favelas.  Tous réservés.</php>
        <p>
            <a href="privacy.php"> Politique de confidentalité</a>
            <a href="terms.php"> Conditions d'uilisation</a>
        </p>
    </div>
</body>
</html>