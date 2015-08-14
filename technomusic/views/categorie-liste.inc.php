<div class="bs-component">
    <table class="table table-striped table-hover ">


        <?php
        echo "Liste des catégories : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href=\"#\" class=\"btn btn-success\">Ajout</a><br/><br/>";

        echo "<thead><tr><th></th><th>Nom</th></tr></thead><tbody>";
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
                echo "<tr><td><img ";
                ?> <?php fctaffichimage($image, 75, 75) ?> <?php
                echo "/\"></td><td>" . $nom . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href=\"?section=update-movie-form&id=" . $id . "\" class=\"btn btn-warning\">Moddifier</a><a href=\"?section=delete-movie-exec&id=" . $id . "\" class=\"btn btn-danger\">Supprimer</a></td></tr>";
            }
            unset($dbh);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>

    </table>
</div>