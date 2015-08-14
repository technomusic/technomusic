<div class="col-lg-6">
    <div class="well bs-component">
    <?php
    echo "<input type=\"hidden\" name=\"id\" value=\"" . $id = $_REQUEST["id"] . "\"/>";

    try {
            $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            //$dbh = new PDO("sqlite:./data/movies.db");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->query('SET NAMES utf8');
            $sql = "SELECT artiste.Artiste_ID AS id, artiste.Bio as bio, artiste.Nom AS nom, artiste.Prenom AS prenom, artiste.Surnom AS surnom, artiste.Lieu_Naissance AS lieu, DATE_FORMAT(artiste.Date_Naissance,'%d/%m/%Y') AS dn, image.url AS image FROM artiste LEFT JOIN image ON artiste.Artiste_ID=image.Artiste_ID WHERE artiste.Artiste_ID=:id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue("id", $_REQUEST["id"]);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = $row["id"];
                $nom = $row["nom"];
                $prenom = $row["prenom"];

                $lieu = $row["lieu"];
                $dn = $row["dn"];
                $bio = $row["bio"];
                $image = $row["image"];

                if (isset($row["surnom"])) {
                    $surnom = "(" . $row["surnom"] . ")";
                } else {
                    $surnom = "";
                }
                if (isset($row["dn"])) {
                    $dn = "Né le " . $row["dn"] . " ";
                } else {
                    $dn = "";
                }
                if (isset($row["lieu"])) {
                    $lieu = "à " . $row["lieu"] . " ";
                } else {
                    $lieu = "";
                }
            }

            unset($dbh);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
        
        
        
        
    <form class="form-horizontal" enctype="multipart/form-data" action="?" method="post" name="modif-chanson">
        <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="<?php echo $image; ?>">           
        </div>
        
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" value="<?php echo $nom; ?>">
        </div>

        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" value="<?php echo $prenom; ?>">
        </div>

        <div class="form-group">
            <label for="surnom">Nom d'artiste</label>
            <input type="text" class="form-control" id="surnom" value="<?php echo $surnom; ?>">
        </div>

        <div class="form-group">
            <label for="dn">Date de naissance</label>
            <input type="text" class="form-control" id="date" value="<?php echo $dn; ?>">
        </div>

        <div class="form-group">
            <label for="bio">Biographie</label>
            <textarea rows="3" class="form-control" id="bio"><?php echo $bio; ?></textarea>
        </div>

        
    </form>

    <button type="submit" class="btn btn-default">Modifier</button>
    </div>
</div>