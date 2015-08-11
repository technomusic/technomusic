<?php				
    


    $data = $_POST["annee"] ."|". $_POST["fabricant"] ."|". $_POST["modele"] ."|" . $_POST["description"] ."|" . $_POST["prix"] . "\n";
    $file = 'data/cars.csv';
    $fp = fopen($file, "a");
    if(fwrite($fp, $data))
    {
            echo "Ecriture du fichier OK";
    }
    else
    {
            echo "Impossible d'écrire!";
    }
?>