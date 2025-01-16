<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
  header("Location: connexion.php");
  exit();
}

// Si l'utilisateur clique sur "Se déconnecter"
if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: connexion.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page d'Accueil</title>
  <link rel="icon" type="image/x-icon" href="images/Michael_Myers1.ico">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'navbar.php';?>
  <header>
    <div class="header-container">
      <h2>Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?> ! &nbsp;&nbsp;</h2>
      <form method="POST" style="display: inline;">
        <button type="submit" name="logout" class="logout-btn">Se déconnecter</button>
      </form>
    </div>
  </header>
  <main>
    <p>Ceci est la page d'accueil de votre application.</p>
  </main>
</body>
</html>