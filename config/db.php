<?php 
    try {
        $db = new PDO('sqlite:'.$path);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

