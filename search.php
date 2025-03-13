<?php
include 'bdd.php';


if (isset($_GET['query'])){
    $search = htmlspecialchars($_GET['query']);

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("Erreur de connexion :" . $e->getMessage());
    }

    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE :query");
    $stmt->execute(['query' => '%' . $search . '%']);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} 
?>




<!DOCTYPE html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Résultat de recherce </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<br><br><br>

<h1> Resultat pour "<?= htmlspecialchars($search)?>"</h1>
<div class="product-list">
    <?php if(!empty($results)): ?>
        <?php foreach ($results as $product): ?>
            <div class="product-item">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?php htmlspecialchars($product['name']) ?>">
                <video controls>
                    <source src="<?php htmlspecialchars($product['video']) ?>" type="video/mp4">
                    Votre navigateur ne supporte pas les vidéos.
                </video>
                <h2>
                    <a href="video.php?id=<?= htmlspecialchars($product['id'])?>">
                        <?= htmlspecialchars($product['name']) ?>
                    </a>
                </h2>

                <p>Prix: <?php echo htmlspecialchars($product['price']); ?> €</p>
                <form method="post" action="add_to_cart.php">   
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                    <button type="submit" name="add_to_cart">Ajouter au Panier</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p> Aucun résultat trouvé </p>
        <?php endif; ?>
    </div>

<?php include 'footer.php'; ?>
</body>
</html>