<?php

include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try{
        $sql = 'SELECT * FROM ads WHERE id = 4'; // footer = id 4
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $ads = $stmt->fetch();

    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}