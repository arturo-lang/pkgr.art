<?php

$pkg = $_GET["pkg"];
$ver = $_GET["ver"];
$mgk = $_GET["mgk"];

header("Access-Control-Allow-Origin: *");

if (($pkg != "") && ($ver != "") && ($mgk == "18966")) {
    if ((is_dir("/var/www/pkgr.art/public/" . $pkg)) && 
        (is_dir("/var/www/pkgr.art/public/" . $pkg . "/" . $ver))) {
        $filename = "/var/www/pkg_stats/" . $pkg . "-" . $ver . ".cnt";
        $cnt = 0;
        if (file_exists($filename)){
            $cnt = intval(file_get_contents($filename));
        }
        else {
            touch($filename);
            chmod($filename, 0777);
        }
        $cnt = $cnt + 1;

        $openFile = fopen($filename, "w+") or die("Can't open file");
        fwrite($openFile, strval($cnt));
        fclose($openFile);

        echo $cnt;  
    }
}

?>