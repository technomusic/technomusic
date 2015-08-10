<?php
try 
    {
    // Connection � la base SQLite - si elle n'existe pas elle est cr��e
    $dbh = new PDO('sqlite:./data/movies.db');
    
    // Fixation du niveau des messages d'erreur
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connexion/cr�ation de la base de donn�es movies.db";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
?>