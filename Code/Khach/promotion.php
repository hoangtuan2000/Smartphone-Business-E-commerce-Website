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
    <title>Khuyến Mãi - HT Shop</title>

    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/vue/dist/vue.js"></script>

    <script src="javascript/javascript-ajax-login.js"></script>
    <script src="javascript/javascript-ajax-filter.js"></script>

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

    <!-- danh sách sản phẩm khuyến mãi -->
    <div class="container mt-2 mb-2" data-aos="fade-up-right" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
        <div class="row">
            <div class="col-12">
                <div class="bg-primary p-1 rounded">
                    <span id="show_name_filter" class="text-header-top-product text-white">Danh Sách Sản Phẩm Khuyến Mãi</span>
                </div>
            </div>
        </div>
    </div>

    <!-- bộ lọc -->
    <div class="container mt-2 mb-2" data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
        <div class="row bg-white m-1 p-1 rounded">
            <div class="col-12">
                <div class="float-left">
                    <i class="fa fa-filter" aria-hidden="true"></i>
                    Khuyến Mãi: <span class="sap-xep font-weight-bold">Tất Cả Sản Phẩm</span>
                </div>
                <div class="float-right">
                    <button id="filter_all_product_khuyenmai" class="btn btn-success btn-sm">
                       Tất Cả Sản Phẩm Khuyến Mãi
                    </button>
                    <button id="filter_dienthoai_khuyenmai" value="smartphone" class="btn btn-success btn-sm">
                        Điện Thoại Khuyến Mãi
                    </button>
                    <button id="filter_tainghe_khuyenmai" value="headphone" class="btn btn-success btn-sm">
                        Tai Nghe Khuyến Mãi
                    </button>
                    <button id="filter_oplung_khuyenmai" value="phonecase" class="btn btn-success btn-sm">
                        Ốp Lưng Khuyến Mãi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- sản phẩm khuyến mãi -->
    <div class="container mb-3 min-height-1000">
        <div class="pl-3 pr-3">
            <div class="row" id="show_product">
                <!-- hiển thị SẢN PHẨM KHUYẾN MÃI -->
                <?php
                while ($result_product = mysqli_fetch_array($query_sanpham_khuyenmai)) {
                    $khuyenmai = get_khuyenmai($result_product['id_km']);
                    $gia_old = money_format($result_product['gia_sp']);
                    $gia_new = price_after_promotion($result_product['gia_sp'], $khuyenmai['giam_km']);
                    $gia_new = money_format($gia_new);
                ?>
                    <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
                        <div class="card float-left bg-white hover-product div-product magin-1">
                            <a href="product_detail.php?product_detail=smartphone&&id_product=<?php echo $result_product['id_sp'] ?>" class="a-top-product">
                                <img src="<?php echo $result_product['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
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
                                        <p class="text-name-product"><?php echo $result_product['ten_sp'] ?></p>

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