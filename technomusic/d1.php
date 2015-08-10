<?php
try 
    {
    // Connection à la base SQLite - si elle n'existe pas elle est créée
    $dbh = new PDO('sqlite:./data/movies.db');
    
    // Fixation du niveau des messages d'erreur
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connexion/création de la base de données movies.db";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
?>