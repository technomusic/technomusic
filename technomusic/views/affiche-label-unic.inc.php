<div class="bs-component">
    <table class="table table-striped table-hover ">
        

<?php

    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT label.Label_ID AS id, label.Description as description, label.Nom AS nom FROM label JOIN image ON label.Label_ID=image.Label_ID WHERE label.Label_ID=:id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue("id", $_REQUEST["id"]);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            
            $id = $row["id"];
            $nom = $row["nom"];
            $description = $row["description"];
            //$image = $row["image"];
            $image = 'coucou caca';
            
        }
        unset($dbh);
        echo "<tr><td>" . $id . "</td></tr><tr><td>" . $image . "</td></tr><tr><td>" . $nom . "</td></tr><tr><td>" . $description . "</td></tr>";
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    } 

?>

    </table>
</div>
