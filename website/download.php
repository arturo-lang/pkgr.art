<?php

$pkg = $_GET["pkg"];
$ver = $_GET["version"];

$filename = "../../" . $pkg . "-" . $ver . ".cnt";

$cnt = 0;
if (file_exists($filename)){
    $cnt = intval(file_get_contents($filename));
}
$cnt = $cnt + 1;

file_put_contents($cnt, $filename);

?>