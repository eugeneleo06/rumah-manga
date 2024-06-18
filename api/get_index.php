<?php

include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try{
        $sql = 'SELECT m.* , a.name as author_name FROM mangas m
        LEFT JOIN authors a ON m.author_id = a.id 
        ORDER BY modified_date DESC LIMIT 5 ';
        $stmt = $db->query($sql);
        $mangas_latest = $stmt->fetchAll();

        $sql = "SELECT id FROM genres g WHERE name='Action'";
        $stmt = $db->query($sql);
        $genreId = $stmt->fetchColumn();

        $sql = "SELECT m.* , a.name as author_name FROM mangas m
        LEFT JOIN authors a ON m.author_id = a.id 
        WHERE JSON_CONTAINS(m.genres_id, '\"".$genreId."\"') 
        ORDER BY modified_date DESC LIMIT 2 ";
        $stmt = $db->query($sql);
        $mangas_action = $stmt->fetchAll();
    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}