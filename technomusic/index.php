<?php

//inclusion de la librairie
include('lib/file.inc.php');

//inclusion du header
include 'views/header-page-bootsrap.inc.php';

//inclusion du menu
//include 'views/menu-inc.php' ;

//on vérifie qui nous appel
if (isset($_REQUEST["section"])) {
    switch ($_REQUEST["section"]) {
        case "affiche-label-liste":
            include("views/label-liste.inc.php");
            break;
        case "affiche-label-unic":
            include("views/label-unic.inc.php");
            break;
    }
//si personne ne nous a appelé c'est qu'on arrive pour la première fois. On affiche donc la page d'accueil
} else {
    //include("views/home-page-bootstrap.inc.php");
    include 'views/chanson-liste.inc.php';
}

include 'views/footer-page-bootsrap.inc.php';
?>