<?php

$pkg = $_GET["pkg"];

if (($pkg != "") && ($ver != "")) {
    if ((is_dir("/var/www/pkgr.art/public/" . $pkg)) && 
        (is_dir("/var/www/pkgr.art/public/" . $pkg . "/" . $ver))) {
        
        $cnt = 0;
        $files = glob("/var/www/pkg_stats/" . $pkg . "-*");
        foreach ($files as $file) {
            if (is_file($file)) {
                $cnt = intval(file_get_contents($filename));
            }
        }
        
        echo strval($cnt);
    }
}

?>