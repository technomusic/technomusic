<div class="bs-component">
    <table class="table table-striped table-hover ">

<?php

    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT chanson.Chanson_ID, chanson.Titre, chanson.Duree, chanson.Annee, chanson.Description, categorie.Nom, interprete_chanson.Chanson_ID, artiste.Nom FROM chanson JOIN categorie ON chanson.Categorie_ID=categorie.Categorie_ID JOIN interprete_chanson ON chanson.Chanson_ID=interprete_chanson.Chanson_ID JOIN artiste ON interprete_chanson.Atriste_ID=artiste.Atriste_ID";
        $stmt = $dbh->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {            
            echo "<tr><td><a href=\"?section=affiche-chanson-exec&id=" . $row["Chanson_ID"] . "\">" . $row["Titre"] . "</a></td><td>" . $cat ."</td><td>" . $interprete . "</td></tr>";
        }
        unset($dbh);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    } 

?>

    </table>
</div>