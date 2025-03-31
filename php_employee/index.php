<?php 

include("ajouter.php");

$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
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
<form method="post" action="">
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
</body>
</html>





