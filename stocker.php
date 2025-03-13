<?php 

include 'bdd.php';
session_start()
?>
<?php
try{
    $pdo = new PDO ("mysql:host=$servername;dbname=$dbname;charset=utf8", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id, name, image, video, price FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e){
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}
?>