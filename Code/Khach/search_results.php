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
    <title>Tìm Kiếm - HT Shop</title>

    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="javascript/javascript-ajax-login.js"></script>

    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" type="text/css">

    <link rel="stylesheet" href="styles/style-base.css" type="text/css">
    <link href="vendor/aos-master/dist/aos.css" rel="stylesheet" type="text/css">
</head>

<!-- hiển thị sản phẩm thông qua nút tìm kiếm -->
<?php
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $name_product = $_GET['search'];
?>

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

        <!-- kết quat tìm sản phẩm -->
        <div class="container mb-2" data-aos="fade-up-right" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
            <div class="row">
                <div class="col-12">
                    <div class="bg-primary p-1 rounded">
                        <span class="text-header-top-product text-white">Kết Quả Tìm Sản Phẩm: "<?php echo $_GET['search'] ?>"</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- hiển thị tìm kiếm sản phẩm -->
        <div class="container mb-3">
            <div class="pl-3 pr-3">
                <div class="row bg-secondary rounded min-height-600">
                    <?php
                    $sql_sanpham = 'SELECT * FROM `sanpham` WHERE ten_sp LIKE "%' . $name_product . '%"';
                    $query_sanpham = mysqli_query($con, $sql_sanpham);
                    $num_sanpham = mysqli_num_rows($query_sanpham);

                    if ($num_sanpham > 0) {
                        while ($result_sanpham = mysqli_fetch_array($query_sanpham)) {
                            $khuyenmai = get_khuyenmai($result_sanpham['id_km']);
                            $gia_old = money_format($result_sanpham['gia_sp']);
                            $gia_new = price_after_promotion($result_sanpham['gia_sp'], $khuyenmai['giam_km']);
                            $gia_new = money_format($gia_new);
                    ?>
                            <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
                                <div class="card float-left bg-white hover-product div-product magin-1">
                                    <a href="product_detail.php?id_product=<?php echo $result_sanpham['id_sp'] ?>" class="a-top-product">
                                        <img src="<?php echo $result_sanpham['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
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
                                                <p class="text-name-product"><?php echo $result_sanpham['ten_sp'] ?></p>

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
                    } else {
                        ?>
                        <div class="mx-auto text-center text-white mt-5" style="font-size: 25px; font-weight: bold;">
                            Không Tìm Thấy Sản Phẩm "<?php echo $_GET['search'] ?>"
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
<?php
// hiển thị sản phẩm thông qua bộ lọc
} else if (isset($_GET['sql'])) {
?>

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

        <!-- kết quat tìm sản phẩm -->
        <div class="container mb-2" data-aos="fade-up-right" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
            <div class="row">
                <div class="col-12">
                    <div class="bg-primary p-1 rounded">
                        <span class="text-header-top-product text-white">Kết Quả Lọc Sản Phẩm</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- hiển thị kết quả lọc sản phẩm -->
        <div class="container mb-3">
            <div class="pl-3 pr-3">
                <div class="row bg-secondary rounded min-height-600">
                    <?php
                    $sql = $_GET['sql'];
                    $query = mysqli_query($con, $sql);
                    while ($result_sanpham = mysqli_fetch_array($query)) {
                        $khuyenmai = get_khuyenmai($result_sanpham['id_km']);
                        $gia_old = money_format($result_sanpham['gia_sp']);
                        $gia_new = price_after_promotion($result_sanpham['gia_sp'], $khuyenmai['giam_km']);
                        $gia_new = money_format($gia_new);
                    ?>
                        <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
                            <div class="card float-left bg-white hover-product div-product magin-1">
                                <a href="product_detail.php?id_product=<?php echo $result_sanpham['id_sp'] ?>" class="a-top-product">
                                    <img src="<?php echo $result_sanpham['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
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
                                            <p class="text-name-product"><?php echo $result_sanpham['ten_sp'] ?></p>

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
<?php
} else {
    header('Location: index.php');
}
?>