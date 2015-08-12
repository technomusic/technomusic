<div class="bs-component">
    <table class="table table-striped table-hover ">

        <?php
        echo "<thead><tr><th>Titre</th><th>Année</th><th>Artiste(s)</th><th>Compositeur(s)</th><th>Conducteur(s)</th><th>Label</th></tr></thead><tbody>";
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            //$dbh = new PDO("sqlite:./data/movies.db");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT album.Album_ID AS id, album.Titre AS titre, album.Annee AS annee, label.Nom as label, artisteinterprete.Nom AS nominter, artistecompositeur.Nom AS nomcompo, artisteconducteur.Nom AS nomconduct FROM album JOIN interprete_album ON album.Album_ID=interprete_album.Album_ID JOIN artiste AS artisteinterprete ON interprete_album.Artiste_ID=artisteinterprete.Artiste_ID JOIN label ON album.Label_ID=label.Label_ID JOIN compositeur_album ON album.Album_ID=compositeur_album.Album_ID JOIN artiste AS artistecompositeur ON compositeur_album.Artiste_ID=artistecompositeur.Artiste_ID JOIN conducteur_album ON album.Album_ID=conducteur_album.Album_ID JOIN artiste AS artisteconducteur ON conducteur_album.Artiste_ID=artisteconducteur.Artiste_ID";
            $stmt = $dbh->query($sql);
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
            echo "<tr><td><a href=\"?section=affiche-album-unic&id=" . $id . "\">" . $titre . "</a></td><td>" . $annee . "</td><td>" . $txtinterprete . "</td><td>" . $txtcompositeur . "</td><td>" . $txtconducteur . "</td><td>" . $label . "</td></tr>";
            unset($dbh);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>

    </table>
</div>