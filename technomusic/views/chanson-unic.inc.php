<div class="panel panel-primary">

<?php
    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sql = "SELECT chanson.Chanson_ID AS id, chanson.Titre AS titre, chanson.Duree AS duree, chanson.Annee AS annee, categorie.Nom AS nomcat, artiste.Nom AS nomart, image.url AS image FROM chanson JOIN categorie ON chanson.Categorie_ID=categorie.Categorie_ID JOIN interprete_chanson ON chanson.Chanson_ID=interprete_chanson.Chanson_ID JOIN artiste ON interprete_chanson.Artiste_ID=artiste.Artiste_ID JOIN image ON image.Artiste_ID=artiste.Artiste_ID WHERE chanson.Chanson_ID=:id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue("id", $_REQUEST["id"]);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
             echo "<div class=\"panel-heading\"><h3 class=\"panel-title\">" . $row["titre"] . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(" . $row["annee"] . ")<a href=\"?section=update-movie-form&id=" . $row["id"] . "\" class=\"btn btn-warning\">Moddifier</a><a href=\"?section=delete-movie-exec&id=" . $row["id"] . "\" class=\"btn btn-danger\">Supprimer</a></h3></div><div class=\"panel-body\"><h3>" . $row["duree"] . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $row["nomcat"] ."</h3><div>" . $row["nomart"] . "</div><div><img src=\"data/images/" . $row["image"] . "\"></div></div>";
        }
        unset($dbh);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    } 
?>

</div>