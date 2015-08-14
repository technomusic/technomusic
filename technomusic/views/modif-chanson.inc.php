<div class="col-lg-6">

<?php
 echo "<input type=\"hidden\" name=\"id\" value=\"" . $id = $_REQUEST["id"] . "\"/>";
            
            try
            {
                $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dbh->query('SET NAMES utf8'); 
                $sql = "SELECT chanson.Chanson_ID AS id, chanson.Titre AS nom, chanson.Annee AS annee, chanson.Duree AS duree, categorie.Nom AS categorie, artisteinterprete.Nom AS nominter, artistecompositeur.Nom AS nomcompo, artisteparolier.Nom AS nomparol, image.url AS image FROM chanson LEFT JOIN interprete_chanson ON chanson.Chanson_ID=interprete_chanson.Chanson_ID LEFT JOIN artiste AS artisteinterprete ON interprete_chanson.Artiste_ID=artisteinterprete.Artiste_ID LEFT JOIN categorie ON chanson.Categorie_ID=categorie.Categorie_ID LEFT JOIN compositeur_chanson ON chanson.Chanson_ID=compositeur_chanson.Chanson_ID LEFT JOIN artiste AS artistecompositeur ON compositeur_chanson.Artiste_ID=artistecompositeur.Artiste_ID LEFT JOIN parolier_chanson ON chanson.Chanson_ID=parolier_chanson.Chanson_ID LEFT JOIN artiste AS artisteparolier ON parolier_chanson.Artiste_ID=artisteparolier.Artiste_ID JOIN image ON chanson.Chanson_ID=image.Chanson_ID WHERE chanson.Chanson_ID=:id";
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue("id", $_REQUEST["id"]);
                $stmt->execute();
                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $nom = ($row["nom"]);
                    $duree = $row["duree"];
                    $annee = $row["annee"];
                    $categorie = $row["categorie"];
                    $nominter = $row["nominter"];
                    $nomcompo = $row["nomcompo"];
                    $nomparol = $row["nomparol"];
                    
                
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
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" value="<?php echo $nom;?>">
        </div>
        
        <div class="form-group">
            <label for="duree">Durée</label>
            <input type="text" class="form-control" id="duree" value="<?php echo $duree;?>">
        </div>
        
        <div class="form-group">
            <label for="annee">Année</label>
            <input type="text" class="form-control" id="annee" value="<?php echo $annee;?>">
        </div>
        
        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <input type="text" class="form-control" id="cat" value="<?php echo $categorie;?>">
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
            <label for="nomparol">Parolier</label>
            <input type="text" class="form-control" id="nomparol" value="<?php echo $nomparol;?>">
        </div>
    </form>

    <button type="submit" class="btn btn-default">Modifier</button>
        
</div>
</div>
