<div class="bs-component">
    <table class="table table-striped table-hover ">

<?php

    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT label.Label_ID AS id, label.Label_Nom AS Nom, JOIN image ON image_label.Label_ID=image.Label_ID";
        $stmt = $dbh->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $row["id"];
        $nom = $row["nom"];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {    
           echo "<tr><td><a href=\"?section=affiche-label-exec&id=" . $id . "\">" . $nom . "</a></td></tr>";
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