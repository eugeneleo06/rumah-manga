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
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
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
                        echo '<div class="card" onclick="location.href=\'view.php?q='.$v['secure_id'].'#col1\';">';
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
            <div class="container">
                <div class="row">
                    <?php
                    foreach($mangas_action as $v) {
                        echo '<div class="col-12 col-md-6">';
                        echo '<div class="d-flex justify-content-center align-items-stretch" style="margin-bottom:2vh;">';
                        echo '<div class="card action-card"';
                        echo '" onclick="location.href=\'view.php?q='.$v['secure_id'].'#headline\';">';
                        echo '<img src="'.$v['cover_img'].'">';
                        echo '</div>';
                        echo '<div class="action-desc">';
                        echo '<h5 class="title-latest">'.$v['title'].'</h5>';
                        echo '<p class="action-p">';
                        echo $v['author_name'];
                        echo '<br>';
                        echo '<span style="font-weight:200;">'.ucfirst(strtolower($v['status'])).'</span>';
                        echo '<br>';
                        echo 'Latest Chapter : '.$v['latest_chapter_name'];
                        echo '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <?php
                foreach($ads as $ad) { 
                    
                    echo '<div class="col-4">';
                    echo '<img src="'.$ad['img_url'].'" class="w-100 ads-img" onclick="location.href=\''.$ad['url'].'\'">';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <?php
        require('layout/footer.php');
        ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const fadeLeft = document.querySelector('.fade-left');
        const fadeRight = document.querySelector('.fade-right');
        
        function checkScroll() {
            const triggerBottom = window.innerHeight / 5 * 4;
            const fadeLeftTop = fadeLeft.getBoundingClientRect().top;
            const fadeRightTop = fadeRight.getBoundingClientRect().top;
            
            if (fadeLeftTop < triggerBottom) {
            fadeLeft.classList.add('fade-in');
            }
            
            if (fadeRightTop < triggerBottom) {
            fadeRight.classList.add('fade-in');
            }
        }

        window.addEventListener('scroll', checkScroll);
        });
    </script>