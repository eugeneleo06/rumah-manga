<?php

include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try{
        #MANGA LATEST
        $sql = 'SELECT m.* , a.name as author_name FROM mangas m
        LEFT JOIN authors a ON m.author_id = a.id 
        ORDER BY modified_date DESC LIMIT 4';
        $stmt = $db->query($sql);
        $mangas_latest = $stmt->fetchAll();

        #GENRE
        $sql = "SELECT id FROM genres g WHERE name='Action'";
        $stmt = $db->query($sql);
        $genreId = $stmt->fetchColumn();

        #ACTION
        $sql = "SELECT m.* , a.name as author_name, COALESCE(
                    (SELECT c1.name 
                    FROM chapters c1 
                    WHERE c1.manga_id = m.id 
                    ORDER BY CAST(SUBSTRING_INDEX(c1.name, ' - ', 1) AS UNSIGNED) DESC 
                    LIMIT 1), 
                    '-') AS latest_chapter_name 
        FROM mangas m 
        LEFT JOIN authors a ON m.author_id = a.id 
        WHERE JSON_CONTAINS(m.genres_id, '\"".$genreId."\"') 
        ORDER BY modified_date DESC LIMIT 2 ";
        $stmt = $db->query($sql);
        $mangas_action = $stmt->fetchAll();

        #ADS
        $sql = 'SELECT * FROM ads a WHERE id < 4 LIMIT 3'; // banner 1-2-3
        $stmt = $db->query($sql);
        $ads = $stmt->fetchAll();

    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}