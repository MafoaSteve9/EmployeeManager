<?php
$message = "";

// Vérifier si l'ID est passé en GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $employe = null;

    // Lire le fichier
    $fichier = file("employee.txt", FILE_IGNORE_NEW_LINES);
    foreach ($fichier as $ligne) {
        $donnees = explode("|", $ligne);
        if ($donnees[0] == $id) {
            $employe = $donnees;
            break;
        }
    }

    // Vérifier si l'utilisateur a été trouvé
    if (!$employe) {
        die("Utilisateur non trouvé !");
    }
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $mail = $_POST['mail'] ?? '';
    $num = $_POST['num'] ?? '';

    // Vérification des valeurs
    if (empty($nom) || empty($prenom) || empty($mail) || empty($num)) {
        $message = "Tous les champs sont obligatoires.";
    } else {
        // Lire le fichier et mettre à jour l'utilisateur
        $fichier = file("employee.txt", FILE_IGNORE_NEW_LINES);
        $nouveauFichier = [];

        foreach ($fichier as $ligne) {
            $donnees = explode("|", $ligne);
            if ($donnees[0] == $id) {
                $nouveauFichier[] = "$id|$nom|$prenom|$mail|$num";
            } else {
                $nouveauFichier[] = $ligne;
            }
        }

        // Sauvegarder le fichier mis à jour
        file_put_contents("employee.txt", implode(PHP_EOL, $nouveauFichier) . PHP_EOL);

        $message = "Modification réussie !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
</head>
<body>

<h2>Modifier un utilisateur</h2>

<form method="post" action="modifier.php">
    <input type="hidden" name="id" value="<?php echo isset($employe[0]) ? htmlspecialchars($employe[0]) : ''; ?>">
    
    <label>Nom :</label>
    <input type="text" name="nom" value="<?php echo isset($employe[1]) ? htmlspecialchars($employe[1]) : ''; ?>" required>
    
    <label>Prénom :</label>
    <input type="text" name="prenom" value="<?php echo isset($employe[2]) ? htmlspecialchars($employe[2]) : ''; ?>" required>
    
    <label>Email :</label>
    <input type="email" name="mail" value="<?php echo isset($employe[3]) ? htmlspecialchars($employe[3]) : ''; ?>" required>
    
    <label>Numéro :</label>
    <input type="text" name="num" value="<?php echo isset($employe[4]) ? htmlspecialchars($employe[4]) : ''; ?>" required>
    
    <button type="submit">Modifier</button>
</form>

<p><?php echo $message; ?></p>

<a href="index.">Retour</a>

</body>
</html>
