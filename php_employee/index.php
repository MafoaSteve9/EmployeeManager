<?php

 function getInfos($nom, $prenom, $mail, $num) {
    $handle = fopen("employee.txt", "a");
    if ($handle) {
        fwrite($handle, PHP_EOL.$nom."|".$prenom."|".$mail."|".$num);
        fclose($handle);
    }
}


echo getInfos("Meek", "Mill", "test@test.fr", "0606060606");