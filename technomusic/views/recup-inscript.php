<?php

if ((isset($_POST['pseudo']) && !empty($_POST['pseudo'])) && (isset($_POST['password']) && !empty($_POST['password'])) && (isset($_POST['password1']) && !empty($_POST['password1']))) {
    if ($_POST['password'] != $_POST['password1']) {
        echo 'les deux mots de passe sont différents ';
    } else {
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            //$dbh = new PDO("sqlite:./data/movies.db");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->query('SET NAMES utf8');
            $sql = "SELECT count(*) FROM utilisateur WHERE utilisateur.Pseudo = :pseudo";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(":pseudo" => "{$_REQUEST["pseudo"]}"));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $exist = $row['count(*)'];
            if ($exist == 0) {
                $sql = "INSERT INTO utilisateur ( Pseudo , Nom ,prenom , Password )VALUE (:pseudo , :nom , :prenom ,:password )";
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue("pseudo", $_REQUEST['pseudo']);
                $stmt->bindValue("nom", $_REQUEST['nom']);
                $stmt->bindValue("prenom", $_REQUEST['prenom']);
                $stmt->bindValue("password", md5($_REQUEST['password']));
                $stmt->execute();

                echo " <div><h2>Voici les données que vous avez rentrée</h2>
            <div>votre nom :" . $_REQUEST['nom'] . "</div>
                <div>Votre prenom :" . $_REQUEST['prenom'] . "</div>
            <div>Votre pseudo :" . $_REQUEST['pseudo'] . "</div>
                <div><a href='index.php' >Retour à l'accueil</a></div> ";
            } else {
                echo "<div class='erreur'>Ce pseudo est déjà utilisé</div>";
            }

            unset($dbh);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>

