<?php

require('layout/header.php');
?>
<body class="bg-home">
    <div class="wrapper">
        <div class="container-fluid container-nav">
            <?php require('layout/navbar.php');?>

            <div class="marquee-container">
                <div class="marquee">
                    <img src="https://via.placeholder.com/2000x100" alt="Marquee Image">
                    <img src="https://via.placeholder.com/2000x100" alt="Marquee Image">
                </div>
            </div>
        </div>

        <div class="container-fluid view-container">
            <div class="view-img-wrapper">
                <img src="https://wallpapercave.com/wp/wp12422995.jpg" class="w-100 view-img" title="lol">
                <div class="overlay">
                    <div class="view-img-txt">
                        Title<br>Author<br>Genre
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid view-container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="col-12 detail-container">
                        <span class="detail-span">Author : </span>
                        <span>Rose</span>
                        <br>
                        <span class="detail-span">Status : </span>
                        <span>Ongoing</span>
                        <br>
                        <span class="detail-span">Genres : </span>
                        <span>Action - Romance</span>
                        <br>
                        <span class="detail-span">Updated : </span>
                        <span>12 June 2024</span>
                        <br>
                        <span class="detail-span">First Chap: </span>
                        <span>Chapter 1</span>
                        <br>
                        <span class="detail-span">Latest Chap: </span>
                        <span>Chapter 19</span>
                    </div>
                </div>
                <br>
                <div class="col-12 col-md-6">
                    <div class="col-12 synopsis-wrapper">
                        <div class="synopsis-container">
                            SYNOPSIS
                        </div>
                        <div class="synopsis-detail">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, suscipit alias quam modi ab vero voluptates repellat. Illum deserunt laudantium reprehenderit, neque repellendus modi dignissimos fugit ratione laboriosam hic quae.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid view-container">
            <div class="chapter-title">
                <h5>CHAPTERS</h5>
            </div>
            <div class="chapter-view-list">
                <p>Chapter 1<span>12 June 2024</span></p>
            </div>
        </div>
        <?php
        require('layout/footer.php');
        ?>
    </div>