<?php

spl_autoload_register('myAutoloader');

function myAutoloader($className){

    $path = "classes/controllers/";
    $extension = ".class.php";

    $fullPath =  $path . $className . $extension;

    if (!file_exists($fullPath)) {
        $path = "classes/Models/";

        $fullPath = $path . $className . $extension;
    }
    
    include_once $fullPath;

}
?>