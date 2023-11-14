<?php

$http_origin = $_SERVER['HTTP_ORIGIN'];

$pkg = $_GET["pkg"];

if ($pkg != "") {
    if (is_dir("/var/www/pkgr.art/public/" . $pkg)) {
        header("Access-Control-Allow-Origin: $http_origin");
        
        $cnt = 0;
        $files = glob("/var/www/pkg_stats/" . $pkg . "-*");
        
        foreach ($files as $file) {
            if (is_file($file)) {
                $cnt = intval(file_get_contents($file));
            }
        }
        
        echo strval($cnt);
    }
}

?>