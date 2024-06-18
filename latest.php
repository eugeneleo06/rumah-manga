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

        <div class="container view-container">
            <div class="row action-row">
                <div class="col-md-3 col-6 pt-3">
                    <div class="card action-card">
                        <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev//882724ca-2505-11ef-bc4d-7bcd02043035.jpg" alt="Image 4">
                    </div>            
                </div>
                <div class="col-md-3 col-6 pt-3">
                    Description
                </div>
                <div class="col-md-3 col-6 pt-3">
                    <div class="card action-card">
                        <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev//882724ca-2505-11ef-bc4d-7bcd02043035.jpg" alt="Image 4">
                    </div>            
                </div>
                <div class="col-md-3 col-6 pt-3">
                    Description
                </div>
                <div class="col-md-3 col-6 pt-3">
                    <div class="card action-card">
                        <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev//882724ca-2505-11ef-bc4d-7bcd02043035.jpg" alt="Image 4">
                    </div>            
                </div>
                <div class="col-md-3 col-6 pt-3">
                    Description
                </div>
                <div class="col-md-3 col-6 pt-3">
                    <div class="card action-card">
                        <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev//882724ca-2505-11ef-bc4d-7bcd02043035.jpg" alt="Image 4">
                    </div>            
                </div>
                <div class="col-md-3 col-6 pt-3">
                    Description
                </div>
            </div>
        </div>

        <?php
        require('layout/footer.php');
        ?>

        <script>
           function toggleFilter(element) {
                const filterName = element.getAttribute('data-filter');
                const hiddenInput = document.getElementById(`filter-${filterName}`);
                
                if (element.classList.contains('included')) {
                    element.classList.remove('included');
                    element.classList.add('excluded');
                    element.querySelector('i').className = 'fas fa-times-circle';
                    hiddenInput.value = 'excluded';
                } else if (element.classList.contains('excluded')) {
                    element.classList.remove('excluded');
                    element.querySelector('i').className = 'fas fa-circle';
                    hiddenInput.value = 'neutral';
                } else {
                    element.classList.add('included');
                    element.querySelector('i').className = 'fas fa-check-circle';
                    hiddenInput.value = 'included';
                }
            }
        </script>
    </div>