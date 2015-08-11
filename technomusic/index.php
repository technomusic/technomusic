<?php

//inclusion de la librairie
include('lib/file.inc.php');

//inclusion du header
include 'views/header-page-bootsrap.inc.php';

//inclusion du menu
include 'views/menu-inc.php' ;

//on vérifie qui nous appel
if (isset($_REQUEST["section"])) {
    switch ($_REQUEST["section"]) {
        case "affiche-movie-exec":
            //include("mods/movies.inc.php");
            include("views/movie-uniq-bootstrap.inc.php");
            break;
        case "search-movie-form":
            include("views/movie-searchform-bootstrap.inc.php");
            break;
        case "search-movie-exec":
            //include("mods/movies.inc.php");
            include("views/searchmovies-list-bootstrap.inc.php");
            break;
        case "insert-movie-form":
            include("views/movie-insertform-bootstrap.inc.php");
            break;
        case "insert-movie-exec":
            include("mods/movies.inc.php");
            //include("views/cars-confirm-bootstrap.inc.php");
            break;
        case "delete-movie-exec":
            include("mods/movies.inc.php");
            //include("views/cars-confirm-bootstrap.inc.php");
            break;
        case "update-movie-form":
            include("views/movie-updateform-bootstrap.inc.php");
            break;
        case "update-movie-exec":
            include("mods/movies.inc.php");
            break;
    }
//si personne ne nous a appelé c'est qu'on arrive pour la première fois. On affiche donc la page d'accueil
} else {
    //include("views/home-page-bootstrap.inc.php");
    include 'views/chanson-liste.inc.php';
}

include 'views/footer-page-bootsrap.inc.php';
?>