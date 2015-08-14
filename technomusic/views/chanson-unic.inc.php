<div class="col-lg-6">
    <div class="panel panel-primary">

        <?php
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            //$dbh = new PDO("sqlite:./data/movies.db");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->query('SET NAMES utf8');
            $sql = "SELECT chanson.Chanson_ID AS id, chanson.Titre AS titre, chanson.Annee AS annee, chanson.Duree AS duree, categorie.Nom AS nomcat, artisteinterprete.Nom AS nominter, artistecompositeur.Nom AS nomcompo, artisteparolier.Nom AS nomparo, image.url AS image FROM chanson LEFT JOIN interprete_chanson ON chanson.Chanson_ID=interprete_chanson.Chanson_ID LEFT JOIN artiste AS artisteinterprete ON interprete_chanson.Artiste_ID=artisteinterprete.Artiste_ID LEFT JOIN categorie ON chanson.Categorie_ID=categorie.Categorie_ID LEFT JOIN compositeur_chanson ON chanson.Chanson_ID=compositeur_chanson.Chanson_ID LEFT JOIN artiste AS artistecompositeur ON compositeur_chanson.Artiste_ID=artistecompositeur.Artiste_ID LEFT JOIN parolier_chanson ON chanson.Chanson_ID=parolier_chanson.Chanson_ID LEFT JOIN artiste AS artisteparolier ON parolier_chanson.Artiste_ID=artisteparolier.Artiste_ID JOIN image ON chanson.Chanson_ID=image.Chanson_ID WHERE chanson.Chanson_ID=:id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue("id", $_REQUEST["id"]);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $row["id"];
            $titre = $row["titre"];
            $nomcat = $row["nomcat"];
            $image = $row["image"];
            $interprete = array($row["nominter"]);
            $compositeur = array($row["nomcompo"]);
            $parolier = array($row["nomparo"]);
            $annee = $row["annee"];
            $duree = $row["duree"];
            $txtinterprete = "";
            $txtcompositeur = "";
            $txtparolier = "";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $interprete[] = $row["nominter"];
                $compositeur[] = $row["nomcompo"];
                $parolier[] = $row["nomparo"];
            }
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
            $txtinterprete = $tab[0];
            //...ensuite on écrit tout les autres...
            for ($i = 1; $i < $size; $i++) {
                $txtinterprete = $txtinterprete . "<br/>" . $tab[$i];
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
            $txtcompositeur = $tab[0];
            for ($i = 1; $i < $size; $i++) {
                $txtcompositeur = $txtcompositeur . "<br/>" . $tab[$i];
            }
            $compositeur = array();

            //idem interprete
            $result = array_unique($parolier);
            $tab = array();
            foreach ($result as $value) {
                $tab[] = $value;
            }
            $size = sizeof($tab);
            $txtparolier = $tab[0];
            for ($i = 1; $i < $size; $i++) {
                $txtparolier = $txtparolier . "<br/>" . $tab[$i];
            }
            $parolier = array();

            $image = "data/images/" . $image;
            echo "<div class=\"panel-heading\"><h3 class=\"panel-title\">" . $titre . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(" . $annee . ")<a href=\"?section=update-movie-form&id=" . $id . "\" class=\"btn btn-warning\">Moddifier</a><a href=\"?section=delete-movie-exec&id=" . $id . "\" class=\"btn btn-danger\">Supprimer</a></h3></div><div class=\"panel-body\"><h3>" . $duree . " secondes&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $nomcat . "</h3><div><h4>Interprète(s) : </h4><h5>" . $txtinterprete . "</h5> </div><div><h4>Compositeur : </h4><h5>" . $txtcompositeur . "</h5></div><div><h4>Parolier(s) : </h4><h5>" . $txtparolier . "</h5></div><div class='im-chanson-unique'><img ";
            ?> <?php fctaffichimage($image, 200, 200) ?> <?php
            echo "/\"></div></div>";
            /* echo "
              <div class=\"panel-heading\">
              <div class='header-unic'><h3 class=\"panel-title\">" . $titre .
              "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              (" . $annee . ")</div>
              <a href=\"?section=update-movie-form&id=" . $id . "\" ><div class=\"btn btn-warning\">Moddifier</div></a>
              <a href=\"?section=delete-movie-exec&id=" . $id . "\" ><div class=\"btn btn-danger\">Supprimer</div></a></h3></div>
              <div class=\"panel-body\"><h3>" . $duree . " secondes&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $nomcat . "</h3><div><h4>Interprète(s) : </h4><h5>" . $txtinterprete . "</h5> </div>
              <div><h4>Compositeur : </h4><h5>" . $txtcompositeur . "</h5></div>
              <div><h4>Parolier(s) : </h4><h5>" . $txtparolier . "</h5></div>
              <div class='im-chanson-unique'><img ";
              ?> <?php fctaffichimage($image, 200, 200) ?><?php
              echo "/\"></div></div>"; */

            unset($dbh);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>

    </div>
</div>