<div class="col-lg-6">
    <div class="well bs-component">
        <form class="form-horizontal" enctype="multipart/form-data" method="get">
            <input type="hidden" name="section" value="search-exec"/>
            <fieldset>
                <legend>Nouvelle recherche</legend>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="artiste"> Artiste
                        </label>
                        <label>
                            <input type="checkbox" name="chanson"> Chanson
                        </label>
                        <label>
                            <input type="checkbox" name="album"> Album
                        </label>
                        <label>
                            <input type="checkbox" name="label"> Label
                        </label>
                        <label>
                            <input type="checkbox" name="categorie"> Catégorie
                        </label>
                    </div>
                    <label class="control-label" for="inputDefault">Votre recherche</label>
                    <input type="text" class="form-control" name="recherche" id="inputDefault">
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
</div>