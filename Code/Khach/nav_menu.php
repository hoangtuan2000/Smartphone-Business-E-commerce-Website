<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark background-blue rounded mb-1 p-1">
        <div class="navbar-toggler p-0 border-0">
            <button class="navbar-toggler p-0 mr-1" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="text-navbar text-white mr-auto" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                Danh Sách Sản Phẩm
            </span>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item text-nav-item ">
                    <?php
                    $page = $_SERVER['PHP_SELF'];
                    if (strpos($page, "smartphone.php") != false) {
                    ?>
                        <a class="nav-link text-white hover-btn btn-active" href="smartphone.php">
                            <i class="fa fa-mobile" aria-hidden="true"></i>
                            Điện Thoại
                        </a>
                    <?php
                    } else {
                    ?>
                        <a class="nav-link text-white hover-btn" href="smartphone.php">
                            <i class="fa fa-mobile" aria-hidden="true"></i>
                            Điện Thoại
                        </a>
                    <?php
                    }
                    ?>
                </li>
                <li class="nav-item text-nav-item ">
                    <?php
                    $page = $_SERVER['PHP_SELF'];
                    if (strpos($page, "headphone.php") != false) {
                    ?>
                        <a class="nav-link text-white hover-btn btn-active" href="headphone.php">
                            <i class="fa fa-headphones" aria-hidden="true"></i>
                            Tai Nghe
                        </a>
                    <?php
                    } else {
                    ?>
                        <a class="nav-link text-white hover-btn" href="headphone.php">
                            <i class="fa fa-headphones" aria-hidden="true"></i>
                            Tai Nghe
                        </a>
                    <?php
                    }
                    ?>
                </li>
                <li class="nav-item text-nav-item ">
                    <?php
                    $page = $_SERVER['PHP_SELF'];
                    if (strpos($page, "phonecase.php") != false) {
                    ?>
                        <a class="nav-link text-white hover-btn btn-active" href="phonecase.php">
                            <i class="fa fa-tablet" aria-hidden="true"></i>
                            Ốp Lưng
                        </a>
                    <?php
                    } else {
                    ?>
                        <a class="nav-link text-white hover-btn" href="phonecase.php">
                            <i class="fa fa-tablet" aria-hidden="true"></i>
                            Ốp Lưng
                        </a>
                    <?php
                    }
                    ?>
                </li>
                <li class="nav-item text-nav-item ">
                    <?php
                    $page = $_SERVER['PHP_SELF'];
                    if (strpos($page, "promotion.php") != false) {
                    ?>
                        <a class="nav-link text-white hover-btn btn-active" href="promotion.php">
                            <i class="fa fa-gift" aria-hidden="true"></i>
                            Khuyến Mãi
                        </a>
                    <?php
                    } else {
                    ?>
                        <a class="nav-link text-white hover-btn" href="promotion.php">
                            <i class="fa fa-gift" aria-hidden="true"></i>
                            Khuyến Mãi
                        </a>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
</div>