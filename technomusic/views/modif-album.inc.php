<div class="col-lg-6">
    <div class="panel panel-primary">

        <?php
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            //$dbh = new PDO("sqlite:./data/movies.db");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->query('SET NAMES utf8');
            $sql = "SELECT album.Album_ID AS id, album.Titre AS titre, album.Annee AS annee, chanson.Titre AS nomchanson, label.Nom as label, artisteinterprete.Nom AS nominter, artistecompositeur.Nom AS nomcompo, artisteconducteur.Nom AS nomconduct, image.url AS image FROM album JOIN interprete_album ON album.Album_ID=interprete_album.Album_ID JOIN artiste AS artisteinterprete ON interprete_album.Artiste_ID=artisteinterprete.Artiste_ID JOIN label ON album.Label_ID=label.Label_ID JOIN compositeur_album ON album.Album_ID=compositeur_album.Album_ID JOIN artiste AS artistecompositeur ON compositeur_album.Artiste_ID=artistecompositeur.Artiste_ID JOIN conducteur_album ON album.Album_ID=conducteur_album.Album_ID JOIN artiste AS artisteconducteur ON conducteur_album.Artiste_ID=artisteconducteur.Artiste_ID JOIN chanson_album ON album.Album_ID=chanson_album.Album_ID JOIN chanson ON chanson_album.Chanson_ID=chanson.Chanson_ID JOIN image ON album.Album_ID=image.Album_ID WHERE album.Album_ID=:id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue("id", $_REQUEST["id"]);
            $stmt->execute();
            
         while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $row["id"];
            $titre = $row["titre"];
            $annee = $row["annee"];
            $label = $row["label"];
            $image = $row["image"];
            $nomchanson = $row["nomchanson"];
            $nominter = $row["nominter"];
            $nomcompo = $row["nomcompo"];
            $nomconduct = $row["nomconduct"];
            $txtinterprete = "";
            $txtcompositeur = "";
            $txtconducteur = "";
            $txtchanson = "";
            unset($dbh);
                }
            }
        
            catch(PDOException $e)
            {
                echo $e->getMessage();
            } 
        ?>

<form class="form-horizontal" enctype="multipart/form-data" action="?" method="post" name="modif-chanson">
        <div class="form-group">
            <label for="titre">Nom</label>
            <input type="text" class="form-control" id="nom" value="<?php echo $titre;?>">
        </div>
        
        <div class="form-group">
            <label for="annee">Année</label>
            <input type="text" class="form-control" id="duree" value="<?php echo $annee;?>">
        </div>
            
        <div class="form-group">
            <label for="nominter">Interpète</label>
            <input type="text" class="form-control" id="nominter" value="<?php echo $nominter;?>">
        </div>
        
        <div class="form-group">
            <label for="nomcompo">Compositeur</label>
            <input type="text" class="form-control" id="nomcompo" value="<?php echo $nomcompo;?>">
        </div>
        
        <div class="form-group">
            <label for="nomconduct">Conducteur</label>
            <input type="text" class="form-control" id="nomparol" value="<?php echo $nomconduct;?>">
        </div>
    
        <div class="form-group">
            <label for="chansons">Chansons</label>
            <input type="text" class="form-control" id="annee" value="<?php echo $nomchanson;?>">
        </div>
        
        <div class="form-group">
            <label for="label">Label</label>
            <input type="text" class="form-control" id="cat" value="<?php echo $label;?>">
        </div>
    
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="<?php echo $image;?>">           
        </div>
    </form>

    <button type="submit" class="btn btn-default">Modifier</button>
        
</div>
</div>