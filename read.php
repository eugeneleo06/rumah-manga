<?php

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
                       <button class="btn btn-select-chapter">PREVIOUS</button>
                    </div>
                    <div class="col-md-2 col-10">
                        <select class="form-control chapter-list" id="exampleFormControlSelect1">
                            <option value="" disabled selected>Chapter List</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-10 pt-4 pt-md-0">
                       <button class="btn btn-select-chapter">NEXT</button>
                    </div>
                </div>     
            </div>
            <div class="title-container" style="margin-top:0%;">
                <h1 class="read-title">Cardfight Vanguard</h1>
            </div>
        </div>

        <div class="read-section" id="read-section">
            <img src="img/example-page.jpg">
            <img src="img/example-page-2.jpg">
        </div>

        <div class="container-fluid">
            <div class="page-container">
                <div class="row justify-content-md-center justify-content-around">
                    <div class="col-md-2 col-10 pb-4 pb-md-0">
                    <button class="btn btn-select-chapter">PREVIOUS</button>
                    </div>
                    <div class="col-md-2 col-10">
                        <select class="form-control chapter-list" id="exampleFormControlSelect1">
                            <option value="" disabled selected>Chapter List</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-10 pt-4 pt-md-0">
                    <button class="btn btn-select-chapter">NEXT</button>
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
        </script>
    </div>