<?php

 // Ajoute les informations d'un employé dans un fichier texte
 function getInfos($nom, $prenom, $mail, $num) {
    $handle = fopen("employee.txt", "a");
    if ($handle) {
        fwrite($handle, PHP_EOL.$nom."|".$prenom."|".$mail."|".$num);
        fclose($handle);
    }
}