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
            $orderQuery = " m.name ASC";
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
                    <img src="img/marquee.png" alt="Marquee Image">
                    <img src="img/marquee.png" alt="Marquee Image">
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
                        <i class="fas fa-lg fa-plus minimize-icn" data-toggle="collapse" data-target="#dropdownContainer" aria-expanded="false" aria-controls="dropdownContainer"></i>
                    </div>
                </div>
                <div class="collapse mt-3" id="dropdownContainer">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <label>Genres:</label>
                                <div class="filter d-flex flex-wrap">
                                    <div class="filter-item btn btn-outline-secondary mr-2" onclick="toggleFilter(this)" data-filter="action">
                                        <i class="fas fa-circle"></i> Action
                                    </div>
                                    <div class="filter-item btn btn-outline-secondary mr-2" onclick="toggleFilter(this)" data-filter="adventure">
                                        <i class="fas fa-circle"></i> Adventure
                                    </div>
                                    <div class="filter-item btn btn-outline-secondary mr-2" onclick="toggleFilter(this)" data-filter="comedy">
                                        <i class="fas fa-circle"></i> Comedy
                                    </div>
                                    <!-- Add more filter items as needed -->
                                </div>
                            </div>
                            <div class="col-12 col-md-6 pt-1">
                                <label>Order by: </label>
                                <select class="form-control" name="order">
                                    <option value="1">Latest Updates</option>
                                    <option value="2">New Manga</option>
                                    <option value="3">A-Z</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 pt-1">
                                <label>Status:</label>
                                <select class="form-control" name="status">
                                    <option value="1">Ongoing and Complete</option>
                                    <option value="2">Ongoing</option>
                                    <option value="3">Complete</option>
                                </select>
                            </div>
                            <div class="col-12 pt-1">
                                <label>Search:</label>
                                <input type="text" class="form-control" name="search">
                            </div>
                                <input type="hidden" name="filters[action]" id="filter-action" value="neutral">
                                <input type="hidden" name="filters[adventure]" id="filter-adventure" value="neutral">
                                <input type="hidden" name="filters[comedy]" id="filter-comedy" value="neutral">
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
                        echo '<div class="col-md-3 col-6 mt-3">';
                        echo '<div class="card action-card';
                        if ($i+1 & 1) {
                            echo ' action-card-left';
                        }
                        echo '" onclick="location.href=\'view.php?q='.$v['secure_id'].'\';">';
                        echo '<img src="'.$v['cover_img'].'">';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="col-md-3 col-6 mt-3 desc-card';
                        if (!($i+1 & 1)) {
                            echo ' action-p-right';
                        }
                        echo '">';
                        echo '<h5 class="title-latest">'.$v['title'].'</h5>';
                        echo '<p>';
                        echo $v['author_name'];
                        echo '<br>';
                        echo ucfirst(strtolower($v['status']));
                        echo '<br>';
                        echo 'Latest Chapter : '.$v['latest_chapter_name'];
                        echo '</p>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>

        <?php
        require('layout/footer.php');
        ?>

        <a href="<?php echo addOrUpdateQueryParam('page',1)?>">sda</a>
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