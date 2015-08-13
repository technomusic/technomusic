<div class="col-lg-6">
<div class="panel panel-primary">

<?php
    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $dbh->query('SET NAMES utf8');
        $sql = "SELECT chanson.Chanson_ID AS id, chanson.Titre AS titre, chanson.Duree AS duree, chanson.Annee AS annee, categorie.Nom AS nomcat, artiste.Nom AS nomart, image.url AS image FROM chanson JOIN categorie ON chanson.Categorie_ID=categorie.Categorie_ID JOIN interprete_chanson ON chanson.Chanson_ID=interprete_chanson.Chanson_ID JOIN artiste ON interprete_chanson.Artiste_ID=artiste.Artiste_ID JOIN image ON image.Artiste_ID=artiste.Artiste_ID WHERE chanson.Chanson_ID=:id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue("id", $_REQUEST["id"]);
        $stmt->execute();
        
        $titre;
        $annee;
        $id;
        $duree;
        $nomcat;
        $image;
        $nomart = "";
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $titre = $row["titre"];
            $annee = $row["annee"];
            $id = $row["id"];
            $duree = $row["duree"];
            $nomcat = $row["nomcat"];
            $nomart = $nomart . "<br/>" . $row["nomart"];
            $image = $row["image"];
        }
        unset($dbh);
        echo "<div class=\"panel-heading\"><h3 class=\"panel-title\">" . $titre . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(" . $annee . ")<a href=\"?section=update-movie-form&id=" . $id . "\" class=\"btn btn-warning\">Moddifier</a><a href=\"?section=delete-movie-exec&id=" . $id . "\" class=\"btn btn-danger\">Supprimer</a></h3></div><div class=\"panel-body\"><h3>" . $duree . " secondes&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $nomcat ."</h3><div>" . $nomart . "</div><div><img src=\"data/images/" . $image . "\"></div></div>";
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    } 
?>

</div>
</div>