<div class="col-lg-6">
    <div class="well bs-component">
        <form class="form-horizontal" enctype="multipart/form-data" method="get">
            <input type="hidden" name="section" value="search-exec"/>
            <fieldset>
                <legend>Nouvelle recherche</legend>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="table" value="1"> Artiste
                        </label>
                        <label>
                            <input type="checkbox" name="table" value="2"> Chanson
                        </label>
                        <label>
                            <input type="checkbox" name="table" value="3"> Album
                        </label>
                        <label>
                            <input type="checkbox" name="table" value="4"> Label
                        </label>
                        <label>
                            <input type="checkbox" name="table" value="5"> Catégorie
                        </label>
                    </div>
                    <label class="control-label" for="inputDefault">Votre recherche</label>
                    <input type="text" class="form-control" name="recherche" id="inputDefault">
                </div>
                <!--            <div class="form-group">
                                <select multiple name="opt[]" class="form-control">
                                  <option selected="selected" value="all">Tous</option>  
                                  <option value="1">Année</option>
                                  <option value="2">Fabricant</option>
                                  <option value="3">Modèle</option>
                                  <option value="4">Description</option>
                                  <option value="5">Prix</option>
                                </select>
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
</div>