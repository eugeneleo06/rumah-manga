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
        $sql = "SELECT m.* , a.name as author_name, COALESCE(c.name, '-') AS latest_chapter_name
        FROM mangas m
        LEFT JOIN authors a ON m.author_id = a.id 
        LEFT JOIN (
            SELECT c1.manga_id, c1.name
            FROM chapters c1
            INNER JOIN (
                    SELECT manga_id, MAX(created_date) AS latest_created_date
                    FROM chapters
                    GROUP BY manga_id
                ) c2 ON c1.manga_id = c2.manga_id AND c1.created_date = c2.latest_created_date
            ) c ON m.id = c.manga_id
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