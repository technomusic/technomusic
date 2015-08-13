<div class="col-lg-6">
<div class="panel panel-primary">

<?php
    try
    {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",   $username, $password);
        //$dbh = new PDO("sqlite:./data/movies.db");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sql = "SELECT album.Album_ID AS id, album.Titre AS titre, album.Annee AS annee, chanson.Titre AS nomchanson, label.Nom as label, artisteinterprete.Nom AS nominter, artistecompositeur.Nom AS nomcompo, artisteconducteur.Nom AS nomconduct, image.url AS image FROM album JOIN interprete_album ON album.Album_ID=interprete_album.Album_ID JOIN artiste AS artisteinterprete ON interprete_album.Artiste_ID=artisteinterprete.Artiste_ID JOIN label ON album.Label_ID=label.Label_ID JOIN compositeur_album ON album.Album_ID=compositeur_album.Album_ID JOIN artiste AS artistecompositeur ON compositeur_album.Artiste_ID=artistecompositeur.Artiste_ID JOIN conducteur_album ON album.Album_ID=conducteur_album.Album_ID JOIN artiste AS artisteconducteur ON conducteur_album.Artiste_ID=artisteconducteur.Artiste_ID JOIN chanson_album ON album.Album_ID=chanson_album.Album_ID JOIN chanson ON chanson_album.Chanson_ID=chanson.Chanson_ID JOIN image ON album.Album_ID=image.Album_ID WHERE album.Album_ID=:id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue("id", $_REQUEST["id"]);
        $stmt->execute();
        
        $id;
        $titre;
        $annee;
        $label;
        $image;
        $nomchanson;
        $nominter;
        $nomcompo;
        $nomconduct;
        $artisteinterprete;
        $artistecompositeur;
        $artisteconducteur;
        
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            
        $id = $row["id"];
        $titre = $row["titre"];
        $annee = $row["annee"];
        $label = $row["label"];
        $image = $row["image"];
        $nomchanson = array($row["nomchanson"]);
        $nominter = array($row["nominter"]);
        $nomcompo = array($row["nomcompo"]);
        $nomconduct = array($row["nomconduct"]);
        $artisteinterprete = $row["nominter"];
        $artistecompositeur = $row["nomcompo"];
        $artisteconducteur = $row["nomconduct"];
        $txtinterprete = "";
        $txtcompositeur = "";
        $txtconducteur = "";
        $txtchanson = "";
        if ($id == $row["id"]) {
                    $nominter[] = $row["nominter"];
                    $nomcompo[] = $row["nomcompo"];
                    $nomconduct[] = $row["nomconduct"];
                    $nomchanson[] = $row["nomchanson"];
                //quand ce n'est plus le même id...
                } else {
                    //... on élimine les doublons interprete...
                    $result = array_unique($nominter);
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
                    $nominter = array();

                    //idem interprete
                    $result = array_unique($nomcompo);
                    $tab = array();
                    foreach ($result as $value) {
                        $tab[] = $value;
                    }
                    $size = sizeof($tab);
                    $txtcompositeur = $tab[0];
                    for ($i = 1; $i < $size; $i++) {
                        $txtcompositeur = $txtcompositeur . "<br/>" . $tab[$i];
                    }
                    $nomcompo = array();

                    //idem interprete
                    $result = array_unique($nomconduct);
                    $tab = array();
                    foreach ($result as $value) {
                        $tab[] = $value;
                    }
                    $size = sizeof($tab);
                    $txtconducteur = $tab[0];
                    for ($i = 1; $i < $size; $i++) {
                        $txtconducteur = $txtconducteur . "<br/>" . $tab[$i];
                    }
                    $nomconduct = array();
                    
                    //idem chanson
                    $result = array_unique($nomchanson);
                    $tab = array();
                    foreach ($result as $value) {
                        $tab[] = $value;
                    }
                    $size = sizeof($tab);
                    $txtchanson = $tab[0];
                    for ($i = 1; $i < $size; $i++) {
                        $txtchanson = $txtchanson . "<br/>" . $tab[$i];
                    }
                    $nomchanson = array();
                    
                    
           
        
        
        echo "<div class=\"panel-heading\"><h3 class=\"panel-title\">" . $titre . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(" . $annee . ")<a href=\"?section=update-movie-form&id=" . $id . "\" class=\"btn btn-warning\">Moddifier</a><a href=\"?section=delete-movie-exec&id=" . $id . "\" class=\"btn btn-danger\">Supprimer</a></h3></div><div><h4>Interprète : </h4><h5>" . $txtinterprete . "</h5> </div> <div><h4>Compositeur : </h4><h5>" . $txtcompositeur . "</h5></div><div><h4>Conducteur : </h4><h5>" . $txtconducteur . "</h5></div><div><img src=\"data/images/" . $image . "\"></div><div><h4>Titres : </h4><h5>" . $txtchanson . "</h5></div>";
        
        //Réinitialisation des variables
        $id = $row["id"];
        $titre = $row["titre"];
        $annee = $row["annee"];
        $label = $row["label"];
        $image = $row["image"];
        $nomchanson = array($row["nomchanson"]);
        $nominter = array($row["nominter"]);
        $nomcompo = array($row["nomcompo"]);
        $nomconduct = array($row["nomconduct"]);
        $artisteinterprete = $row["nominter"];
        $artistecompositeur = $row["nomcompo"];
        $artisteconducteur = $row["nomconduct"];
        $txtinterprete = "";
        $txtcompositeur = "";
        $txtconducteur = "";
        $txtchanson = "";
        
    }
      }
    $result = array_unique($nominter);
            $tab = array();
            foreach ($result as $value) {
                $tab[] = $value;
            }
            $size = sizeof($tab);
            $txtinterprete = $tab[0];
            for ($i = 1; $i < $size; $i++) {
                $txtinterprete = $txtinterprete . "<br/>" . $tab[$i];
            }
            $nominter = array();


            $result = array_unique($nomcompo);
            $tab = array();
            foreach ($result as $value) {
                $tab[] = $value;
            }
            $size = sizeof($tab);
            $txtcompositeur = $tab[0];
            for ($i = 1; $i < $size; $i++) {
                $txtcompositeur = $txtcompositeur . "<br/>" . $tab[$i];
            }
            $nomcompo = array();


            $result = array_unique($nomconduct);
            $tab = array();
            foreach ($result as $value) {
                $tab[] = $value;
            }
            $size = sizeof($tab);
            $txtconducteur = $tab[0];
            for ($i = 1; $i < $size; $i++) {
                $txtconducteur = $txtconducteur . "<br/>" . $tab[$i];
            }
            $nomconduct = array();
            
             $result = array_unique($nomchanson);
            $tab = array();
            foreach ($result as $value) {
                $tab[] = $value;
            }
            $size = sizeof($tab);
            $txtchanson = $tab[0];
            for ($i = 1; $i < $size; $i++) {
                $txtchanson = $txtchanson . "<br/>" . $tab[$i];
            }
            $nomchanson = array();
            
            echo "<div class=\"panel-heading\"><h3 class=\"panel-title\">" . $titre . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(" . $annee . ")<a href=\"?section=update-movie-form&id=" . $id . "\" class=\"btn btn-warning\">Moddifier</a><a href=\"?section=delete-movie-exec&id=" . $id . "\" class=\"btn btn-danger\">Supprimer</a></h3></div><div><h4>Interprète : </h4><h5>" . $txtinterprete . "</h5> </div> <div><h4>Compositeur : </h4><h5>" . $txtcompositeur . "</h5></div><div><h4>Conducteur : </h4><h5>" . $txtconducteur . "</h5></div><div><img src=\"data/images/" . $image . "\"></div><div><h4>Titres : </h4><h5>" . $txtchanson . "</h5></div>";
        
        
    unset($dbh);
    
                    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    } 

?>

</div>
</div>
