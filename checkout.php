<?php

session_start();

$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

if(empty($cart_items)){
    header('Location: cart.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Finalisation de l'Achat </title>
    <link rel="stylsheet" href="style.css">
</head>
<body>

<h1>Finalisation de l'Achat</h1>

<?php if (!empty($cart_items)): ?>
    <p>Vous avez <?php echo count($cart_items); ?> article dans votre panier.</p>

    <form method="post" action="process_order.php">
        <label for="adress">Adresse de Livraison : </label><br>
        <input type="text" id="address" name="addressé"required>

        <label for="payment">Méthode de paiement : </label><br>
        <select id="payment" name="payment_method">
            <option value="credit_card"> Carte de Crédit</option>
            <option value="paypal"> PayPal</option>
        </select><br>

        <button type="submit">Finaliser l'Achat</button> 
    </form>
<?php else: ?>
    <p> Votre panier est vide. </p>
<?php endif; ?>

</body>
</html>