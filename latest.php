<?php
ob_start();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
}

require 'api/get_latest.php';

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

        <div class="container view-container">
            <div class="row action-row no-gutters">
            <?php
                    foreach($mangas as $i=>$v) {
                        echo '<div class="col-md-3 col-6 mb-3">';
                        echo '<div class="card action-card';
                        if ($i+1 & 1) {
                            echo ' action-card-left';
                        }
                        echo '" onclick="location.href=\'view.php?q='.$v['secure_id'].'#headline\';">';
                        echo '<img src="'.$v['cover_img'].'">';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="col-md-3 col-6 mb-3 desc-card';
                        if (!($i+1 & 1)) {
                            echo ' action-p-right';
                        }
                        echo '">';
                        echo '<div class="desc-div">';
                        echo '<div>';
                        echo '<h5 class="title-latest">'.$v['title'].'</h5>';
                        echo '<p>';
                        echo $v['author_name'];
                        echo '<br>';
                        echo ucfirst(strtolower($v['status']));
                        echo '<br>';
                        echo 'Latest Chapter : '.$v['latest_chapter_name'];
                        echo '</p>';
                        echo '</div>';
                        echo '</div>';                        
                        echo '</div>';
                    }
                ?>
            </div>
            <div class="row flex align-items-center">
                <div class="col-12 col-md-2 offset-md-10">
                <?php
                    echo '<nav class="pg-nav">';
                    echo '<ul class="pagination">';

                    $range = 3; // Number of pages to show around the current page

                    // Previous button
                    if ($page > 1) {
                        echo '<li class="page-item page-navigator"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
                    } else {
                        echo '<li class="page-item page-navigator disabled"><a class="page-link">Prev</a></li>';
                    }

                    // Page buttons
                    $start = max(1, $page - $range);
                    $end = min($totalPages, $page + $range);

                    if ($start > 1) {
                        echo '<li class="page-item page-num"><a class="page-link" href="?page=1">1</a></li>';
                        if ($start > 2) {
                            echo '<li class="page-item page-num disabled"><a class="page-link">...</a></li>';
                        }
                    }

                    for ($i = $start; $i <= $end; $i++) {
                        if ($i == $page) {
                            echo '<li class="page-item page-num active"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        } else {
                            echo '<li class="page-item page-num"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        }
                    }

                    if ($end < $totalPages) {
                        if ($end < $totalPages - 1) {
                            echo '<li class="page-item page-num disabled"><a class="page-link">...</a></li>';
                        }
                        echo '<li class="page-item page-num"><a class="page-link" href="?page=' . $totalPages . '">' . $totalPages . '</a></li>';
                    }

                    // Next button
                    if ($page < $totalPages) {
                        echo '<li class="page-item page-navigator"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
                    } else {
                        echo '<li class="page-item page-navigator disabled"><a class="page-link">Next</a></li>';
                    }

                    echo '</ul>';
                    echo '</nav>';
                ?>
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