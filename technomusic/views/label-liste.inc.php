<div class="bs-component">
    <table class="table table-striped table-hover ">


        <?php
        echo "Liste des labels : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href=\"#\" class=\"btn btn-success\">Ajout</a><br/><br/>";

        echo "<thead><tr><th></th><th>Nom</th></tr></thead><tbody>";
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            //$dbh = new PDO("sqlite:./data/movies.db");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->query('SET NAMES utf8');
            $sql = "SELECT image.url AS image, label.Label_ID AS id, label.Nom AS nom FROM label JOIN image ON label.Label_ID=image.Label_ID";
            $stmt = $dbh->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $id = $row["id"];
                $nom = $row["nom"];
                $image = $row["image"];
                $image = "data/images/" . $image;
                echo "<tr><td><img ";
                ?> <?php fctaffichimage($image, 75, 75) ?> <?php
                echo "/\"></td><td><a href=\"?section=affiche-label-unic&id=" . $id . "\">" . $nom . "</a></td></tr>";
            }
            unset($dbh);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>

    </table>
</div>