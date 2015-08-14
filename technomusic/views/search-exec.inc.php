<div class="bs-component">

    <?php
    try {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->query('SET NAMES utf8');
        //echo var_dump($_REQUEST);

        if ((isset($_REQUEST['artiste']) && ($_REQUEST['artiste'] == 'on'))) {
            echo "<table class=\"table table-striped table-hover \"><thead><tr><th>Nom</th><th>Prénom</th><th>Pseudo</th><th>Date de naissance</th></tr></thead><tbody>";

            $sql = "SELECT artiste.Artiste_ID AS id, artiste.Nom AS nom, artiste.Prenom AS prenom, artiste.Surnom AS pseudo, DATE_FORMAT(artiste.Date_Naissance,'%d/%m/%Y') AS dn FROM artiste LEFT JOIN image ON artiste.Artiste_ID=image.Artiste_ID WHERE (CONVERT(artiste.Artiste_ID USING utf8) LIKE :keyword OR CONVERT(artiste.Nom USING utf8) LIKE :keyword OR CONVERT(artiste.Prenom USING utf8) LIKE :keyword OR CONVERT(artiste.Surnom USING utf8) LIKE :keyword OR CONVERT(DATE_FORMAT(artiste.Date_Naissance,'%d/%m/%Y') USING utf8) LIKE :keyword OR CONVERT(artiste.Lieu_Naissance USING utf8) LIKE :keyword OR CONVERT(artiste.Bio USING utf8) LIKE :keyword) ORDER BY artiste.Nom";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(":keyword" => "%{$_GET["recherche"]}%"));
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = $row["id"];
                $nom = $row["nom"];
                $prenom = $row["prenom"];
                $pseudo = $row["pseudo"];
                $dn = $row["dn"];
                echo "<tr><td><a href=\"?section=affiche-artiste-unic&id=" . $id . "\">" . $nom . "</a></td><td>" . $prenom . "</td><td>" . $pseudo . "</td><td>" . $dn . "</td></tr>";
                //            echo "<a href='fiche.php?id={$row["id"]}'>{$row["title"]}</a>";
                //            echo "-" . $row["director"] . "<br/>"; 				
            }
            echo "</table>";
        }

        if ((isset($_REQUEST['chanson']) && ($_REQUEST['chanson'] == 'on'))) {
            echo "<table class=\"table table-striped table-hover \"><thead><tr><th>Titre</th><th>Année</th><th>Durée(secondes)</th><th>Catégorie</th><th>Interprete(s)</th><th>Compositeur(s)</th><th>Conducteur(s)</th></tr></thead><tbody>";

            $sql = "SELECT chanson.Chanson_ID AS id, chanson.Titre AS titre, chanson.Annee AS annee, chanson.Duree AS duree, categorie.Nom AS nomcat, artisteinterprete.Nom AS nominter, artistecompositeur.Nom AS nomcompo, artisteparolier.Nom AS nomparo FROM chanson LEFT JOIN interprete_chanson ON chanson.Chanson_ID=interprete_chanson.Chanson_ID LEFT JOIN artiste AS artisteinterprete ON interprete_chanson.Artiste_ID=artisteinterprete.Artiste_ID LEFT JOIN categorie ON chanson.Categorie_ID=categorie.Categorie_ID LEFT JOIN compositeur_chanson ON chanson.Chanson_ID=compositeur_chanson.Chanson_ID LEFT JOIN artiste AS artistecompositeur ON compositeur_chanson.Artiste_ID=artistecompositeur.Artiste_ID LEFT JOIN parolier_chanson ON chanson.Chanson_ID=parolier_chanson.Chanson_ID LEFT JOIN artiste AS artisteparolier ON parolier_chanson.Artiste_ID=artisteparolier.Artiste_ID WHERE (CONVERT(chanson.Chanson_ID USING utf8) LIKE :keyword OR CONVERT(chanson.Titre USING utf8) LIKE :keyword OR CONVERT(chanson.Duree USING utf8) LIKE :keyword OR CONVERT(chanson.Annee USING utf8) LIKE :keyword OR CONVERT(chanson.Description USING utf8) LIKE :keyword OR CONVERT(chanson.Categorie_ID USING utf8) LIKE :keyword) ORDER BY chanson.Titre";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(":keyword" => "%{$_GET["recherche"]}%"));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $row["id"];
            $titre = $row["titre"];
            $cat = $row["nomcat"];
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

                    echo "<tr><td><a href=\"?section=affiche-chanson-unic&id=" . $id . "\">" . $titre . "</a></td><td>" . $annee . "</td><td>" . $duree . "</td><td>" . $cat . "</td><td>" . $txtinterprete . "</td><td>" . $txtcompositeur . "</td><td>" . $txtparolier . "</td></tr>";
                    $id = $row["id"];
                    $titre = $row["titre"];
                    $cat = $row["nomcat"];
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

            echo "<tr><td><a href=\"?section=affiche-chanson-unic&id=" . $id . "\">" . $titre . "</a></td><td>" . $annee . "</td><td>" . $duree . "</td><td>" . $cat . "</td><td>" . $txtinterprete . "</td><td>" . $txtcompositeur . "</td><td>" . $txtparolier . "</td></tr>";
            echo "</table>";
        }

        if ((isset($_REQUEST['album']) && ($_REQUEST['album'] == 'on'))) {
            echo "<table class=\"table table-striped table-hover \"><thead><tr><th>Titre</th><th>Année</th><th>Interprete(s)</th><th>Compositeur(s)</th><th>Conducteur(s)</th><th>Label</th></tr></thead><tbody>";

            $sql = "SELECT album.Album_ID AS id, album.Titre AS titre, album.Annee AS annee, label.Nom as label, artisteinterprete.Nom AS nominter, artistecompositeur.Nom AS nomcompo, artisteconducteur.Nom AS nomconduct FROM album JOIN interprete_album ON album.Album_ID=interprete_album.Album_ID JOIN artiste AS artisteinterprete ON interprete_album.Artiste_ID=artisteinterprete.Artiste_ID JOIN label ON album.Label_ID=label.Label_ID JOIN compositeur_album ON album.Album_ID=compositeur_album.Album_ID JOIN artiste AS artistecompositeur ON compositeur_album.Artiste_ID=artistecompositeur.Artiste_ID JOIN conducteur_album ON album.Album_ID=conducteur_album.Album_ID JOIN artiste AS artisteconducteur ON conducteur_album.Artiste_ID=artisteconducteur.Artiste_ID WHERE (CONVERT(album.Album_ID USING utf8) LIKE :keyword OR CONVERT(album.Titre USING utf8) LIKE :keyword OR CONVERT(album.Annee USING utf8) LIKE :keyword OR CONVERT(album.Label_ID USING utf8) LIKE :keyword) ORDER BY album.Titre";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(":keyword" => "%{$_GET["recherche"]}%"));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $row["id"];
            $titre = $row["titre"];
            $interprete = array($row["nominter"]);
            $compositeur = array($row["nomcompo"]);
            $conducteur = array($row["nomconduct"]);
            $annee = $row["annee"];
            $label = $row["label"];
            $txtinterprete = "";
            $txtcompositeur = "";
            $txtconducteur = "";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //si l'id de l'album est le même on ajoute dans leur tableau respectif l'interprete, le compositeur et le conducteur
                if ($id == $row["id"]) {
                    $interprete[] = $row["nominter"];
                    $compositeur[] = $row["nomcompo"];
                    $conducteur[] = $row["nomconduct"];
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
                    $result = array_unique($conducteur);
                    $tab = array();
                    foreach ($result as $value) {
                        $tab[] = $value;
                    }
                    $size = sizeof($tab);
                    $txtconducteur = $tab[0];
                    for ($i = 1; $i < $size; $i++) {
                        $txtconducteur = $txtconducteur . "<br/>" . $tab[$i];
                    }
                    $conducteur = array();




                    //...ensuite on affiche la ligne de la table...
                    echo "<tr><td><a href=\"?section=affiche-album-unic&id=" . $id . "\">" . $titre . "</a></td><td>" . $annee . "</td><td>" . $txtinterprete . "</td><td>" . $txtcompositeur . "</td><td>" . $txtconducteur . "</td><td>" . $label . "</td></tr>";
                    //...puis on réinitialise toutes les variables pour le prochain tour
                    $txtconducteur = "";
                    $txtinterprete = "";
                    $txtcompositeur = "";
                    $id = $row["id"];
                    $titre = $row["titre"];
                    $interprete = array($row["nominter"]);
                    $compositeur = array($row["nomcompo"]);
                    $conducteur = array($row["nomconduct"]);
                    $annee = $row["annee"];
                    $label = $row["label"];
                }
            }
            //quand on a lu tout les records, on recommance le petit manège une dernière fois.
            $result = array_unique($interprete);
            $tab = array();
            foreach ($result as $value) {
                $tab[] = $value;
            }
            $size = sizeof($tab);
            $txtinterprete = $tab[0];
            for ($i = 1; $i < $size; $i++) {
                $txtinterprete = $txtinterprete . "<br/>" . $tab[$i];
            }
            $interprete = array();


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


            $result = array_unique($conducteur);
            $tab = array();
            foreach ($result as $value) {
                $tab[] = $value;
            }
            $size = sizeof($tab);
            $txtconducteur = $tab[0];
            for ($i = 1; $i < $size; $i++) {
                $txtconducteur = $txtconducteur . "<br/>" . $tab[$i];
            }
            $conducteur = array();


            echo "<tr><td><a href=\"?section=affiche-album-unic&id=" . $id . "\">" . $titre . "</a></td><td>" . $annee . "</td><td>" . $txtinterprete . "</td><td>" . $txtcompositeur . "</td><td>" . $txtconducteur . "</td><td>" . $label . "</td></tr></table>";
        }

        if ((isset($_REQUEST['label']) && ($_REQUEST['label'] == 'on'))) {
            echo "<table class=\"table table-striped table-hover \"><thead><tr><th>Nom</th></tr></thead><tbody>";
            $sql = "SELECT label.Label_ID AS id, label.Nom AS nom FROM label JOIN image ON label.Label_ID=image.Label_ID WHERE (CONVERT(label.Label_ID USING utf8) LIKE :keyword OR CONVERT(label.Nom USING utf8) LIKE :keyword OR CONVERT(label.Description USING utf8) LIKE :keyword)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(":keyword" => "%{$_GET["recherche"]}%"));
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $id = $row["id"];
                $nom = $row["nom"];
                echo "<tr><td><a href=\"?section=affiche-label-unic&id=" . $id . "\">" . $nom . "</a></td></tr></table>";
            }
        }

        if ((isset($_REQUEST['categorie']) && ($_REQUEST['categorie'] == 'on'))) {
            echo "<table class=\"table table-striped table-hover \"><thead><tr><th>Nom</th></tr></thead><tbody>";

            $sql = "SELECT categorie.Categorie_ID AS id, categorie.Nom AS nom FROM categorie LEFT JOIN image ON categorie.Categorie_ID=image.Categorie_ID WHERE (CONVERT(categorie.Categorie_ID USING utf8) LIKE :keyword OR CONVERT(categorie.Nom USING utf8) LIKE :keyword)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(":keyword" => "%{$_GET["recherche"]}%"));
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $id = $row["id"];
                $nom = $row["nom"];
                echo "<tr><td>" . $nom . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href=\"?section=update-movie-form&id=" . $id . "\" class=\"btn btn-warning\">Moddifier</a><a href=\"?section=delete-movie-exec&id=" . $id . "\" class=\"btn btn-danger\">Supprimer</a></td></tr></div>";
            }
            echo "</table>";
        }

        unset($dbh);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>
</div>