<?php

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    //$dbh = new PDO("sqlite:./data/movies.db");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->query('SET NAMES utf8');
    $sql = "INSERT INTO utilisateur ( Pseudo , Nom ,prenom , Password )VALUE (:pseudo , :nom , :prenom ,:password )";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue("pseudo", $_REQUEST['pseudo']);
    $stmt->bindValue("nom", $_REQUEST['nom']);
    $stmt->bindValue("prenom", $_REQUEST['prenom']);
    $stmt->bindValue("password", md5($_REQUEST['password']));
    $stmt->execute();

    unset($dbh);
    echo " <div><h2>Voici les données que vous avez rentrée</h2>
            <div>votre nom :" . $_REQUEST['nom'] . "</div>
                <div>Votre prenom :" . $_REQUEST['prenom'] . "</div>
            <div>Votre pseudo :" . $_REQUEST['pseudo'] . "</div>
                <div><a href='index.php' >veuillez confirmer . merci </a></div> ";
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

