<?php

ob_start();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['q'])) {
        $secure_id = $_GET['q'];
    }
}

require 'api/get_view.php';

require('layout/header.php');

$date = new DateTime($manga['modified_date']);
$formattedDate = $date->format('d F Y');

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

        <div class="view-container" id="headline">
            <div class="view-img-wrapper">
                <img src="<?php echo $manga['headline_img'];?>" class="w-100 view-img">
                <div class="overlay">
                    <div class="view-img-txt">
                        <h2><?php echo $manga['title'] ?></h2>
                        <h4><?php echo $manga['author_name'] ?></h4>
                        <h4><?php echo $manga['genre']?></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="container view-container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="col-12 detail-container" id="col1">
                        <span class="detail-span">Author : </span>
                        <span><?php echo $manga['author_name']?></span>
                        <br>
                        <span class="detail-span">Status : </span>
                        <span><?php echo ucfirst(strtolower($manga['status']))?></span>
                        <br>
                        <span class="detail-span">Genres : </span>
                        <span><?php echo $manga['genre']?></span>
                        <br>
                        <span class="detail-span">Updated : </span>
                        <span><?php echo $formattedDate?></span>
                        <br>
                        <span class="detail-span">First Chap : </span>
                        <span>Chapter 
                        <?php 
                        if (count($chapters) > 0) {
                            echo $chapters[0]['name'];
                        } else {
                            echo '-';
                        }  
                        ?>
                        </span>
                        <br>
                        <span class="detail-span">Latest Chap : </span>
                        <span>Chapter 
                        <?php 
                        if (count($chapters) > 0) {
                            echo $chapters[count($chapters)-1]['name'];
                        } else {
                            echo '-';
                        }  
                        ?>
                        </span>                    
                    </div>
                </div>
                <br>
                <div class="col-12 col-md-6">
                    <div class="col-12 synopsis-wrapper">
                        <div class="synopsis-container" id="col22">
                            SYNOPSIS
                        </div>
                        <div class="synopsis-detail" id="col2">
                            <?php echo $manga['synopsis'];?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container view-container">
            <div class="chapter-title">
                <h5>CHAPTERS</h5>
            </div>
            <div class="chapter-view-list">
                <?php
                foreach(array_reverse($chapters) as $chapter) {
                    $date = new DateTime($chapter['created_date']);
                    $formattedDate = $date->format('d F Y');
                    echo '<a class="chapter-anchor" href="read.php?q=';
                    echo $chapter['secure_id'];
                    echo '"><p>Chapter '.$chapter['name'].'<span>'.$formattedDate.'</span></p></a>';
                }
                ?>
            </div>
        </div>
        <?php
        require('layout/footer.php');
        ?>
        <script>            
            function matchColumnHeights() {
                var col1 = document.getElementById('col1');
                var col2 = document.getElementById('col2');
                var col22 = document.getElementById('col22');

                col2.style.height = col1.offsetHeight - col22.offsetHeight - 2 + 'px';
            }
            matchColumnHeights();
            window.onload = matchColumnHeights;
            window.onresize = matchColumnHeights;
        </script>
    </div>