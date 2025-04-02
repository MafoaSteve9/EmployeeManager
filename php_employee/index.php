<?php 

include("ajouter.php");


if (isset($_GET['delete_id'])) {
    $idToDelete = trim($_GET['delete_id']);

    // Lire le fichier et supprimer la ligne correspondante
    $fichier = file("employee.txt", FILE_IGNORE_NEW_LINES);
    $nouveauFichier = array_filter($fichier, function ($ligne) use ($idToDelete) {
        return explode("|", $ligne)[0] != $idToDelete;
    });

    // Sauvegarde du fichier mis à jour
    file_put_contents("employee.txt", implode(PHP_EOL, $nouveauFichier) . PHP_EOL);

    // Message de confirmation
    echo "<p>Employé supprimé avec succès !</p>";
}


$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : "";
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : "";
    $mail = isset($_POST['mail']) ? trim($_POST['mail']) : "";
    $num = isset($_POST['num']) ? trim($_POST['num']) : "";


    // Vérification des champs obligatoires
    if (!empty($nom) && !empty($prenom) && !empty($mail) && !empty($num)) {
        getInfos($nom, $prenom, $mail, $num);
        $message = "Les informations ont été enregistrées avec succès.";
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action="" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>
        <label for="prenom">Prenom :</label>
        <input type="text" name="prenom" id="prenom" required>
        <label for="email">Mail :</label>
        <input type="email" name="mail" id="mail" required>
        <label for="message">Numéro de tel :</label>
        <input type="text" name="num" id="num" required>
        <button type="submit">envoyer</button>

        <p><?php echo $message; ?></p>
    </form>
    
    <table border="1" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <thead style="background-color: antiquewhite;">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
        // Ouvrir le fichier employes.txt en lecture
        $fichier = 'employee.txt';
        if (file_exists($fichier)) {
            $lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            // Parcourir chaque ligne du fichier
            foreach ($lignes as $ligne) {
                $donnees = explode("|", $ligne); // Séparer les valeurs avec "|"
                // ID, Nom, Prenom, Email, Tel
                echo "<tr>";
                echo "<td>" . htmlspecialchars($donnees[0]) . "</td>";
                echo "<td>" . htmlspecialchars($donnees[1]) . "</td>";
                echo "<td>" . htmlspecialchars($donnees[2]) . "</td>";
                echo "<td>" . htmlspecialchars($donnees[3]) . "</td>";
                echo "<td>" . htmlspecialchars($donnees[4]) . "</td>";
                echo "<td>
                <a href='modifier.php?id={$donnees[0]}'><button>Modifier</button></a>
                <a href='index.php?id={$donnees[0]}'><button>Supprimer</button></a>
                
                </td>";
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>
</body>
</html>





