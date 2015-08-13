<div class="col-lg-6">
<div class="panel panel-primary">

<?php
    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sql = "SELECT album.Album_ID AS id, album.Titre AS titre, album.Annee AS annee, chanson.Titre AS nomchanson, label.Nom as label, artisteinterprete.Nom AS nominter, artistecompositeur.Nom AS nomcompo, artisteconducteur.Nom AS nomconduct, image.url AS image FROM album JOIN interprete_album ON album.Album_ID=interprete_album.Album_ID JOIN artiste AS artisteinterprete ON interprete_album.Artiste_ID=artisteinterprete.Artiste_ID JOIN label ON album.Label_ID=label.Label_ID JOIN compositeur_album ON album.Album_ID=compositeur_album.Album_ID JOIN artiste AS artistecompositeur ON compositeur_album.Artiste_ID=artistecompositeur.Artiste_ID JOIN conducteur_album ON album.Album_ID=conducteur_album.Album_ID JOIN artiste AS artisteconducteur ON conducteur_album.Artiste_ID=artisteconducteur.Artiste_ID JOIN chanson_album ON album.Album_ID=chanson_album.Album_ID JOIN chanson ON chanson_album.Chanson_ID=chanson.Chanson_ID JOIN image ON album.Album_ID=image.Album_ID WHERE album.Album_ID=:id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue("id", $_REQUEST["id"]);
        $stmt->execute();
        
        $id;
        $titre;
        $annee;
        $label;
        $image;
        $nomchanson;
        $nominter;
        $nomcompo;
        $nomconduct;
        $artisteinterprete;
        $artistecompositeur;
        $artisteconducteur;
        
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
        $id = $row["id"];
        $titre = $row["titre"];
        $annee = $row["annee"];
        $label = $row["label"];
        $image = $row["image"];
        $nomchanson = $row["nomchanson"];
        $nominter = $row["nominter"];
        $nomcompo = $row["nomcompo"];
        $nomconduct = $row["nomconduct"];
        $artisteinterprete = $row["nominter"];
        $artistecompositeur = $row["nomcompo"];
        $artisteconducteur = $row["nomconduct"];
        }   
        
        unset($dbh);
        echo "<div class=\"panel-heading\"><h3 class=\"panel-title\">" . $titre . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(" . $annee . ")<a href=\"?section=update-movie-form&id=" . $id . "\" class=\"btn btn-warning\">Moddifier</a><a href=\"?section=delete-movie-exec&id=" . $id . "\" class=\"btn btn-danger\">Supprimer</a></h3></div><div><h4>Interprète : </h4><h5>" . $nominter . "</h5> </div> <div><h4>Compositeur : </h4><h5>" . $nomcompo . "</h5></div><div><h4>Conducteur : </h4><h5>" . $nomconduct . "</h5></div><div><img src=\"data/images/" . $image . "\"></div><div><h4>Titres : </h4><h5>" . $nomchanson . "</h5></div>";
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    } 

?>

</div>
</div>
