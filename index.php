<?php

ob_start();
session_start();

require 'api/get_index.php';

require('layout/header.php');
?>
<body class="bg-home">
    <div class="wrapper">
        <div class="container-fluid container-nav">
            <?php require('layout/navbar.php');?>

            <div class="marquee-container">
                <div class="marquee">
                    <img src="img/marquee.png" alt="Marquee Image">
                    <img src="img/marquee.png" alt="Marquee Image">
                    <img src="img/marquee.png" alt="Marquee Image">
                    <img src="img/marquee.png" alt="Marquee Image">
                    <img src="img/marquee.png" alt="Marquee Image">
                    <img src="img/marquee.png" alt="Marquee Image">
                    <img src="img/marquee.png" alt="Marquee Image">
                    <img src="img/marquee.png" alt="Marquee Image">
                    <img src="img/marquee.png" alt="Marquee Image">
                    <img src="img/marquee.png" alt="Marquee Image">
                </div>
            </div>
        </div>

        <div class="container">
            <div class="title-container">
                <h1>LATEST UPDATES</h1>
            </div>
            <div class="card-container">
                <?php 
                    foreach($mangas_latest as $v) {
                        echo '<div class="card" onclick="location.href=\'view.php?q='.$v['secure_id'].'#headline\';">';
                        echo '<img src="'.$v['cover_img'].'">';
                        echo '<div class="description">';
                        echo '<p>';
                        echo '<span class="title-latest">'.$v['title'].'</span>';
                        echo '<br>';
                        echo $v['author_name'];
                        echo '<br>';
                        echo ucfirst(strtolower($v['status']));
                        echo '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>

            <div class="title-container">
                <h1>ACTION MANGA</h1>
            </div>
            <div class="row action-row no-gutters">
                <?php
                    foreach($mangas_action as $i=>$v) {
                        echo '<div class="col-md-3 col-6 mt-3">';
                        echo '<div class="card action-card';
                        if ($i+1 & 1) {
                            echo ' action-card-left';
                        }
                        echo '" onclick="location.href=\'view.php?q='.$v['secure_id'].'#headline\';">';
                        echo '<img src="'.$v['cover_img'].'">';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="col-md-3 col-6 mt-3 desc-card';
                        if (!($i+1 & 1)) {
                            echo ' action-p-right';
                        }
                        echo '">';
                        echo '<h5 class="title-latest">'.$v['title'].'</h5>';
                        echo '<p>';
                        echo $v['author_name'];
                        echo '<br>';
                        echo ucfirst(strtolower($v['status']));
                        echo '<br>';
                        echo 'Latest Chapter : '.$v['latest_chapter_name'];
                        echo '</p>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
        <?php
        require('layout/footer.php');
        ?>
    </div>