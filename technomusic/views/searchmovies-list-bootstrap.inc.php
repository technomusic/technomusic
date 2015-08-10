<div class="bs-component">
    <table class="table table-striped table-hover ">
<?php
    try 
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=filhebdo",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        $sql = "SELECT * FROM movies WHERE title LIKE :keyword";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":keyword"=> "%{$_GET["recherche"]}%"));
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                echo "<tr><td><a href=\"?section=affiche-movie-exec&id=" . $row["id"] . "\">" . $row["title"] . "</a></td><td>" . $row["year"] . "</td><td>" . $row["director"] . "</td></tr>";
    //            echo "<a href='fiche.php?id={$row["id"]}'>{$row["title"]}</a>";
    //            echo "-" . $row["director"] . "<br/>"; 				
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