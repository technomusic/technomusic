<div class="panel panel-primary">

<?php

    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=filhebdo",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sql = "SELECT * FROM movies WHERE id=:id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue("id", $_REQUEST["id"]);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
             echo "<div class=\"panel-heading\"><h3 class=\"panel-title\"><a href=\"" . $row["url"] . "\"  target=\"_blank\">" . $row["title"] . "</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(" . $row["year"] . ")<a href=\"?section=update-movie-form&id=" . $row["id"] . "\" class=\"btn btn-warning\">Moddifier</a><a href=\"?section=delete-movie-exec&id=" . $row["id"] . "\" class=\"btn btn-danger\">Supprimer</a></h3></div><div class=\"panel-body\"><h3>" . $row["director"] . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $row["rating"] ."</h3><div>" . $row["description"] . "</div><div><img src=\"data/images/" . $row["image"] . "\"></div></div>";
        }
        unset($dbh);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    } 

?>

</div>