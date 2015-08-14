<div class="col-lg-6">

    <?php
    echo "<input type=\"hidden\" name=\"id\" value=\"" . $id = $_REQUEST["id"] . "\"/>";

    try {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->query('SET NAMES utf8');
        $sql = "SELECT chanson.Chanson_ID AS id, chanson.Titre AS titre, chanson.Annee AS annee, chanson.Duree AS duree, categorie.Nom AS nomcat, artisteinterprete.Nom AS nominter, artistecompositeur.Nom AS nomcompo, artisteparolier.Nom AS nomparo, image.url AS image FROM chanson LEFT JOIN interprete_chanson ON chanson.Chanson_ID=interprete_chanson.Chanson_ID LEFT JOIN artiste AS artisteinterprete ON interprete_chanson.Artiste_ID=artisteinterprete.Artiste_ID LEFT JOIN categorie ON chanson.Categorie_ID=categorie.Categorie_ID LEFT JOIN compositeur_chanson ON chanson.Chanson_ID=compositeur_chanson.Chanson_ID LEFT JOIN artiste AS artistecompositeur ON compositeur_chanson.Artiste_ID=artistecompositeur.Artiste_ID LEFT JOIN parolier_chanson ON chanson.Chanson_ID=parolier_chanson.Chanson_ID LEFT JOIN artiste AS artisteparolier ON parolier_chanson.Artiste_ID=artisteparolier.Artiste_ID JOIN image ON chanson.Chanson_ID=image.Chanson_ID WHERE chanson.Chanson_ID=:id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue("id", $_REQUEST["id"]);
        $stmt->execute();

        $interprete = array();
        $compositeur = array();
        $parolier = array();

        $txtinterprete = "";
        $txtcompositeur = "";
        $txtparolier = "";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $interprete[] = $row["nominter"];
            $compositeur[] = $row["nomcompo"];
            $parolier[] = $row["nomparo"];
            $id = $row["id"];
            $titre = $row["titre"];
            $nomcat = $row["nomcat"];
            $image = $row["image"];
            $annee = $row["annee"];
            $duree = $row["duree"];
        }
        unset($dbh);

        //... on élimine les doublons interprete...
        $result = array_unique($interprete);
        //... on change de tableau pour réinitialiser les clefs...
        $tab = array();
        foreach ($result as $value) {
            $tab[] = $value;
        }
        //... on calcul la taille...
        $size = sizeof($tab);
        //... on ecrit le premier...
        //$txtinterprete = $tab[0];
        //...ensuite on écrit tout les autres...
        for ($i = 0; $i < $size; $i++) {
            $txtinterprete = $txtinterprete . "<input type=\"text\" class=\"form-control\" id=\"nominter\" value=\"" . $tab[$i] . "\">";
        }
        //...pour enfin netoyer le tableau pour les autre albums...
        $interprete = array();

        //idem interprete
        $result = array_unique($compositeur);
        $tab = array();
        foreach ($result as $value) {
            $tab[] = $value;
        }
        $size = sizeof($tab);
        //$txtcompositeur = $tab[0];
        for ($i = 0; $i < $size; $i++) {
            $txtcompositeur = $txtcompositeur . "<input type=\"text\" class=\"form-control\" id=\"nomcompo\" value=\"" . $tab[$i] . "\">";
        }
        $compositeur = array();

        //idem interprete
        $result = array_unique($parolier);
        $tab = array();
        foreach ($result as $value) {
            $tab[] = $value;
        }
        $size = sizeof($tab);
        //$txtparolier = $tab[0];
        for ($i = 0; $i < $size; $i++) {
            $txtparolier = $txtparolier . "<input type=\"text\" class=\"form-control\" id=\"nomparol\" value=\"" . $tab[$i] . "\">";
        }
        $parolier = array();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>
    <form class="form-horizontal" enctype="multipart/form-data" action="?" method="post" name="modif-chanson">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" value="<?php echo $titre; ?>">
        </div>

        <div class="form-group">
            <label for="duree">Durée</label>
            <input type="text" class="form-control" id="duree" value="<?php echo $duree; ?>">
        </div>

        <div class="form-group">
            <label for="annee">Année</label>
            <input type="text" class="form-control" id="annee" value="<?php echo $annee; ?>">
        </div>

        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <input type="text" class="form-control" id="cat" value="<?php echo $nomcat; ?>">
        </div>

        <div class="form-group">
            <label for="nominter">Interpète</label>
            <?php echo $txtinterprete; ?>
        </div>

        <div class="form-group">
            <label for="nomcompo">Compositeur</label>
            <?php echo $txtcompositeur; ?>
        </div>

        <div class="form-group">
            <label for="nomparol">Parolier</label>
            <?php echo $txtparolier; ?>
        </div>
    </form>

    <button type="submit" class="btn btn-default">Modifier</button>

</div>
</div>
