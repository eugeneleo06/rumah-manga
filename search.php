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

        <br> <br>

        <div class="container">
            <div class="search-container">
                <h5 style="display:inline;">Filters</h5>
                <i class="fas fa-lg fa-plus ml-3" data-toggle="collapse" data-target="#dropdownContainer" aria-expanded="false" aria-controls="dropdownContainer" style="cursor: pointer;"></i>

                <div class="collapse mt-3" id="dropdownContainer">
                    <form>
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
                                <select class="form-control">
                                    <option value="1">Latest Updates</option>
                                    <option value="2">New Manga</option>
                                    <option value="3">A-Z</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 pt-1">
                                <label>Status:</label>
                                <select class="form-control">
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
                                <input type="submit" class="btn btn-success w-100" value="SEARCH">
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