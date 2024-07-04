<?php

include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try{
        $isFirst = false;
        $isLast = false;
        $nextSecureId = "";
        $prevSecureId = "";
        $currentIndex = "";

        $sql = 'SELECT * FROM chapters WHERE secure_id = :secure_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':secure_id', $secure_id, PDO::PARAM_STR);
        $stmt->execute();
        $chapter = $stmt->fetch();
        
        $sql = 'SELECT * FROM mangas m WHERE id = :manga_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':manga_id', $chapter['manga_id'], PDO::PARAM_STR);
        $stmt->execute();
        $manga = $stmt->fetch();

        $sql = "SELECT * FROM chapters c WHERE manga_id = :manga_id ORDER BY CAST(SUBSTRING_INDEX(c.name, ' - ', 1) AS UNSIGNED) DESC ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':manga_id', $chapter['manga_id'], PDO::PARAM_STR);
        $stmt->execute();
        $chapters = $stmt->fetchAll();

        if ($secure_id == $chapters[0]['secure_id']) {
            $isLast = true;
        }
        if ($secure_id == $chapters[count($chapters)-1]['secure_id']) {
            $isFirst = true;
        }

        foreach($chapters as $i=>$c) {
            if ($c['secure_id'] == $secure_id) {
                $currentIndex = $i;
            }
        }

        if (!$isFirst) {
            $prevSecureId = $chapters[$currentIndex+1]['secure_id'];
        }
        if (!$isLast) {
            $nextSecureId = $chapters[$currentIndex-1]['secure_id'];
        }

    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}