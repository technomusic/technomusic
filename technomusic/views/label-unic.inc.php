<div class="col-lg-6">
<div class="panel panel-primary">

<?php
    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $dbh->query('SET NAMES utf8');
        $sql = "SELECT label.Label_ID AS id, label.Description as description, label.Nom AS nom,image.url AS image FROM label JOIN image ON label.Label_ID=image.Label_ID WHERE label.Label_ID=:id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue("id", $_REQUEST["id"]);
        $stmt->execute();
        
        $id;
        $nom;
        $description;
        $image;
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $id = $row["id"];
            $nom = $row["nom"];
            $description = $row["description"];
            $image = $row["image"];
            //$image = 'coucou caca';
        }   
        
        unset($dbh);
        $image = "data/images/" . $image;
        echo "<div class=\"panel-heading\"><h3 class=\"panel-title\">" . $nom . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href=\"?section=update-movie-form&id=" . $id . "\" class=\"btn btn-warning\">Moddifier</a><a href=\"?section=delete-movie-exec&id=" . $id . "\" class=\"btn btn-danger\">Supprimer</a></h3></div><div><img ";?> <?php fctaffichimage($image, 200, 200) ?> <?php echo "/\"></div><div><h5>" . $description . "</h5></div>";
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    } 
    
    
    
    

?>

</div>
</div>
