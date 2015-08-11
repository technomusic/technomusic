<div class="bs-component">
    <table class="table table-striped table-hover ">
        

<?php

    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT label.Label_ID AS id, label.Nom AS nom FROM label JOIN image ON label.Label_ID=image.Label_ID";
        $stmt = $dbh->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            
            $id = $row["id"];
            $nom = $row["nom"];
            echo "<tr><td><a href=\"?section=affiche-label-unic&id=" . $id . "\">" . $nom . "</a></td></tr>";
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