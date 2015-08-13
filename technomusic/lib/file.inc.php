<?php

$hostname = "localhost";
$dbname = "technomusic";
$username = "test";
$password = "test1234";

function clean($str, $charset = 'utf-8') {
    $str = htmlentities($str, ENT_NOQUOTES, $charset);
    $str = preg_replace('#\&([A-za-z])(?:acute|cedil|circ|grave|ring|tilde|uml)\;#', '\1', $str);
    $str = preg_replace('#\&([A-za-z]{2})(?:lig)\;#', '\1', $str);
    $str = preg_replace('#\&[^;]+\;#', '', $str);
    return $str;
}

function get_unique_filename($prefix, $str, $ext = ".xml", $separateur = "_") {
    $date = date("d-m-Y-H-i-s");
    $id = md5(uniqid(rand(), true));
    $file = $prefix . $date . $separateur . $id . $separateur . $str . "." . $ext;
    //echo $file;
    return $file;
}

// © Jérome Réaux : http://j-reaux.developpez.com - http://www.jerome-reaux-creations.fr
// ---------------------------------------------------
// Fonction de redimensionnement A L'AFFICHAGE
// ---------------------------------------------------
// La FONCTION : fctaffichimage($img_Src, $W_max, $H_max)
// Les paramètres :
// - $img_Src : URL (chemin + NOM) de l'image Source
// - $W_max : LARGEUR maxi finale ----> ou 0 : largeur libre
// - $H_max : HAUTEUR maxi finale ----> ou 0 : hauteur libre
// ---------------------
// Affiche : src="..." width="..." height="..." pour la balise img
// Utilisation :
// &lt;img alt=&quot;&quot; &lt;?php fctaffichimage('repimg/monimage.jpg', 120, 100) ?&gt; /&gt;
// ---------------------------------------------------
function fctaffichimage($img_Src, $W_max, $H_max) {

    if (file_exists($img_Src)) {
        // ---------------------
        // Lit les dimensions de l'image source
        $img_size = getimagesize($img_Src);
        $W_Src = $img_size[0]; // largeur source
        $H_Src = $img_size[1]; // hauteur source
        // ---------------------
        if (!$W_max) {
            $W_max = 0;
        }
        if (!$H_max) {
            $H_max = 0;
        }
        // ---------------------
        // Teste les dimensions tenant dans la zone
        $W_test = round($W_Src * ($H_max / $H_Src));
        $H_test = round($H_Src * ($W_max / $W_Src));
        // ---------------------
        // si l'image est plus petite que la zone
        if ($W_Src < $W_max && $H_Src < $H_max) {
            $W = $W_Src;
            $H = $H_Src;
            // sinon si $W_max et $H_max non definis
        } elseif ($W_max == 0 && $H_max == 0) {
            $W = $W_Src;
            $H = $H_Src;
            // sinon si $W_max libre
        } elseif ($W_max == 0) {
            $W = $W_test;
            $H = $H_max;
            // sinon si $H_max libre
        } elseif ($H_max == 0) {
            $W = $W_max;
            $H = $H_test;
            // sinon les dimensions qui tiennent dans la zone
        } elseif ($H_test > $H_max) {
            $W = $W_test;
            $H = $H_max;
        } else {
            $W = $W_max;
            $H = $H_test;
        }
        // ---------------------
    } else { // si le fichier image n existe pas
        $W = 0;
        $H = 0;
    }
    // ---------------------------------------------------
    // Affiche : src="..." width="..." height="..." pour la balise img
    echo ' src="' . $img_Src . '" width="' . $W . '" height="' . $H . '"';
    // ---------------------------------------------------
}

;
?>                                

