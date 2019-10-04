<?php

function init()
{
    $path_folder = "";
    if ($_GET !== "") {
        $path_folder = implode($_GET);
    }
    display('/var/www/html/' . $path_folder);
    tree('/var/www/html/');
    explorer('/var/www/html/' . $path_folder);
}

function display($path)
{
    $url = $_SERVER['REQUEST_URI'];
    $path = str_replace('/', '<span> › </span>', $path);

    echo "<header><div class='header'><h1><i class=\"fas fa-atlas\"></i> H5AI</h1>";

    if ($url !== '/my_h5ai/') {
        echo "<nav><a href=''><i class=\"fas fa-arrow-alt-circle-left\"></i></a><a><i class=\"fas fa-arrow-alt-circle-right\"></i></a></nav>";
    } else {
        echo "<nav><a href='./'><i class=\"fas fa-arrow-alt-circle-left\"></i></a><a><i class=\"fas fa-arrow-alt-circle-right\"></i></a></nav>";
    }

    echo "<p>$path</p><div class='colors'><div class='blue'></div><div class='pink'></div><div class='orange'></div></div></div>";
    echo "<form action=''><input class='search' type='text'/><input class='submit' type='submit' value=''/><i class=\"fas fa-search\"></i></form></header>";
}

function tree($path)
{
    $arr_folders = array();
    $handle = opendir($path);
    $path_prefix = ($path === ".") ? "" : $path . "/";

    while ($folder = readdir($handle)) {
        if (substr($folder, 0, 1) === ".") {
            continue;
        }
        $folder = $path_prefix . $folder;
        if (is_dir($folder) && $handle) {
            $folder = substr($folder, 15);
            $subdir_content = tree($folder);
            array_push($arr_folders, $folder);
            $arr_folders = array_merge($arr_folders, $subdir_content);
        }
    }

//    while ($folder = readdir($handle)) {
//        if (substr($folder, 0, 1) !== ".") {
//            array_push($arr_folders, $folder);
//        }
//    }

    closedir($handle);
    display_tree($arr_folders);
    return ($arr_folders);
}

function display_tree($arr_folder)
{
    natcasesort($arr_folder);

    echo "<div class='container'><table class='tree'>";

    foreach ($arr_folder as $folder) {
        echo "<tr><td class='folder'><a href='$folder'><i class=\"fas fa-caret-right firstlvl\"></i><i class='fas fa-folder'></i> $folder </a></td></tr>";
    }
}

function explorer($path)
{
    $arr_files = array();
    $handle = opendir($path);

    while ($file = readdir($handle)) {
        if (substr($file, 0, 1) !== ".") {
            array_push($arr_files, $file);
        }
    }

    closedir($handle);
    display_explorer($path, $arr_files);
    return ($arr_files);
}

function display_explorer($path, $arr_files)
{
    $url = $_SERVER['REQUEST_URI'];
    natcasesort($arr_files);

    echo "</table>";
    echo "<table class='explorer'><tr><th>Name</th><th>Size</th><th>Last modified</th></tr>";

    foreach ($arr_files as $file) {
        if (strpos($url . $file . "/", ".") === false) {
            $file_icon = "fas fa-folder";
        } else if (substr($file, -4, 4) === ".sql") {
            $file_icon = "fas fa-database";
        } else if (substr($file, -5, 5) === ".html") {
            $file_icon = "fab fa-html5";
        } else if (substr($file, -4, 4) === ".css") {
            $file_icon = "fab fa-css3";
        } else if (substr($file, -4, 4) === ".php") {
            $file_icon = "fab fa-php";
        } else if (substr($file, -3, 3) === ".js") {
            $file_icon = "fab fa-js-square";
        } else if (substr($file, -4, 4) === ".png" || substr($file, -4, 4) === ".jpg") {
            $file_icon = "far fa-file-image";
        }  else if (substr($file, -4, 4) === ".ttf") {
            $file_icon = "fas fa-font";
        } else {
            $file_icon = "far fa-file";
        }
        echo "<tr><td><a href='$url/$file'><i class='$file_icon'></i> $file </a></td>";
        echo "<td class='table_data'>" . filesize($path . $file) . " octets</td>";
        echo "<td class='table_data'>" . date('F d Y, H:i', filemtime($path . $file)) . "</td></tr>";
    }
    echo "</table></div>";
}

init();