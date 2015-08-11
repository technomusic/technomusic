<div class="bs-component">
    <table class="table table-striped table-hover ">

<?php

    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT chanson.Chanson_ID AS id, chanson.Titre AS titre, chanson.Duree AS duree, chanson.Annee AS annee, chanson.Description AS desccription, categorie.Nom AS nomcat, artiste.Nom AS nomart FROM chanson JOIN categorie ON chanson.Categorie_ID=categorie.Categorie_ID JOIN interprete_chanson ON chanson.Chanson_ID=interprete_chanson.Chanson_ID JOIN artiste ON interprete_chanson.Artiste_ID=artiste.Artiste_ID";
        $stmt = $dbh->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $row["id"];
        $titre = $row["titre"];
        $cat = $row["nomcat"];
        $interprete = $row["nomart"];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {    
            if($id == $row["id"]){
                $interprete = $interprete . "<br/>" . $row["nomart"];
            }
            else{
                echo "<tr><td><a href=\"?section=affiche-chanson-exec&id=" . $id . "\">" . $titre . "</a></td><td>" . $cat ."</td><td>" . $interprete . "</td></tr>";
                $id = $row["id"];
                $titre = $row["titre"];
                $cat = $row["nomcat"];
                $interprete = $row["nomart"];
            }   
        }
        echo "<tr><td><a href=\"?section=affiche-chanson-exec&id=" . $id . "\">" . $titre . "</a></td><td>" . $cat ."</td><td>" . $interprete . "</td></tr>";
        unset($dbh);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    } 

?>

    </table>
</div>