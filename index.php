<?php

ob_start();
session_start();

require 'api/get_index.php';

require('layout/header.php');
?>
<body class="bg-home">
    <div class="wrapper">
        <div class="container-fluid container-nav">
            <?php require('layout/navbar.php');?>

            <div class="marquee-container">
                <div class="marquee">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                    <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/marquee.png" alt="Marquee Image">
                </div>
            </div>
        </div>

        <div class="container">
            <div class="title-container">
                <h1>LATEST UPDATES</h1>
            </div>
            <div class="carousel-container">
                <div class="carousel">
                <?php 
                    foreach($mangas_latest as $v) {
                        echo '<div class="card" onclick="location.href=\'view.php?q='.$v['secure_id'].'#col1\';">';
                        echo '<img src="'.$v['cover_img'].'">';
                        echo '<div class="description">';
                        echo '<p>';
                        echo '<span class="title-latest">'.$v['title'].'</span>';
                        echo '<br>';
                        echo $v['author_name'];
                        echo '<br>';
                        echo ucfirst(strtolower($v['status']));
                        echo '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
                </div>
            </div>

            <div class="title-container">
                <h1>ACTION MANGA</h1>
            </div>
            <div class="container">
                <div class="row">
                    <?php
                    foreach($mangas_action as $v) {
                        echo '<div class="col-12 col-md-6">';
                        echo '<div class="d-flex justify-content-center align-items-stretch" style="margin-bottom:2vh;">';
                        echo '<div class="card action-card"';
                        echo '" onclick="location.href=\'view.php?q='.$v['secure_id'].'#headline\';">';
                        echo '<img src="'.$v['cover_img'].'">';
                        echo '</div>';
                        echo '<div class="action-desc">';
                        echo '<h5 class="title-latest">'.$v['title'].'</h5>';
                        echo '<p class="action-p">';
                        echo $v['author_name'];
                        echo '<br>';
                        echo '<span style="font-weight:200;">'.ucfirst(strtolower($v['status'])).'</span>';
                        echo '<br>';
                        echo '» Chapter : '.$v['latest_chapter_name'];
                        echo '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                    <div class="col-12" style="margin-top:2vh;margin-bottom:2vh;">
                        <button type="submit" class="btn btn-success btn-search w-100" onclick="location.href='search.php?filters%5BAction%5D=included'">MORE</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <?php
                foreach($ads as $ad) { 
                    
                    echo '<div class="col-4">';
                    echo '<img src="'.$ad['img_url'].'" class="w-100 ads-img" onclick="location.href=\''.$ad['url'].'\'">';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <?php
        require('layout/footer.php');
        ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const fadeLeft = document.querySelector('.fade-left');
        const fadeRight = document.querySelector('.fade-right');
        
        function checkScroll() {
            const triggerBottom = window.innerHeight / 5 * 4;
            const fadeLeftTop = fadeLeft.getBoundingClientRect().top;
            const fadeRightTop = fadeRight.getBoundingClientRect().top;
            
            if (fadeLeftTop < triggerBottom) {
            fadeLeft.classList.add('fade-in');
            }
            
            if (fadeRightTop < triggerBottom) {
            fadeRight.classList.add('fade-in');
            }
        }

        window.addEventListener('scroll', checkScroll);
        });


        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.querySelector('.carousel');
            const cards = Array.from(carousel.children);
            const totalCards = cards.length;
            let cardsToShow = window.innerWidth > 768 ? 4 : 3; // 4 for desktop, 3 for mobile
            let currentIndex = 0;

            function cloneCards() {
                for (let i = 0; i < cardsToShow; i++) {
                    const cloneFirst = cards[i].cloneNode(true);
                    const cloneLast = cards[totalCards - 1 - i].cloneNode(true);
                    carousel.appendChild(cloneFirst);
                    carousel.insertBefore(cloneLast, carousel.firstChild);
                }
            }

            function updateCarousel() {
                const cardWidth = carousel.querySelector('.card').offsetWidth;
                const offset = -((currentIndex + cardsToShow) * cardWidth);
                carousel.style.transform = `translateX(${offset}px)`;
            }

            function moveNext() {
                currentIndex++;
                if (currentIndex >= totalCards) {
                    currentIndex = 0;
                    setTimeout(() => {
                        carousel.style.transition = 'none';
                        updateCarousel();
                        requestAnimationFrame(() => {
                            carousel.style.transition = 'transform 0.8s ease-in-out';
                        });
                    }, 800); // Match this duration with the CSS transition duration
                } else {
                    updateCarousel();
                }
            }

            function movePrev() {
                currentIndex--;
                if (currentIndex < 0) {
                    currentIndex = totalCards - 1;
                    setTimeout(() => {
                        carousel.style.transition = 'none';
                        updateCarousel();
                        requestAnimationFrame(() => {
                            carousel.style.transition = 'transform 0.8s ease-in-out';
                        });
                    }, 800); // Match this duration with the CSS transition duration
                } else {
                    updateCarousel();
                }
            }

            cloneCards();
            updateCarousel();

            setInterval(moveNext, 3000); // Move to next card every 3 seconds

            window.addEventListener('resize', () => {
                const newCardsToShow = window.innerWidth > 768 ? 4 : 3;
                if (cardsToShow !== newCardsToShow) {
                    cardsToShow = newCardsToShow;
                    cloneCards();
                    updateCarousel();
                }
            });
        });



    </script>