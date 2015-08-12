<div class="bs-component">
    <table class="table table-striped table-hover ">

<?php
  echo "<thead><tr><th>Titre</th><th>Année</th><th>Artiste(s)</th><th>Label</th></tr></thead><tbody>";
    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT album.Album_ID AS id, album.Titre AS titre, album.Annee AS annee, label.Nom as label, artiste.Nom AS nomart FROM album JOIN interprete_album ON album.Album_ID=interprete_album.Album_ID JOIN artiste ON interprete_Album.Artiste_ID=artiste.Artiste_ID JOIN label ON album.Label_ID=label.Label_ID";
        $stmt = $dbh->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $row["id"];
        $titre = $row["titre"];
        $interprete = $row["nomart"];
        $annee = $row["annee"];
        $label = $row["label"];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {    
            if($id == $row["id"]){
                $interprete = $interprete . "<br/>" . $row["nomart"];
            }
            else{
                echo "<tr><td><a href=\"?section=affiche-album-unic&id=" . $id . "\">" . $titre . "</a></td><td>" . $annee . "</td><td>" . $interprete . "</td><td>" . $label . "</td></tr>";
                $id = $row["id"];
                $titre = $row["titre"];
                $interprete = $row["nomart"];
                $annee = $row["annee"];
                $label = $row["label"];
            }   
        }
        echo "<tr><td><a href=\"?section=affiche-album-unic&id=" . $id . "\">" . $titre . "</a></td><td>" . $annee . "</td><td>" . $interprete . "</td><td>" . $label . "</td></tr>";
        unset($dbh);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    } 

?>

    </table>
</div>