<?php 

// Chargement des fichiers de gestion
include("ajouter.php");
include("delete.php");
var_dump("ajouter.php chargé !");

// Initialisation des variables
$message = "";
$fichier = "employee.txt";

// Traitement du formulaire d'ajout d'un employé
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : "";
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : "";
    $mail = isset($_POST['mail']) ? trim($_POST['mail']) : "";
    $num = isset($_POST['num']) ? trim($_POST['num']) : "";

    if (!empty($nom) && !empty($prenom) && !empty($mail) && !empty($num)) {
        getInfos($nom, $prenom, $mail, $num);
        $message = "Les informations ont été enregistrées avec succès.";
    } else {
        $message = "Veuillez remplir tous les champs.";
    }   
}

// Récupération des données du fichier
$lignes = file_exists($fichier) ? file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

// Gestion de la recherche
$search = trim($_GET['search'] ?? '');
$resultats = empty($search) ? $lignes : array_filter($lignes, function ($ligne) use ($search) {
    $donnees = explode("|", $ligne);
    return stripos($donnees[1], $search) !== false || stripos($donnees[3], $search) !== false;
});

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Employés</title>
</head>
<body>
    <form method="post" action="" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required>
        <label for="email">Mail :</label>
        <input type="email" name="mail" id="mail" required>
        <label for="num">Numéro de tel :</label>
        <input type="text" name="num" id="num" required>
        <button type="submit">Envoyer</button>
        <p><?php echo $message; ?></p>
    </form>

    <form method="get" action="">
        <label for="search">Barre de recherche</label>
        <input type="text" name="search" id="search" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Rechercher</button>
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
            <?php foreach ($resultats as $ligne): ?>
                <?php $donnees = explode("|", $ligne); ?>
                <tr>
                    <td><?= htmlspecialchars($donnees[0]) ?></td>
                    <td><?= htmlspecialchars($donnees[1]) ?></td>
                    <td><?= htmlspecialchars($donnees[2]) ?></td>
                    <td><?= htmlspecialchars($donnees[3]) ?></td>
                    <td><?= htmlspecialchars($donnees[4]) ?></td>
                    <td>
                        <a href='modifier.php?id=<?= $donnees[0] ?>'><button>Modifier</button></a>
                        <a href='index.php?delete_id=<?= $donnees[0] ?>'><button>Supprimer</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
