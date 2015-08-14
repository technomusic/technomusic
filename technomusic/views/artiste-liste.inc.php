<div class="bs-component">
    <table class="table table-striped table-hover ">


        <?php
        echo "Liste des artistes : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href=\"#\" class=\"btn btn-success\">Ajout</a><br/><br/>";

        echo "<thead><tr><th></th><th>Nom</th><th>Prénom</th><th>Pseudo</th><th>Date de naissance</th></tr></thead><tbody>";
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            //$dbh = new PDO("sqlite:./data/movies.db");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->query('SET NAMES utf8');
            $sql = "SELECT image.url AS image, artiste.Artiste_ID AS id, artiste.Nom AS nom, artiste.Prenom AS prenom, artiste.Surnom AS pseudo, DATE_FORMAT(artiste.Date_Naissance,'%d/%m/%Y') AS dn FROM artiste LEFT JOIN image ON artiste.Artiste_ID=image.Artiste_ID";
            $stmt = $dbh->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = $row["id"];
                $nom = $row["nom"];
                $prenom = $row["prenom"];
                $pseudo = $row["pseudo"];
                $dn = $row["dn"];
                $image = $row["image"];

                $image = "data/images/" . $image;
                echo "<tr><td><img ";
                ?> <?php fctaffichimage($image, 75, 75) ?> <?php
                echo "/\"></td><td><a href=\"?section=affiche-artiste-unic&id=" . $id . "\">" . $nom . "</a></td><td>" . $prenom . "</td><td>" . $pseudo . "</td><td>" . $dn . "</td></tr>";
            }
            unset($dbh);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>

    </table>
</div>