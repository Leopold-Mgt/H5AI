<?php

function explorer($chemin){
    $lstat    = lstat($chemin);
    $mtime    = date('d/m/Y H:i:s', $lstat['mtime']);
    $filetype = filetype($chemin);

    // Affichage des infos sur le fichier $chemin
    echo "$chemin   type: $filetype size: $lstat[size]  mtime: $mtime\n";

    // Si $chemin est un dossier => on appelle la fonction explorer() pour chaque élément (fichier ou dossier) du dossier$chemin
    if( is_dir($chemin) ){
        $me = opendir($chemin);
        while( $child = readdir($me) ){
            if( $child != '.' && $child != '..' ){
                explorer( $chemin.DIRECTORY_SEPARATOR.$child );
            }
        }
    }
}

header('Content-type: text/plain');
explorer(dirname(__FILE__));