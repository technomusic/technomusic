<div class="col-lg-6">

<?php
 echo "<input type=\"hidden\" name=\"id\" value=\"" . $id = $_REQUEST["id"] . "\"/>";
            
            try
            {
                $dbh = new PDO("mysql:host=$hostname;dbname=filhebdo",   $username, $password);
                //$dbh = new PDO("sqlite:./data/movies.db");
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                $sql = "SELECT * FROM chanson WHERE id=:id";
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue("id", $_REQUEST["id"]);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $nom = $row["nom"];
                    $duree = $row["duree"];
                    $annee = $row["annee"];
                    $categorie = $row["categorie"];
                    $nominter = $row["nominter"];
                    $nomcompo = $row["nomcompo"];
                    $nomparol = $row["nomparol"];
                }
                unset($dbh);
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            } 
                    
        ?>
    <form class="form-horizontal" enctype="multipart/form-data" action="?" method="post" name="modif-chanson">
        <div class="form-group">
            <label for="exampleInputEmail1">Nom</label>
            <input type="text" class="form-control" id="nom" placeholder="<?php echo $nom;?>">
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Durée</label>
            <input type="text" class="form-control" id="duree" placeholder="">
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Année</label>
            <input type="text" class="form-control" id="annee" placeholder="">
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Catégorie</label>
            <input type="text" class="form-control" id="cat" placeholder="">
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Interpète</label>
            <input type="text" class="form-control" id="nominter" placeholder="">
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Compositeur</label>
            <input type="text" class="form-control" id="nomcompo" placeholder="">
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Parolier</label>
            <input type="text" class="form-control" id="nomparol" placeholder="">
        </div>
    </form>

    <button type="submit" class="btn btn-default">Modifier</button>
        
</div>
</div>
