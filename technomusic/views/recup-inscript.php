<?php
if (isset($_POST['inscription']) && $_POST['inscription']== 'inscription')
    {
    if ((isset($_POST['login']) && !empty($_POST['login']))&& (isset($_POST['password'])&& !empty($_POST['password']))&& (isset($_POST['password1']) && !empty($_POST['password1'])))
        {
        if($_POST[password] != $_POST['password1'])
            {
            $e = 'les deux mots de passe sont différents ';
        }
        else
        {
    

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    //$dbh = new PDO("sqlite:./data/movies.db");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->query('SET NAMES utf8');
    $sql = "SELECT pseudo FROM utilisateur WHERE pseudo = ($_POST['pseudo'])" ;
        $req = mysql_query($sql) ;
            $data = mysqi_fetch_array($req) ;
                if ($data == 0 )
                {
    $sql = "INSERT INTO utilisateur ( Pseudo , Nom ,prenom , Password )VALUE (:pseudo , :nom , :prenom ,:password )";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue("pseudo", $_REQUEST['pseudo']);
    $stmt->bindValue("nom", $_REQUEST['nom']);
    $stmt->bindValue("prenom", $_REQUEST['prenom']);
    $stmt->bindValue("password", md5($_REQUEST['password']));
    $stmt->execute();
                }

    unset($dbh);
    echo " <div><h2>Voici les données que vous avez rentrée</h2>
            <div>votre nom :" . $_REQUEST['nom'] . "</div>
                <div>Votre prenom :" . $_REQUEST['prenom'] . "</div>
            <div>Votre pseudo :" . $_REQUEST['pseudo'] . "</div>
                <div><a href='index.php' >veuillez confirmer . merci </a></div> ";
} catch (PDOException $e) {
    echo $e->getMessage();
}
    }   
  }
}
?>

