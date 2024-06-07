<?php

require('layout/header.php');
?>
<body class="bg-home">
    <div class="container-fluid container-nav">
        <?php require('layout/navbar.php');?>

        <div class="marquee-container">
            <div class="marquee">
                <img src="https://via.placeholder.com/2000x100" alt="Marquee Image">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="title-container">
            <h1>LATEST UPDATES</h1>
        </div>
        <div class="card-container">
            <div class="card">
                <img src="https://via.placeholder.com/150" alt="Image 1">
                <div class="description">Description for Image 1</div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/150" alt="Image 2">
                <div class="description">Description for Image 2</div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/150" alt="Image 3">
                <div class="description">Description for Image 3</div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/150" alt="Image 4">
                <div class="description">Description for Image 4</div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/150" alt="Image 5">
                <div class="description">Description for Image 5</div>
            </div>
        </div>

        <div class="title-container">
            <h1>ACTION MANGA</h1>
        </div>
    </div>
<?php
require('layout/footer.php');
?>