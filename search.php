<?php

ob_start();
session_start();

include('config/db.php');

function addOrUpdateQueryParam($param, $value) {
    $queryParams = $_GET;
    $queryParams[$param] = $value;
    return '?' . http_build_query($queryParams);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try{
        $pageSize = 4;
        $offsetQuery = "";
        $status = 1;
        $order = 1;
        $page = 1;

        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            $val = ($page - 1) * $pageSize; 
            $offsetQuery = "OFFSET ".$val;
        }
        if(isset($_GET['filters'])) {
            $filters = $_GET['filters'];
        }

        $includedGenres = [];
        $excludedGenres = [];
        $orderQuery = "";
        $whereQuery = "";

        if (isset($filters)) {
            foreach ($filters as $genre => $value) {
                if ($value == 'included') {
                    $includedGenres[] = $genre;
                } elseif ($value == 'excluded') {
                    $excludedGenres[] = $genre;
                }
            }
        }

        if(isset($_GET['status'])) { 
            $status = $_GET['status'];
        }

        if(isset($_GET['search'])) { 
            $search = $_GET['search'];
        }

        if(isset($_GET['order'])) { 
            $order = $_GET['order'];
        }

        if ($status == 2) {
            $whereQuery .= ' AND status = "ONGOING"';
        } else if ($status == 3) {
            $whereQuery .= ' AND status = "COMPLETED"';
        }

        if (isset($search) && $search !=  '') {
            $whereQuery .= " AND ( m.title LIKE '%".$search."%' OR a.name LIKE '%".$search."%' ) ";
        }

        if (!empty($includedGenres)) {
            $includedGenresList = implode("','", $includedGenres);
            $sql = "SELECT id FROM genres WHERE name IN ('$includedGenresList')";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
    
            foreach($result as $res) {
                $includedGenreIDs[] = $res['id'];
            }
        }
    
        if (!empty($excludedGenres)) {
            $excludedGenresList = implode("','", $excludedGenres);
            $sql = "SELECT id FROM genres WHERE name IN ('$excludedGenresList')";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();

            foreach($result as $res) {
                $excludedGenreIDs[] = $res['id'];
            }
        }

        if (!empty($includedGenreIDs) || !empty($excludedGenreIDs)) {
            if (!empty($includedGenreIDs)) {
                foreach ($includedGenreIDs as $id) {
                    $whereQuery .= " AND  JSON_CONTAINS(m.genres_id, '\"$id\"')";
                }
            }
    
            if (!empty($excludedGenreIDs)) {
                foreach ($excludedGenreIDs as $id) {
                    $whereQuery .= " AND NOT JSON_CONTAINS(m.genres_id, '\"$id\"')";
                }
            }
        }

        if ($order == 1) {
            $orderQuery = " m.modified_date DESC";
        } else if ($order == 2) { 
            $orderQuery = " m.created_date DESC";
        } else if ($order == 3) {
            $orderQuery = " m.title ASC";
        }

        $sql = "SELECT *, m.secure_id as secure_id, a.name as author_name, COALESCE(c.name, '-') AS latest_chapter_name FROM mangas m 
         LEFT JOIN authors a ON a.id = m.author_id 
         LEFT JOIN (
            SELECT c1.manga_id, c1.name
            FROM chapters c1
            INNER JOIN (
                    SELECT manga_id, MAX(created_date) AS latest_created_date
                    FROM chapters
                    GROUP BY manga_id
                ) c2 ON c1.manga_id = c2.manga_id AND c1.created_date = c2.latest_created_date
            ) c ON m.id = c.manga_id  
         WHERE 1 = 1 ".$whereQuery." ORDER BY ".$orderQuery." LIMIT ".$pageSize." ".$offsetQuery;
        
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $mangas = $stmt->fetchAll();

        $sql = "SELECT COUNT(*) FROM mangas m 
        LEFT JOIN authors a ON a.id = m.author_id 
        LEFT JOIN (
           SELECT c1.manga_id, c1.name
           FROM chapters c1
           INNER JOIN (
                   SELECT manga_id, MAX(created_date) AS latest_created_date
                   FROM chapters
                   GROUP BY manga_id
               ) c2 ON c1.manga_id = c2.manga_id AND c1.created_date = c2.latest_created_date
           ) c ON m.id = c.manga_id  
        WHERE 1 = 1 ".$whereQuery." ORDER BY ".$orderQuery;
       
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $totalRecords = $stmt->fetchColumn();

        $totalPages = ceil($totalRecords / $pageSize);

        $sql = "SELECT * FROM genres";
       
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $genres = $stmt->fetchAll();

    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}

