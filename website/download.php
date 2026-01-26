<?php

$pkg = $_GET["pkg"];
$ver = $_GET["ver"];
$mgk = $_GET["mgk"];

header("Access-Control-Allow-Origin: *");

if (($pkg != "") && ($ver != "") && ($mgk == "18966")) {
    if ((is_dir("/usr/local/www/arturo/packager/public/_packages/" . $pkg)) && 
        (is_dir("/usr/local/www/arturo/packager/public/_packages/" . $pkg . "/" . $ver))) {
        
        $db_path = '/usr/local/www/arturo/packager/shared/data/stats.db';
        $db = new SQLite3($db_path);
        
        $now = time();
        
        // Check if record exists
        $stmt = $db->prepare('
            SELECT download_count FROM download_stats 
            WHERE package = :package AND version = :version
        ');
        $stmt->bindValue(':package', $pkg, SQLITE3_TEXT);
        $stmt->bindValue(':version', $ver, SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);
        
        if ($row) {
            // Update existing record
            $cnt = $row['download_count'] + 1;
            
            $stmt = $db->prepare('
                UPDATE download_stats 
                SET download_count = download_count + 1,
                    last_download = :now
                WHERE package = :package AND version = :version
            ');
            $stmt->bindValue(':package', $pkg, SQLITE3_TEXT);
            $stmt->bindValue(':version', $ver, SQLITE3_TEXT);
            $stmt->bindValue(':now', $now, SQLITE3_INTEGER);
            $stmt->execute();
        } else {
            // Insert new record
            $cnt = 1;
            
            $stmt = $db->prepare('
                INSERT INTO download_stats 
                (package, version, download_count, first_download, last_download)
                VALUES (:package, :version, 1, :now, :now)
            ');
            $stmt->bindValue(':package', $pkg, SQLITE3_TEXT);
            $stmt->bindValue(':version', $ver, SQLITE3_TEXT);
            $stmt->bindValue(':now', $now, SQLITE3_INTEGER);
            $stmt->execute();
        }
        
        $db->close();
        
        echo $cnt;
    }
}

?>