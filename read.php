<?php

ob_start();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['q'])) {
        $secure_id = $_GET['q'];
    }
}

require 'api/get_read.php';

require('layout/header.php');
?>
<body class="bg-home">
    <div class="wrapper">
        <div class="container-fluid container-nav">
            <?php require('layout/navbar.php');?>
        </div>

        <div class="container-fluid">
            <div class="page-container">
                <div class="row justify-content-md-center justify-content-around">
                    <div class="col-md-2 col-10 pb-4 pb-md-0">
                        <?php 
                            if (!$isFirst) {
                                echo '<button class="btn btn-select-chapter" ';
                                echo 'onclick="location.href=\'read.php?q='.$prevSecureId.'\'"';
                                echo '>PREVIOUS</button>';
                            }
                        ?>
                    </div>
                    <div class="col-md-2 col-10">
                        <select class="form-control chapter-list" id="exampleFormControlSelect1" onchange="redirectToUrl(this)">
                            <?php
                                foreach($chapters as $c) {
                                    echo '<option ';
                                    if ($c['secure_id'] == $secure_id) {
                                        echo 'selected';
                                    }
                                    echo ' value="'.$c['secure_id'].'">Chapter '.$c['name'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 col-10 pt-4 pt-md-0">
                        <?php 
                            if (!$isLast) {
                                echo '<button class="btn btn-select-chapter" ';
                                echo 'onclick="location.href=\'read.php?q='.$nextSecureId.'\'"';
                                echo '>NEXT</button>';
                            }
                        ?>
                    </div>
                </div>     
            </div>
            <div class="title-container" style="margin-top:0%;">
                <h1 class="read-title"><a href="view.php?q=<?php echo $manga['secure_id']?>#headline"><?php echo $manga['title']?></a></h1>
            </div>
        </div>

        <div class="read-section" id="read-section">
            <?php 
                $imgs = json_decode($chapter['img_url']);
                foreach ($imgs as $img) {
                    echo '<img src="'.$img.'">';
                }
            ?>
        </div>

        <div class="container-fluid pb-5">
            <div class="page-container">
                <div class="row justify-content-md-center justify-content-around">
                    <div class="col-md-2 col-10 pb-4 pb-md-0">
                        <?php 
                            if (!$isFirst) {
                                echo '<button class="btn btn-select-chapter" ';
                                echo 'onclick="location.href=\'read.php?q='.$prevSecureId.'\'"';
                                echo '>PREVIOUS</button>';
                            }
                        ?>
                    </div>
                    <div class="col-md-2 col-10">
                        <select class="form-control chapter-list" id="exampleFormControlSelect1" onchange="redirectToUrl(this)">
                            <?php
                                foreach($chapters as $c) {
                                    echo '<option ';
                                    if ($c['secure_id'] == $secure_id) {
                                        echo 'selected';
                                    }
                                    echo ' value="'.$c['secure_id'].'">Chapter '.$c['name'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 col-10 pt-4 pt-md-0">
                        <?php 
                            if (!$isLast) {
                                echo '<button class="btn btn-select-chapter" ';
                                echo 'onclick="location.href=\'read.php?q='.$nextSecureId.'\'"';
                                echo '>NEXT</button>';
                            }
                        ?>
                    </div>
                </div>     
            </div>
       </div>
        <?php
        require('layout/footer.php');
        ?>
        <script>
            function checkWindowSize() {
                var sec = document.getElementById('read-section');
                var images = sec.getElementsByTagName('img');
                if (window.innerWidth < 576) {
                    sec.classList.add('container-fluid')
                    sec.style.backgroundColor = 'transparent';
                    for (var i = 0; i < images.length; i++) {
                        images[i].style.width = '100%';
                    }
                } else {
                    sec.classList.remove('container-fluid');
                    sec.style.backgroundColor = 'black'
                    for (var i = 0; i < images.length; i++) {
                        images[i].style.width = '85%';
                    }
                }
            }

            // Initial check
            checkWindowSize();

            // Check window size on resize
            window.addEventListener('resize', checkWindowSize);

            function redirectToUrl(selectElement) {
                console.log('a');
                var url = selectElement.value;
                if (url) {
                    window.location.href = 'read.php?q=' + url;
                }
            }


        </script>
    </div>