require('layout/header.php');
?>
<body class="bg-home">
    <div class="wrapper">
        <div class="container-fluid container-nav">
            <?php require('layout/navbar.php');?>

            <div class="marquee-container">
                <div class="marquee">
                    <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-4c611765f21e41988e62321652b5623f.r2.dev/img/marquee.png" alt="Marquee Image">
                </div>
            </div>
        </div>

        <br> <br>

        <div class="container">
            <div class="search-container">
                <div class="row">
                    <div class="col-5">
                        <h5 style="margin-bottom:0">Advanced Search (filters)</h5>
                    </div>
                    <div class="col-1 offset-6 align-self-end">
                        <i class="fas fa-lg fa-plus-square minimize-icn" data-toggle="collapse" data-target="#dropdownContainer" aria-expanded="false" aria-controls="dropdownContainer"></i>
                    </div>
                </div>
                <div class="collapse mt-3" id="dropdownContainer">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <label>Genres:</label>
                                <div class="filter d-flex flex-wrap">
                                    <?php
                                        foreach($genres as $genre) {
                                            echo '<div class="filter-item btn btn-outline-secondary mr-2 ';
                                            if (isset($_GET['filters'][$genre['name']])) {
                                                $filter = $_GET['filters'][$genre['name']];
                                                if ($filter == 'excluded') {
                                                    echo 'excluded';
                                                } else if ($filter == 'included') {
                                                    echo 'included';
                                                }
                                            }
                                            echo '" onclick="toggleFilter(this)" data-filter="';
                                            echo $genre['name'];
                                            echo '">';
                                            echo '<i class="fas ';
                                            if (isset($_GET['filters'][$genre['name']])) {
                                                $filter = $_GET['filters'][$genre['name']];
                                                if ($filter == "neutral") {
                                                    echo 'fa-circle';
                                                } else if ($filter == 'excluded') {
                                                    echo 'fa-times-circle';
                                                } else if ($filter == 'included') {
                                                    echo 'fa-check-circle';
                                                }
                                            } else {
                                                echo 'fa-circle';
                                            }
                                            echo '"></i> '. $genre['name'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 pt-1">
                                <label>Order by: </label>
                                <select class="form-control" name="order">
                                    <option value="1" 
                                    <?php
                                       if(isset($_GET['order']) && $_GET['order'] == 1) {
                                        echo 'selected';
                                       }
                                    ?>
                                    >Latest Updates</option>
                                    <option value="2" 
                                    <?php
                                       if(isset($_GET['order']) && $_GET['order'] == 2) {
                                        echo 'selected';
                                       }
                                    ?>
                                    >New Manga</option>
                                    <option value="3" 
                                    <?php
                                       if(isset($_GET['order']) && $_GET['order'] == 3) {
                                        echo 'selected';
                                       }
                                    ?>
                                    >A-Z</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 pt-1">
                                <label>Status:</label>
                                <select class="form-control" name="status">
                                    <option value="1" 
                                    <?php
                                       if(isset($_GET['status']) && $_GET['status'] == 1) {
                                        echo 'selected';
                                       }
                                    ?>
                                    >Ongoing and Complete</option>
                                    <option value="2" 
                                    <?php
                                       if(isset($_GET['status']) && $_GET['status'] == 2) {
                                        echo 'selected';
                                       }
                                    ?>
                                    >Ongoing</option>
                                    <option value="3" 
                                    <?php
                                       if(isset($_GET['status']) && $_GET['status'] == 3) {
                                        echo 'selected';
                                       }
                                    ?>
                                    >Complete</option>
                                </select>
                            </div>
                            <div class="col-12 pt-1">
                                <label>Search:</label>
                                <input type="text" class="form-control" name="search" value="<?php
                                    if (isset($_GET['search'])) {
                                        echo $_GET['search'];
                                    }
                                ?>">
                            </div>
                            <?php
                                foreach($genres as $genre) { 
                                    echo '<input type="hidden" name="filters['.$genre['name'].']" id="filter-'.$genre['name'].'" value="';
                                    if (isset($_GET['filters'][$genre['name']])) {
                                        $filter = $_GET['filters'][$genre['name']];
                                        echo $filter;
                                    } else {
                                        echo 'neutral';
                                    }
                                    echo '">';
                                }

                            ?>
                            <input type="hidden" name="page" value="1">
                            <div class="col-12 pt-4">
                                <input type="submit" class="btn btn-success btn-search w-100" value="SEARCH">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container view-container">
            <div class="chapter-title">
                <h5>SEARCH RESULTS</h5>
            </div>
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
                        echo '<li class="page-item page-navigator"><a class="page-link" href="' . addOrUpdateQueryParam('page', $page - 1) . '">Previous</a></li>';
                    } else {
                        echo '<li class="page-item page-navigator disabled"><a class="page-link">Prev</a></li>';
                    }

                    // Page buttons
                    $start = max(1, $page - $range);
                    $end = min($totalPages, $page + $range);

                    if ($start > 1) {
                        echo '<li class="page-item page-num"><a class="page-link" href="' . addOrUpdateQueryParam('page', 1) . '">1</a></li>';
                        if ($start > 2) {
                            echo '<li class="page-item page-num disabled"><a class="page-link">...</a></li>';
                        }
                    }

                    for ($i = $start; $i <= $end; $i++) {
                        if ($i == $page) {
                            echo '<li class="page-item page-num active"><a class="page-link" href="' . addOrUpdateQueryParam('page', $i) . '">' . $i . '</a></li>';
                        } else {
                            echo '<li class="page-item page-num"><a class="page-link" href="' . addOrUpdateQueryParam('page', $i) . '">' . $i . '</a></li>';
                        }
                    }

                    if ($end < $totalPages) {
                        if ($end < $totalPages - 1) {
                            echo '<li class="page-item page-num disabled"><a class="page-link">...</a></li>';
                        }
                        echo '<li class="page-item page-num"><a class="page-link" href="' . addOrUpdateQueryParam('page', $totalPages) . '">' . $totalPages . '</a></li>';
                    }

                    // Next button
                    if ($page < $totalPages) {
                        echo '<li class="page-item page-navigator"><a class="page-link" href="' . addOrUpdateQueryParam('page', $page + 1) . '">Next</a></li>';
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

            function toggleIcon(isCollapsed) {
                if (isCollapsed) {
                    $('.minimize-icn').removeClass('fa-plus-square').addClass('fa-minus-square');
                } else {
                    $('.minimize-icn').removeClass('fa-minus-square').addClass('fa-plus-square');
                }
            }

            // Retrieve the collapse state from local storage
            if (localStorage.getItem('collapseState') === 'true') {
                $('#dropdownContainer').addClass('show');
                $('.minimize-icn').attr('aria-expanded', 'true');
                toggleIcon(true);
            } else {
                $('#dropdownContainer').removeClass('show');
                $('.minimize-icn').attr('aria-expanded', 'false');
                toggleIcon(false);
            }

            // Listen for collapse events to save the state and toggle icon
            $('#dropdownContainer').on('shown.bs.collapse', function () {
                localStorage.setItem('collapseState', 'true');
                $('.minimize-icn').attr('aria-expanded', 'true');
                toggleIcon(true);
            });

            $('#dropdownContainer').on('hidden.bs.collapse', function () {
                localStorage.setItem('collapseState', 'false');
                $('.minimize-icn').attr('aria-expanded', 'false');
                toggleIcon(false);
            });

            // Initial icon state
            toggleIcon($('#dropdownContainer').hasClass('show'));
        </script>
    </div>