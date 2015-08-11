<?php

$records = "";
switch ($_REQUEST["section"]) {
    case "update-movie-exec":
        
        $id = $_REQUEST["id"];
        $title = $_POST["title"];
        $director = $_POST["director"];
        $year = $_POST["year"];
        $rating = $_POST["rating"];
        $description = $_POST["description"];
        $url = $_POST["url"];
        //$picture = $img;
        
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=filhebdo",   $username, $password);
            //$dbh = new PDO("sqlite:./data/movies.db");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE movies SET title = :title, director = :director, description = :description, year = :year, rating = :rating, url = :url WHERE id = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue("id", $id);
            $stmt->bindValue("title", $title);
            $stmt->bindValue("director", $director);
            $stmt->bindValue("description", $description);
            $stmt->bindValue("year", $year);
            $stmt->bindValue("rating", $rating);
            //$stmt->bindValue("image", $picture);
            $stmt->bindValue("url", $url);
            $stmt->execute();
            unset($dbh);
            echo "Données de test moddifiée dans la base de données movies.db";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
    case "delete-movie-exec":
        
        $id = $_REQUEST["id"];
        
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=filhebdo",   $username, $password);
            //$dbh = new PDO("sqlite:./data/movies.db");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM movies WHERE id = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue("id", $id);
            $stmt->execute();
            unset($dbh);
            echo "Données de test supprimée de la base de données movies.db";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
        break;
    case "insert-movie-exec":

        if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
            $tmp_name = $_FILES['picture']['tmp_name'];
            $name = $_FILES['picture']['name'];
            $name = clean($name);
            $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
            $img = get_unique_filename('', $name, $extension);
            $wimg = 'data/images/' . $img;
            if (move_uploaded_file($tmp_name, $wimg)) {
                echo "<div id='content'>Fichier transféré et copié correctement</div>";
            }
        }

        $title = $_POST["title"];
        $director = $_POST["director"];
        $year = $_POST["year"];
        $rating = $_POST["rating"];
        $description = $_POST["description"];
        $url = $_POST["url"];
        $picture = $img;
        
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=filhebdo",   $username, $password);
            //$dbh = new PDO("sqlite:./data/movies.db");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO movies (title, director, description, year, rating, image, url) VALUES (:title, :director, :description, :year, :rating, :image, :url)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue("title", $title);
            $stmt->bindValue("director", $director);
            $stmt->bindValue("description", $description);
            $stmt->bindValue("year", $year);
            $stmt->bindValue("rating", $rating);
            $stmt->bindValue("image", $picture);
            $stmt->bindValue("url", $url);
            $stmt->execute();
            unset($dbh);
            echo "Donn�es de test ins�r�es dans la base de donn�es movies.db";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
}
?>