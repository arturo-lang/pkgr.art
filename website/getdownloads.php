<?php

$http_origin = $_SERVER['HTTP_ORIGIN'] ?? '*';

$pkg = $_GET["pkg"];

if ($pkg != "") {
    if (is_dir("/usr/local/www/arturo/packager/public/_packages/" . $pkg)) {
        header("Access-Control-Allow-Origin: $http_origin");

        $db_path = '/usr/local/www/arturo/packager/shared/data/stats.db';
        $db = new SQLite3($db_path);
        
        $cnt = 0;
        
        if (isset($_GET["ver"])){
            // Get downloads for specific version
            $ver = str_replace("_", ".", $_GET["ver"]);
            
            $stmt = $db->prepare('
                SELECT download_count FROM download_stats 
                WHERE package = :package AND version = :version
            ');
            $stmt->bindValue(':package', $pkg, SQLITE3_TEXT);
            $stmt->bindValue(':version', $ver, SQLITE3_TEXT);
            $result = $stmt->execute();
            $row = $result->fetchArray(SQLITE3_ASSOC);
            
            if ($row) {
                $cnt = $row['download_count'];
            }
        } else {
            // Get total downloads for all versions of package
            $stmt = $db->prepare('
                SELECT SUM(download_count) as total 
                FROM download_stats 
                WHERE package = :package
            ');
            $stmt->bindValue(':package', $pkg, SQLITE3_TEXT);
            $result = $stmt->execute();
            $row = $result->fetchArray(SQLITE3_ASSOC);
            
            if ($row) {
                $cnt = intval($row['total']);
            }
        }
        
        $db->close();
        
        echo strval($cnt);
    }
}

?>