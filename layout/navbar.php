<header>
    <nav class="navbar navbar-expand-lg bg-white bg-custom-1 nav-shadow" style="border-radius:5px;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item nav-button">
                    <a class="nav-link" href="index.php">HOME</a>
                </li>
                <li class="nav-item nav-button">
                    <a class="nav-link" href="latest.php">LATEST MANGA</a>
                </li>
                <li class="nav-item nav-button">
                    <a class="nav-link" href="search.php">MANGA LIST</a>
                </li>
            </ul>
            <img src="https://pub-2bfa6b528bf54fa9a840c5feca5a3a76.r2.dev/img/logo-gif.gif" class="nav-img">
        </div>
    </nav>
    <nav class="navbar search-nav bg-custom-2" style="border-radius:5px;">
        <form action="search.php" method="GET">
            <div class="form-group form-search">
                <input type="text" class="form-control" placeholder="Search" style="width:20vw" name="search">
                <input type="submit" class="nav-button search-btn" value="SEARCH"></input>
            </div>
        </form>
        <div class="theme-toggle">
            THEME&nbsp;&nbsp;
            <i id="dark-toggle" class="fas fa-toggle-off fa-2x" style="color:white"></i>
        </div>
    </nav>
</header>