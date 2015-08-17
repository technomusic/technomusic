<div class="bs-component">
    <div class="well bs-component">


        <?php
       
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            //$dbh = new PDO("sqlite:./data/movies.db");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->query('SET NAMES utf8');
            $sql = "SELECT image.url AS image, categorie.Categorie_ID AS id, categorie.Nom AS nom FROM categorie JOIN image ON categorie.Categorie_ID=image.Categorie_ID";
            $stmt = $dbh->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $id = $row["id"];
                $nom = $row["nom"];
                $image = $row["image"];
                $image = "data/images/" . $image;
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
                   
    </form>
    </div>
</div>
