<div class="bs-component">
    <table class="table table-striped table-hover ">
        

<?php
echo "<thead><tr><th>Nom</th></tr></thead><tbody>";
    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT categorie.Categorie_ID AS id, categorie.Nom AS nom FROM categorie JOIN image ON categorie.Categorie_ID=image.Categorie_ID";
        $stmt = $dbh->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            
            $id = $row["id"];
            $nom = $row["nom"];
            echo "<tr><td><a href=\"?section=affiche-categorie-unic&id=" . $id . "\">" . $nom . "</a></td></tr>";
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