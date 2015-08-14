<div class="col-lg-6">
    <div class="well bs-component">
        <?php
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
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

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = $row["id"];
                $nom = $row["nom"];
                $description = $row["description"];
                $image = $row["image"];
                //$image = 'coucou caca';
            }

            unset($dbh);
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
        
        <form class="form-horizontal" enctype="multipart/form-data" action="?" method="post" name="modif-chanson">
        
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" value="<?php echo $nom; ?>">
        </div>
       
        <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="<?php echo $image; ?>">           
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea rows="3" class="form-control" id="description"><?php echo $description; ?></textarea>
        </div>
            
    </form>

    <button type="submit" class="btn btn-default">Modifier</button>
    </div>
</div>
        
        
        
        
    </div>
</div>