<?php
    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->query('SET NAMES utf8');
        $sql = "INSERT INTO utilisateur ( Pseudo , Nom ,prenom , Password )VALUE (:pseudo , :nom , :prenom ,:password )" ;
        $stmt = $dbh->prepare($sql);
            $stmt->bindValue("pseudo", $_REQUEST['pseudo']);
            $stmt->bindValue("nom", $_REQUEST['nom']);
            $stmt->bindValue("prenom", $_REQUEST['prenom']);
            $stmt->bindValue("password", md5($_REQUEST['password']));
            $stmt->execute();
            
            unset($dbh); 
            
    }
       
    catch(PDOException $e)
    {
        echo $e->getMessage();
    } 




?>

