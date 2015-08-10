<?php

$hostname = "localhost";
$username = "filadmin";
$password = "123abc";

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
?>                                

