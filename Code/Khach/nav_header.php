<script src="javascript/javascript-ajax-search.js"></script>
<link rel="stylesheet" href="styles/style-search.css" type="text/css">

<nav id="nav-header" class="navbar navbar-expand-lg navbar-dark background-blue mb-1 p-1">
    <div class="container">
        <a class="navbar-brand text-logo-shop p-0" href="index.php">
            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            HT Shop
        </a>
        <div class="navbar-toggler p-0 border-0">
            <span class="text-navbar text-white" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                Menu
            </span>
            <button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarScroll">
            <!-- tìm kiếm -->
            <form action="search_results.php" method="GET" class="d-flex mr-auto w-25" style="position: absolute;">
                <div class="input-group input-group-sm">
                    <input name="search" type="text" class="form-control" placeholder="Tìm Kiếm">
                    <div class="input-group-append ">
                        <button type="submit" class="btn background-icon border-left">
                            <i class="fa fa-search text-white"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- khung hiển thị gợi ý kết quả tìm kiếm -->
            <div id="show_suggestions" class="div-search p-2" hidden>
            </div>

            <ul class="navbar-nav ml-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                <li class="nav-item text-nav-item">
                    <a class="nav-link text-white hover-btn" href="tel:123456789">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        0123456789
                    </a>
                </li>
                <?php
                if (isset($user['email_kh'])) {
                ?>
                    <li class="nav-item text-nav-item">
                        <?php
                        $page = $_SERVER['PHP_SELF'];
                        if (strpos($page, "cart.php") != false) {
                        ?>
                            <a class="nav-link text-white hover-btn btn-active" href="cart.php">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Giỏ Hàng

                            </a>
                        <?php
                        } else {
                        ?>
                            <a class="nav-link text-white hover-btn" href="cart.php">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Giỏ Hàng

                            </a>
                        <?php
                        }
                        ?>
                    </li>
                <?php
                }
                ?>

                <?php
                if (!isset($user['email_kh'])) {
                ?>
                    <li class="nav-item text-nav-item">
                        <a class="nav-link text-white hover-btn" href="#" data-toggle="modal" data-target="#modal-login">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>
                            Đăng Nhập
                        </a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item text-nav-item">
                        <div class="dropdown">
                            <a class="nav-link text-white hover-btn dropdown-toggle" type="button" id="drop-down-account" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <?php echo $user['ten_kh'] ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="drop-down-account">
                                <a class="dropdown-item" href="account.php">Tài Khoản</a>
                                <a class="dropdown-item" href="account.php#show_don_hang_gan_day">Đơn Hàng</a>
                                <a class="dropdown-item" href="function/function_logout.php">Đăng Xuất</a>
                            </div>
                        </div>
                    </li>
                <?php
                }
                ?>

            </ul>
        </div>
    </div>
</nav>