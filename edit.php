<?php
session_start();

include 'bdd.php';

if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $table = null; // Initialisation de la variable
    $row = null; // Initialisation de la variable

    if (isset($_GET['table']) && isset($_GET['id'])) {
        $table = $_GET['table'];
        $id = $_GET['id'];

        $stmt = $conn->prepare("SELECT * FROM $table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute(); // Correction de l'erreur de syntaxe ici
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            echo "Aucun enregistrement trouvé avec cet ID.";
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $columns = $_POST['columns']; // Correction ici

            $setClause = [];
            foreach ($columns as $column => $value) { // Correction ici
                if ($column !== 'password') {
                    $setClause[] = "$column = :$column";
                }
            }
            $setClause = implode(',', $setClause);

            $stmt = $conn->prepare("UPDATE $table SET $setClause WHERE id = :id");
            foreach ($columns as $column => $value) {
                if ($column !== 'password') {
                    $stmt->bindParam(":$column", $value);
                }
            }
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            header("Location: admin_dashboard.php");
            exit();
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'enregistrement dans la table</title>
</head>
<body>
    <h2>Modifier l'enregistrement dans la table "<?php echo htmlspecialchars($table ?? ''); ?>"</h2> <!-- Utilisation de l'opérateur null coalescent -->

    <form action="" method="POST"> <!-- Correction ici -->
        <?php if ($row): // Vérification si $row est défini ?>
            <?php foreach ($row as $column => $value): ?>
                <?php if ($column !== 'password'): ?>
                    <label for="<?php echo htmlspecialchars($column); ?>"><?php echo htmlspecialchars($column); ?>:</label>
                    <input type="text" name="columns[<?php echo htmlspecialchars($column); ?>]" value="<?php echo htmlspecialchars($value); ?>" id="<?php echo htmlspecialchars($column); ?>">
                    <br>
                <?php endif; ?>
            <?php endforeach; ?>
            <input type="submit" value="Enregistrer les modifications">
        <?php else: ?>
            <p>Aucun enregistrement à modifier.</p>
        <?php endif; ?>
    </form>
</body>
</html>