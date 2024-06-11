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
                <div class="row justify-content-center">
                    <div class="col-2">
                       <button class="btn btn-select-chapter">PREVIOUS</button>
                    </div>
                    <div class="col-2">
                        <select class="form-control chapter-list" id="exampleFormControlSelect1">
                            <option value="" disabled selected>Chapter List</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-2">
                       <button class="btn btn-select-chapter">NEXT</button>
                    </div>
                </div>     
            </div>
            <div class="title-container" style="margin-top:0%;">
                <h1 class="read-title">Cardfight Vanguard</h1>
            </div>
        </div>

        <div class="container-fluid read-section">
            <img src="img/example-page.jpg">
            <img src="img/example-page-2.jpg">
        </div>

        <div class="container-fluid">
            <div class="page-container">
                <div class="row justify-content-center">
                    <div class="col-2">
                       <button class="btn btn-select-chapter">PREVIOUS</button>
                    </div>
                    <div class="col-2">
                        <select class="form-control chapter-list" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="col-2">
                       <button class="btn btn-select-chapter">NEXT</button>
                    </div>
                </div>     
            </div>
       </div>
        <?php
        require('layout/footer.php');
        ?>
    </div>