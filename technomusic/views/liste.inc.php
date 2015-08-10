<div class="bs-component">
    <table class="table table-striped table-hover ">

<?php

    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT Chanson_ID, Titre, Duree, Annee, Description, Categorie_ID FROM chanson";
        $stmt = $dbh->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $cat = "";
            $dbh2 = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
            //$dbh = new PDO("sqlite:./data/movies.db");
            $dbh2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql2 = "SELECT Nom FROM categorie WHERE Categorie_ID = :id";
            $stmt2 = $dbh2->prepare($sql2);
            $stmt2->bindValue("id", $row["Categorie_ID"]);
            $stmt2->execute();
            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
            {
                $cat = $row2["Nom"];
            }
            unset($dbh2);
            echo "<tr><td><a href=\"?section=affiche-chanson-exec&id=" . $row["Chanson_ID"] . "\">" . $row["Titre"] . "</a></td><td>" . $cat ."</td></tr>";
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