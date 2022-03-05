<?php
session_start();
include 'function/function_connect_db.php';
include 'function/function_show_database.php';
include 'function/function_find_database.php';
include 'function/function_money_format.php';

if (isset($_COOKIE['email_kh']) && !empty($_COOKIE['email_kh'])) {
    $email_kh = $_COOKIE['email_kh'];
}

if (isset($_COOKIE['password_kh']) && !empty($_COOKIE['password_kh'])) {
    $password_kh = $_COOKIE['password_kh'];
}

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - HT Shop</title>

    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/vue/dist/vue.js"></script>

    <script src="javascript/javascript-ajax-login.js"></script>

    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" type="text/css">

    <link rel="stylesheet" href="styles/style-base.css" type="text/css">

    <link href="vendor/aos-master/dist/aos.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- navbar header -->
    <?php
    include 'nav_header.php';
    ?>

    <!-- modal login -->
    <?php
    include 'modal_login.php';
    ?>

    <!-- modal notification -->
    <?php
    include 'modal_notification.php';
    ?>

    <!-- navbar menu (chức năng) -->
    <?php
    include 'nav_menu.php';
    ?>

    <!-- Breadcrumb -->
    <?php
    include 'breadcrumb.php';
    ?>

    <!-- slider -->
    <?php
    include 'slider.php';
    ?>


    <!-- top sản phẩm -->
    <div id="show_top_product" class="container mb-2" data-aos="fade-up-right" data-aos-delay="100" data-aos-duration="500" data-aos-offset="30" data-aos-easing="linear">
        <div class="row">
            <div class="background-blue ml-3 mr-3 mt-1 pb-1 rounded w-100">
                <div class="col-md-12 p-0">
                    <div id="topproduct" class="carousel slide p-1" data-ride="carousel" data-interval="700000">
                        <ol class="carousel-indicators">
                            <li data-target="#topproduct" data-slide-to="0" class="active"></li>
                            <li data-target="#topproduct" data-slide-to="1"></li>
                            <li data-target="#topproduct" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner rounded">
                            <?php
                            $num_dienthoai_khuyenmai = mysqli_num_rows($query_rand_dienthoai_khuyenmai);
                            if ($num_dienthoai_khuyenmai > 0) {
                            ?>
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="text-header-top-product text-white">Điện Thoại Khuyến Mãi Nổi Bật</span>
                                        </div>
                                        <div class="col-12 ml-1">
                                            <?php
                                            while ($result_rand_dienthoai_khuyenmai = mysqli_fetch_array($query_rand_dienthoai_khuyenmai)) {
                                                $khuyenmai = get_khuyenmai($result_rand_dienthoai_khuyenmai['id_km']);
                                                $gia_old = money_format($result_rand_dienthoai_khuyenmai['gia_sp']);
                                                $gia_new = price_after_promotion($result_rand_dienthoai_khuyenmai['gia_sp'], $khuyenmai['giam_km']);
                                                $gia_new = money_format($gia_new);
                                            ?>
                                                <div v-for="tp in top_product" class="card float-left m-1 bg-white hover-product div-top-product">
                                                    <a href="product_detail.php?product_detail=smartphone&&id_product=<?php echo $result_rand_dienthoai_khuyenmai['id_sp'] ?>" class="a-top-product">
                                                        <img src="<?php echo $result_rand_dienthoai_khuyenmai['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                                                        <div class="p-1">
                                                            <div class="div-discount ">
                                                                <i class="fa fa-gift" aria-hidden="true"></i>
                                                                <span>
                                                                    <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                                                </span>
                                                            </div>
                                                            <div class="text-center">
                                                                <p class="text-name-product">
                                                                    <?php echo $result_rand_dienthoai_khuyenmai['ten_sp'] ?>
                                                                </p>
                                                                <p class="text-price-old">
                                                                    <?php echo $gia_old ?>
                                                                </p>
                                                                <p class="text-price-new">
                                                                    <?php echo $gia_new ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="text-header-top-product text-white">Điện Thoại Khuyến Mãi Nổi Bật</span>
                                        </div>
                                        <div class="col-md-12 min-height-360 text-top-not-promotion">
                                            Hiện tại điện thoại chưa có sản phẩm khuyến mãi.
                                            <br> Vui lòng Click sang trái hoặc phải để xem các mặt hàng khuyến mãi khác
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            $num_tainghe_khuyenmai = mysqli_num_rows($query_rand_tainghe_khuyenmai);
                            if ($num_tainghe_khuyenmai > 0) {
                            ?>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="text-header-top-product text-white">Tai Nghe Khuyến Mãi Nổi Bật</span>
                                        </div>
                                        <div class="col-12 ml-1">
                                            <?php
                                            while ($result_rand_tainghe_khuyenmai = mysqli_fetch_array($query_rand_tainghe_khuyenmai)) {
                                                $khuyenmai = get_khuyenmai($result_rand_tainghe_khuyenmai['id_km']);
                                                $gia_old = money_format($result_rand_tainghe_khuyenmai['gia_sp']);
                                                $gia_new = price_after_promotion($result_rand_tainghe_khuyenmai['gia_sp'], $khuyenmai['giam_km']);
                                                $gia_new = money_format($gia_new);
                                            ?>
                                                <div v-for="tp in top_product" class="card float-left m-1 bg-white hover-product div-top-product">
                                                    <a href="product_detail.php?product_detail=headphone&&id_product=<?php echo $result_rand_tainghe_khuyenmai['id_sp'] ?>" class="a-top-product">
                                                        <img src="<?php echo $result_rand_tainghe_khuyenmai['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                                                        <div class="p-1">
                                                            <div class="div-discount ">
                                                                <i class="fa fa-gift" aria-hidden="true"></i>
                                                                <span>
                                                                    <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                                                </span>
                                                            </div>
                                                            <div class="text-center">
                                                                <p class="text-name-product">
                                                                    <?php echo $result_rand_tainghe_khuyenmai['ten_sp'] ?>
                                                                </p>
                                                                <p class="text-price-old">
                                                                    <?php echo $gia_old ?>
                                                                </p>
                                                                <p class="text-price-new">
                                                                    <?php echo $gia_new ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="text-header-top-product text-white">Tai Nghe Khuyến Mãi Nổi Bật</span>
                                        </div>
                                        <div class="col-md-12 min-height-360 text-top-not-promotion">
                                            Hiện tại tai nghe chưa có sản phẩm khuyến mãi.
                                            <br> Vui lòng Click sang trái hoặc phải để xem các mặt hàng khuyến mãi khác
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            $num_oplung_khuyenmai = mysqli_num_rows($query_rand_oplung_khuyenmai);
                            if ($num_oplung_khuyenmai > 0) {
                            ?>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="text-header-top-product text-white">Ốp Lưng Khuyến Mãi Nổi Bật</span>
                                        </div>
                                        <div class="col-12 ml-1">
                                            <?php
                                            while ($result_rand_oplung_khuyenmai = mysqli_fetch_array($query_rand_oplung_khuyenmai)) {
                                                $khuyenmai = get_khuyenmai($result_rand_oplung_khuyenmai['id_km']);
                                                $gia_old = money_format($result_rand_oplung_khuyenmai['gia_sp']);
                                                $gia_new = price_after_promotion($result_rand_oplung_khuyenmai['gia_sp'], $khuyenmai['giam_km']);
                                                $gia_new = money_format($gia_new);
                                            ?>
                                                <div v-for="tp in top_product" class="card float-left m-1 bg-white hover-product div-top-product">
                                                    <a href="product_detail.php?product_detail=phonecase&&id_product=<?php echo $result_rand_oplung_khuyenmai['id_sp'] ?>" class="a-top-product">
                                                        <img src="<?php echo $result_rand_oplung_khuyenmai['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                                                        <div class="p-1">
                                                            <div class="div-discount ">
                                                                <i class="fa fa-gift" aria-hidden="true"></i>
                                                                <span>
                                                                    <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                                                </span>
                                                            </div>
                                                            <div class="text-center">
                                                                <p class="text-name-product">
                                                                    <?php echo $result_rand_oplung_khuyenmai['ten_sp'] ?>
                                                                </p>
                                                                <p class="text-price-old">
                                                                    <?php echo $gia_old ?>
                                                                </p>
                                                                <p class="text-price-new">
                                                                    <?php echo $gia_new ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else {
                            ?>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="text-header-top-product text-white">Ốp Lưng Khuyến Mãi Nổi Bật</span>
                                        </div>
                                        <div class="col-md-12 min-height-360 text-top-not-promotion">
                                            Hiện tại ốp lưng chưa có sản phẩm khuyến mãi.
                                            <br> Vui lòng Click sang trái hoặc phải để xem các mặt hàng khuyến mãi khác
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev width-6" href="#topproduct" role="button" data-slide="prev">
                            <div class="background-blue p-1 pt-2 rounded">
                                <span class="carousel-control-prev-icon icon-slider" aria-hidden="true"></span>
                            </div>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next width-6" href="#topproduct" role="button" data-slide="next">
                            <div class="background-blue p-1 pt-2 rounded">
                                <span class="carousel-control-next-icon icon-slider" aria-hidden="true"></span>
                            </div>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- danh sách sản phẩm -->
    <div class="container mb-2 mt-2" data-aos="fade-up-right" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
        <div class="row">
            <div class="col-12">
                <div class="bg-primary p-1 rounded">
                    <span class="text-header-top-product text-white">Danh Sách Sản Phẩm</span>
                </div>
            </div>
        </div>
    </div>

    <!-- sản phẩm -->
    <div class="container mb-3">
        <div class="pl-3 pr-3">
            <div class="row">
                <!-- hiển thị ĐIỆN THOẠI -->
                <?php
                while ($result_rand_dienthoai = mysqli_fetch_array($query_rand_dienthoai)) {
                    $khuyenmai = get_khuyenmai($result_rand_dienthoai['id_km']);
                    $gia_old = money_format($result_rand_dienthoai['gia_sp']);
                    $gia_new = price_after_promotion($result_rand_dienthoai['gia_sp'], $khuyenmai['giam_km']);
                    $gia_new = money_format($gia_new);
                ?>
                    <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
                        <div class="card float-left bg-white hover-product div-product magin-1">
                            <a href="product_detail.php?id_product=<?php echo $result_rand_dienthoai['id_sp'] ?>" class="a-top-product">
                                <img src="<?php echo $result_rand_dienthoai['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                                <div class="p-1">
                                    <div class="div-discount">
                                        <?php
                                        if ($khuyenmai['giam_km'] == 0) {
                                        ?>
                                            <span>&nbsp;</span>
                                        <?php
                                        } else {
                                        ?>
                                            <i class="fa fa-gift" aria-hidden="true"></i>
                                            <span>
                                                <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                            </span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-name-product"><?php echo $result_rand_dienthoai['ten_sp'] ?></p>

                                        <?php
                                        if ($khuyenmai['giam_km'] == 0) {
                                            echo '<span>&nbsp;<span/>';
                                        } else {
                                            echo '<p class="text-price-old">' . $gia_old . '</p>';
                                        }
                                        ?>

                                        <p class="text-price-new"><?php echo $gia_new ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                }
                ?>

                <!-- hiển thị TAI NGHE -->
                <?php
                while ($result_rand_tainghe = mysqli_fetch_array($query_rand_tainghe)) {
                    $khuyenmai = get_khuyenmai($result_rand_tainghe['id_km']);
                    $gia_old = money_format($result_rand_tainghe['gia_sp']);
                    $gia_new = price_after_promotion($result_rand_tainghe['gia_sp'], $khuyenmai['giam_km']);
                    $gia_new = money_format($gia_new);
                ?>
                    <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
                        <div class="card float-left bg-white hover-product div-product magin-1">
                            <a href="product_detail.php?id_product=<?php echo $result_rand_tainghe['id_sp'] ?>" class="a-top-product">
                                <img src="<?php echo $result_rand_tainghe['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                                <div class="p-1">
                                    <div class="div-discount">
                                        <?php
                                        if ($khuyenmai['giam_km'] == 0) {
                                        ?>
                                            <span>&nbsp;</span>
                                        <?php
                                        } else {
                                        ?>
                                            <i class="fa fa-gift" aria-hidden="true"></i>
                                            <span>
                                                <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                            </span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-name-product"><?php echo $result_rand_tainghe['ten_sp'] ?></p>

                                        <?php
                                        if ($khuyenmai['giam_km'] == 0) {
                                            echo '<span>&nbsp;<span/>';
                                        } else {
                                            echo '<p class="text-price-old">' . $gia_old . '</p>';
                                        }
                                        ?>

                                        <p class="text-price-new"><?php echo $gia_new ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                }
                ?>


                <!-- hiển thị ỐP LƯNG -->
                <?php
                while ($result_rand_oplung = mysqli_fetch_array($query_rand_oplung)) {
                    $khuyenmai = get_khuyenmai($result_rand_oplung['id_km']);
                    $gia_old = money_format($result_rand_oplung['gia_sp']);
                    $gia_new = price_after_promotion($result_rand_oplung['gia_sp'], $khuyenmai['giam_km']);
                    $gia_new = money_format($gia_new);
                ?>
                    <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
                        <div class="card float-left bg-white hover-product div-product magin-1">
                            <a href="product_detail.php?id_product=<?php echo $result_rand_oplung['id_sp'] ?>" class="a-top-product">
                                <img src="<?php echo $result_rand_oplung['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                                <div class="p-1">
                                    <div class="div-discount">
                                        <?php
                                        if ($khuyenmai['giam_km'] == 0) {
                                        ?>
                                            <span>&nbsp;</span>
                                        <?php
                                        } else {
                                        ?>
                                            <i class="fa fa-gift" aria-hidden="true"></i>
                                            <span>
                                                <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                            </span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-name-product"><?php echo $result_rand_oplung['ten_sp'] ?></p>

                                        <?php
                                        if ($khuyenmai['giam_km'] == 0) {
                                            echo '<span>&nbsp;<span/>';
                                        } else {
                                            echo '<p class="text-price-old">' . $gia_old . '</p>';
                                        }
                                        ?>

                                        <p class="text-price-new"><?php echo $gia_new ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>


    <!-- footer -->
    <?php
    include 'footer.php';
    ?>

    <!-- script AOS -->
    <script src="vendor/aos-master/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>