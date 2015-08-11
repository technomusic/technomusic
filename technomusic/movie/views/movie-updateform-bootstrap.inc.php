<div class="well bs-component">
    <form class="form-horizontal" enctype="multipart/form-data" action="?" method="post">
        <input type="hidden" name="section" value="update-movie-exec"/>
        <?php
            echo "<input type=\"hidden\" name=\"id\" value=\"" . $id = $_REQUEST["id"] . "\"/>";
            
            try
            {
                $dbh = new PDO("mysql:host=$hostname;dbname=filhebdo",   $username, $password);
                //$dbh = new PDO("sqlite:./data/movies.db");
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                $sql = "SELECT * FROM movies WHERE id=:id";
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue("id", $_REQUEST["id"]);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $title = $row["title"];
                    $director = $row["director"];
                    $year = $row["year"];
                    $rating = $row["rating"];
                    $description = $row["description"];
                    $url = $row["url"];
                }
                unset($dbh);
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            } 
                    
        ?>


        <fieldset>
          <legend>Ajouter un film</legend>
          <div class="form-group">
            <label class="control-label">Titre</label>
            <div class="col-lg-10">
              <input class="form-control" name="title" value="<?php echo $title;?>" type="text">
            </div>
          </div> 
          <div class="form-group">
            <label class="control-label">Réalisateur</label>
            <div class="col-lg-10">
              <input class="form-control" name="director" value="<?php echo $director;?>" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Année</label>
            <div class="col-lg-10">
              <input class="form-control" name="year" value="<?php echo $year;?>" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Classement</label>
            <div class="col-lg-10">
              <input class="form-control"  name="rating" value="<?php echo $rating;?>" type="text">
            </div>
          </div>
          <div class="form-group">
          <label for="textArea" class="control-label">Description</label>
          <div class="col-lg-10">
              <textarea class="form-control" rows="3" name="description" id="textArea"><?php echo $description;?></textarea>
            <!--<span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>-->
          </div>
        </div>
          <div class="form-group">
            <label class="control-label">URL</label>
            <div class="col-lg-10">
              <input class="form-control" name="url" value="<?php echo $url;?>" type="text">
            </div>
          </div>
<!--          <div class="form-group">
        <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                Choisissez une image :
                <input name="picture" type="file" class="file" />
        </div>-->
           <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="reset" value="annuler" name="cancel" class="btn btn-default">annuler</button>
            <button type="submit" value="envoyer" name="submit" class="btn btn-primary">envoyer</button>
          </div>
        </div>
        </fieldset>
    </form>
</div>