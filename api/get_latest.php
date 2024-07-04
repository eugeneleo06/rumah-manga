<?php

include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try{
        $pageSize = 4;
        $query = "";
        if(isset($page)) {
            $val = ($page - 1) * $pageSize; 
            $query = "OFFSET ".$val;
        }
        $sql = "SELECT m.* , a.name as author_name, COALESCE(
                    (SELECT c1.name 
                    FROM chapters c1 
                    WHERE c1.manga_id = m.id 
                    ORDER BY CAST(SUBSTRING_INDEX(c1.name, ' - ', 1) AS UNSIGNED) DESC 
                    LIMIT 1), 
                    '-') AS latest_chapter_name 
        FROM mangas m
        LEFT JOIN authors a ON m.author_id = a.id 
        ORDER BY modified_date DESC LIMIT 4 ".$query;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $mangas = $stmt->fetchAll();

        $sql = "SELECT count(*) FROM mangas";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $totalRecords = $stmt->fetchColumn();
        $totalPages = ceil($totalRecords / $pageSize);

    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}