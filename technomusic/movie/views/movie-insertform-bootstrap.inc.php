<div class="well bs-component">
    <form class="form-horizontal" enctype="multipart/form-data" action="?" method="post">
        <input type="hidden" name="section" value="insert-movie-exec"/>
        <fieldset>
          <legend>Ajouter un film</legend>
          <div class="form-group">
            <label class="control-label">Titre</label>
            <div class="col-lg-10">
              <input class="form-control" name="title" placeholder="Encodez un titre" type="text">
            </div>
          </div> 
          <div class="form-group">
            <label class="control-label">Réalisateur</label>
            <div class="col-lg-10">
              <input class="form-control" name="director" placeholder="Encodez le nom du réalisateur" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Année</label>
            <div class="col-lg-10">
              <input class="form-control" name="year" placeholder="Encodez l'année" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Classement</label>
            <div class="col-lg-10">
              <input class="form-control"  name="rating" placeholder="Encodez le classement" type="text">
            </div>
          </div>
          <div class="form-group">
          <label for="textArea" class="control-label">Description</label>
          <div class="col-lg-10">
              <textarea class="form-control" rows="3" name="description" id="textArea"></textarea>
            <!--<span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>-->
          </div>
        </div>
          <div class="form-group">
            <label class="control-label">URL</label>
            <div class="col-lg-10">
              <input class="form-control" name="url" placeholder="URL IMDB" type="text">
            </div>
          </div>
          <div class="form-group">
        <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                Choisissez une image :
                <input name="picture" type="file" class="file" />
        </div>
           <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="reset" value="annuler" name="cancel" class="btn btn-default">annuler</button>
            <button type="submit" value="envoyer" name="submit" class="btn btn-primary">envoyer</button>
          </div>
        </div>
        </fieldset>
    </form>
</div>