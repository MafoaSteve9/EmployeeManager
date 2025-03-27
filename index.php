<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <h2>Gestion des Employés</h2>

        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom">

        <label for="prenom">Prenom :</label>
        <input type="text" name="prenom" id="prenom">

        <label for="email">Email :</label>
        <input type="email" name="email" id="email">

        <label for="tel">Numéro de téléphone</label>
        <input type="text" name="tel" id="tel">

        <div class="btn"><button type="submit">Envoyez</button></div>
    </form>
</body>
</html>