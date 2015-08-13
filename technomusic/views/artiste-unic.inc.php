<div class="col-lg-6">
<div class="panel panel-primary">

<?php
    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $dbh->query('SET NAMES utf8');
        $sql = "SELECT artiste.Artiste_ID AS id, artiste.Bio as bio, artiste.Nom AS nom, artiste.Prenom AS prenom, artiste.Surnom AS surnom, artiste.Lieu_Naissance AS lieu, DATE_FORMAT(artiste.Date_Naissance,'%d/%m/%Y') AS dn, image.url AS image FROM artiste LEFT JOIN image ON artiste.Artiste_ID=image.Artiste_ID WHERE artiste.Artiste_ID=:id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue("id", $_REQUEST["id"]);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $id = $row["id"];
            $nom = $row["nom"];
            $prenom = $row["prenom"];
            
            $lieu = $row["lieu"];
            $dn = $row["dn"];
            $bio = $row["bio"];
            $image = $row["image"];
            
            if(isset($row["surnom"])){
                $surnom = "(" . $row["surnom"] . ")";
            }
            else {
                $surnom = "";
            }
            if(isset($row["dn"])){
                $dn = "Né le " . $row["dn"] . " ";
            }
            else {
                $dn = "";
            }
            if(isset($row["lieu"])){
                $lieu = "à " . $row["lieu"] . " ";
            }
            else {
                $lieu = "";
            }
        }   
        
        unset($dbh);
        $image = "data/images/" . $image;
        echo "<div class=\"panel-heading\"><h3 class=\"panel-title\">" . $nom . "&nbsp" . $surnom . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $prenom . "<a href=\"?section=update-movie-form&id=" . $id . "\" class=\"btn btn-warning\">Moddifier</a><a href=\"?section=delete-movie-exec&id=" . $id . "\" class=\"btn btn-danger\">Supprimer</a></h3></div><div>" . $dn . $lieu . "</div><div><img ";?> <?php fctaffichimage($image, 200, 200) ?> <?php echo "/\"></div><div><h5>" . $bio . "</h5></div>";
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    } 
    
    
    
    

?>

</div>
</div>
