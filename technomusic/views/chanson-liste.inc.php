<div class="bs-component">
    <table class="table table-striped table-hover ">

        <?php
        echo "Liste des chansons : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href=\"#\" class=\"btn btn-success\">Ajout</a><br/><br/>";


        echo "<thead><tr><th></th><th>Titre</th><th>Année</th><th>Durée(secondes)</th><th>Catégorie</th><th>Interprete(s)</th><th>Compositeur(s)</th><th>Conducteur(s)</th></tr></thead><tbody>";
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            //$dbh = new PDO("sqlite:./data/movies.db");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->query('SET NAMES utf8');
            $sql = "SELECT image.url AS image, chanson.Chanson_ID AS id, chanson.Titre AS titre, chanson.Annee AS annee, chanson.Duree AS duree, categorie.Nom AS nomcat, artisteinterprete.Nom AS nominter, artistecompositeur.Nom AS nomcompo, artisteparolier.Nom AS nomparo FROM chanson LEFT JOIN interprete_chanson ON chanson.Chanson_ID=interprete_chanson.Chanson_ID LEFT JOIN artiste AS artisteinterprete ON interprete_chanson.Artiste_ID=artisteinterprete.Artiste_ID LEFT JOIN categorie ON chanson.Categorie_ID=categorie.Categorie_ID LEFT JOIN compositeur_chanson ON chanson.Chanson_ID=compositeur_chanson.Chanson_ID LEFT JOIN artiste AS artistecompositeur ON compositeur_chanson.Artiste_ID=artistecompositeur.Artiste_ID LEFT JOIN parolier_chanson ON chanson.Chanson_ID=parolier_chanson.Chanson_ID LEFT JOIN artiste AS artisteparolier ON parolier_chanson.Artiste_ID=artisteparolier.Artiste_ID JOIN image ON chanson.Chanson_ID=image.Chanson_ID ORDER BY titre";
            $stmt = $dbh->query($sql);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $row["id"];
            $titre = $row["titre"];
            $cat = $row["nomcat"];
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
                if ($id == $row["id"]) {
                    $interprete[] = $row["nominter"];
                    $compositeur[] = $row["nomcompo"];
                    $parolier[] = $row["nomparo"];
                    //quand ce n'est plus le même id...
                } else {
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
                    //...pour enfin netoyer le tableau pour les autre chansons...
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
                    echo "<tr><td><img ";
                    ?> <?php fctaffichimage($image, 75, 75) ?> <?php
                    echo "/\"></td><td><a href=\"?section=affiche-chanson-unic&id=" . $id . "\">" . $titre . "</a></td><td>" . $annee . "</td><td>" . $duree . "</td><td>" . $cat . "</td><td>" . $txtinterprete . "</td><td>" . $txtcompositeur . "</td><td>" . $txtparolier . "</td></tr>";
                    $id = $row["id"];
                    $titre = $row["titre"];
                    $cat = $row["nomcat"];
                    $image = $row["image"];
                    $interprete = array($row["nominter"]);
                    $compositeur = array($row["nomcompo"]);
                    $parolier = array($row["nomparo"]);
                    $annee = $row["annee"];
                    $duree = $row["duree"];
                    $txtinterprete = "";
                    $txtcompositeur = "";
                    $txtparolier = "";
                }
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
            //...pour enfin netoyer le tableau pour les autre chansons...
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
            echo "<tr><td><img ";
            ?> <?php fctaffichimage($image, 75, 75) ?> <?php
            echo "/\"></td><td><a href=\"?section=affiche-chanson-unic&id=" . $id . "\">" . $titre . "</a></td><td>" . $annee . "</td><td>" . $duree . "</td><td>" . $cat . "</td><td>" . $txtinterprete . "</td><td>" . $txtcompositeur . "</td><td>" . $txtparolier . "</td></tr>";
            unset($dbh);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>

    </table>
</div>