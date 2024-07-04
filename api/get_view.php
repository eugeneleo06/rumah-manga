<?php

include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try{
        $sql = 'SELECT *, a.name as author_name FROM mangas m
         LEFT JOIN authors a ON a.id = m.author_id
         WHERE m.secure_id = :secure_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':secure_id', $secure_id, PDO::PARAM_STR);
        $stmt->execute();
        $manga = $stmt->fetch();

        # GET GENRE
        $genreIds = json_decode($manga['genres_id']);
        $genreNames = array();
        foreach ($genreIds as $genreId) {
            $sql = "SELECT name FROM genres WHERE id = ".$genreId;
            $stmt = $db->query($sql);
            $genre = $stmt->fetchColumn();
            if ($genre) {
                $genreNames[] = $genre;
            }
        }
        $genreNamesCombined = implode(" - ", $genreNames);
        $manga['genre'] = $genreNamesCombined;
        var_dump($manga['id']);
        # GET CHAPTER
        $sql = 'SELECT * FROM chapters c WHERE c.manga_id = :manga_id ORDER BY created_date ASC';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':manga_id', $manga['id'], PDO::PARAM_STR);
        $stmt->execute();
        $chapters = $stmt->fetchAll();
        var_dump($stmt);
        var_dump($chapters);

    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}