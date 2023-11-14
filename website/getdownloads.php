<?php

$pkg = $_GET["pkg"];

if ($pkg != "") {
    if (is_dir("/var/www/pkgr.art/public/" . $pkg)) {
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