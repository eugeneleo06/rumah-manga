<?php require 'api/get_footer.php'; ?>
<div class="marquee-footer-container">
    <div class="marquee">
        <?php 
        for ($i = 0; $i < 11; $i++) {
            echo '<img src="'.$ads['img_url'].'" alt="Marquee Image">';
        }
        ?>
    </div>
</div>
<button id="back-to-top" class="back-to-top">
    <i class="fas fa-arrow-up"></i>
</button>
<footer>
    <div class="footer-head">
    </div>
    <p>Copyright</p>
</footer>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const hash = window.location.hash;
            if (hash) {
                const targetElement = document.querySelector(hash);
                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });

        window.addEventListener('scroll', function() {
        var scrollPosition = window.scrollY;
        var backToTopButton = document.getElementById('back-to-top');
        if (scrollPosition > 200) {
            backToTopButton.style.display = 'block';
        } else {
            backToTopButton.style.display = 'none';
        }
        });

    // Scroll to the top when the button is clicked
        document.getElementById('back-to-top').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/dark.js"></script>
</body>
</html>