<?php
if (isset($_GET['delete_id'])) {
    $idToDelete = trim($_GET['delete_id']);
    var_dump($idToDelete);

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
