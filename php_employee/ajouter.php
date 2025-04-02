<?php

 // Ajoute les informations d'un employé dans un fichier texte
 function getInfos($nom, $prenom, $mail, $num) {
    $fichier = "employee.txt";
    $handle = fopen($fichier, "a");
    $lignes = file_exists($fichier) ? file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
    $id = count($lignes) + 1;

    if ($handle) {
        fwrite($handle, PHP_EOL.$id."|".$nom."|".$prenom."|".$mail."|".$num);
        fclose($handle);
    }
}