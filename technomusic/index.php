<?php

//inclusion de la librairie
include('lib/file.inc.php');

//inclusion du header
include 'views/header-page-bootsrap.inc.php';

//inclusion du menu
include 'views/menu-inc.php';
echo "<div >";
echo "<div class='page-principale'>";
//on vérifie qui nous appel
if (isset($_REQUEST["section"])) {
    switch ($_REQUEST["section"]) {
        case "login" :
            include "views/inscription-inc.php";
            break;
        case"inscription-exec":
            include"views/recup-inscript.php";
            break;
        case "affiche-label-liste":
            include("views/label-liste.inc.php");
            break;
        case "affiche-label-unic":
            include("views/label-unic.inc.php");
            break;
        case "affiche-chanson-unic":
            include("views/chanson-unic.inc.php");
            break;
        case "affiche-chanson-liste":
            include("views/chanson-liste.inc.php");
            break;
        case "affiche-categorie-liste":
            include("views/categorie-liste.inc.php");
            break;
        case "affiche-album-liste":
            include("views/album-liste.inc.php");
            break;
        case "affiche-album-unic":
            include("views/album-unic.inc.php");
            break;
        case "affiche-artiste-liste":
            include("views/artiste-liste.inc.php");
            break;
        case "affiche-artiste-unic":
            include("views/artiste-unic.inc.php");
            break;
        case "search-form":
            include("views/searchform.inc.php");
            break;
        case "search-exec":
            include("views/search-exec.inc.php");
            break;
    }
//si personne ne nous a appelé c'est qu'on arrive pour la première fois. On affiche donc la page d'accueil
} else {
    //include("views/home-page-bootstrap.inc.php");
    include 'views/page-actu.php';
}
echo "</div>";
echo"</div>";
include 'views/footer-page-bootsrap.inc.php';
?>