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
    <title>Điện Thoại - HT Shop</title>

    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/vue/dist/vue.js"></script>

    <script src="javascript/javascript-ajax-login.js"></script>
    <script src="javascript/javascript-ajax-filter.js"></script>
    <script src="javascript/javascript-ajax-filter-smartphone.js"></script>

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


    <?php
    //xem điện thoại khuyến mãi có số lượng bao nhiêu để in ra slider cho đúng
    $num_dienthoai_khuyenmai = mysqli_num_rows($query_dienthoai_khuyenmai);
    if ($num_dienthoai_khuyenmai > 0) {
    ?>
        <!-- top sản phẩm -->
        <div id="show_top_product" class="container mb-2" data-aos="fade-right" data-aos-delay="300" data-aos-duration="500" data-aos-offset="30" data-aos-easing="linear">
            <div class="row">
                <div class="background-blue ml-3 mr-3 mt-1 pb-1 rounded w-100">
                    <div class="col-md-12">
                        <span class="text-header-top-product text-white">Điện Thoại Khuyến Mãi Nổi Bật</span>
                    </div>
                    <div class="col-md-12 p-0">
                        <div id="topproduct" class="carousel slide p-1" data-ride="carousel" data-interval="700000">

                            <?php
                            //nếu điện thoại khuyến mãi có số lượng lớn hơn 8 thì in ra 3 slider sản phẩm nổi bật
                            if ($num_dienthoai_khuyenmai > 8) {
                            ?>
                                <ol class="carousel-indicators">
                                    <li data-target="#topproduct" data-slide-to="0" class="active"></li>
                                    <li data-target="#topproduct" data-slide-to="1"></li>
                                    <li data-target="#topproduct" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner rounded">
                                    <!-- slider 1 sản phẩm nổi bật -->
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-12 ml-1">
                                                <?php
                                                //biến lưu lại ID điện thoại khuyến mãi đã hiển thị
                                                $displayed = "";
                                                $index = 1;
                                                while ($result_rand_dienthoai = mysqli_fetch_array($query_rand_dienthoai_khuyenmai)) {
                                                    //nếu là sản phẩm đầu tiên thì khỏi thêm dấu phẩy phía trước và ngược lại
                                                    if ($index == 1) {
                                                        $displayed .= $result_rand_dienthoai['id_sp'];
                                                    } else {
                                                        $displayed .= "," . $result_rand_dienthoai['id_sp'];
                                                    }
                                                    $index++;


                                                    $khuyenmai = get_khuyenmai($result_rand_dienthoai['id_km']);
                                                    $gia_old = money_format($result_rand_dienthoai['gia_sp']);
                                                    $gia_new = price_after_promotion($result_rand_dienthoai['gia_sp'], $khuyenmai['giam_km']);
                                                    $gia_new = money_format($gia_new);
                                                ?>
                                                    <div v-for="tp in top_product" class="card float-left m-1 bg-white hover-product div-top-product">
                                                        <a href="product_detail.php?id_product=<?php echo $result_rand_dienthoai['id_sp'] ?>" class="a-top-product">
                                                            <img src="<?php echo $result_rand_dienthoai['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                                                            <div class="p-1">
                                                                <div class="div-discount ">
                                                                    <i class="fa fa-gift" aria-hidden="true"></i>
                                                                    <span>
                                                                        <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                                                    </span>
                                                                </div>
                                                                <div class="text-center">
                                                                    <p class="text-name-product">
                                                                        <?php echo $result_rand_dienthoai['ten_sp'] ?>
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
                                    <!-- slider 2 sản phẩm nổi bật -->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-12 ml-1">
                                                <?php
                                                include 'function/function_show_database.php';
                                                //hàm dùng để lấy query điện thoại khuyến mãi chưa hiển thị (limit là 5)
                                                $query = get_dienthoai_khuyenmai_not_displayed($displayed);
                                                while ($result_rand_dienthoai = mysqli_fetch_array($query)) {
                                                    //thêm ID điện thoại khuyến mãi đã hiện thị vào biến $displayed để sử dụng cho slider thứ 3
                                                    $displayed .= "," . $result_rand_dienthoai['id_sp'];
                                                    $khuyenmai = get_khuyenmai($result_rand_dienthoai['id_km']);
                                                    $gia_old = money_format($result_rand_dienthoai['gia_sp']);
                                                    $gia_new = price_after_promotion($result_rand_dienthoai['gia_sp'], $khuyenmai['giam_km']);
                                                    $gia_new = money_format($gia_new);
                                                ?>
                                                    <div v-for="tp in top_product" class="card float-left m-1 bg-white hover-product div-top-product">
                                                        <a href="product_detail.php?id_product=<?php echo $result_rand_dienthoai['id_sp'] ?>" class="a-top-product">
                                                            <img src="<?php echo $result_rand_dienthoai['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                                                            <div class="p-1">
                                                                <div class="div-discount ">
                                                                    <i class="fa fa-gift" aria-hidden="true"></i>
                                                                    <span>
                                                                        <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                                                    </span>
                                                                </div>
                                                                <div class="text-center">
                                                                    <p class="text-name-product">
                                                                        <?php echo $result_rand_dienthoai['ten_sp'] ?>
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
                                    <!-- slider 3 sản phẩm nổi bật -->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-12 ml-1">
                                                <?php
                                                include 'function/function_show_database.php';
                                                //hàm dùng để lấy query điện thoại khuyến mãi chưa hiển thị (limit là 5)
                                                $query = get_dienthoai_khuyenmai_not_displayed($displayed);
                                                while ($result_rand_dienthoai = mysqli_fetch_array($query)) {
                                                    $khuyenmai = get_khuyenmai($result_rand_dienthoai['id_km']);
                                                    $gia_old = money_format($result_rand_dienthoai['gia_sp']);
                                                    $gia_new = price_after_promotion($result_rand_dienthoai['gia_sp'], $khuyenmai['giam_km']);
                                                    $gia_new = money_format($gia_new);
                                                ?>
                                                    <div v-for="tp in top_product" class="card float-left m-1 bg-white hover-product div-top-product">
                                                        <a href="product_detail.php?id_product=<?php echo $result_rand_dienthoai['id_sp'] ?>" class="a-top-product">
                                                            <img src="<?php echo $result_rand_dienthoai['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                                                            <div class="p-1">
                                                                <div class="div-discount ">
                                                                    <i class="fa fa-gift" aria-hidden="true"></i>
                                                                    <span>
                                                                        <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                                                    </span>
                                                                </div>
                                                                <div class="text-center">
                                                                    <p class="text-name-product">
                                                                        <?php echo $result_rand_dienthoai['ten_sp'] ?>
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


                            <?php
                                //nếu điện thoại khuyến mãi có số lượng lớn hơn >5 và <9 thì in ra 2 slider sản phẩm nổi bật
                            } else if ($num_dienthoai_khuyenmai > 5 && $num_dienthoai_khuyenmai < 9) {
                            ?>
                                <ol class="carousel-indicators">
                                    <li data-target="#topproduct" data-slide-to="0" class="active"></li>
                                    <li data-target="#topproduct" data-slide-to="1"></li>
                                </ol>
                                <div class="carousel-inner rounded">
                                    <!-- silder 1 -->
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-12 ml-1">
                                                <?php
                                                //biến lưu lại ID điện thoại khuyến mãi đã hiển thị
                                                $displayed = "";
                                                $index = 1;
                                                while ($result_rand_dienthoai = mysqli_fetch_array($query_rand_dienthoai_khuyenmai)) {
                                                    //nếu là sản phẩm đầu tiên thì khỏi thêm dấu phẩy phía trước và ngược lại
                                                    if ($index == 1) {
                                                        $displayed .= $result_rand_dienthoai['id_sp'];
                                                    } else {
                                                        $displayed .= "," . $result_rand_dienthoai['id_sp'];
                                                    }
                                                    $index++;


                                                    $khuyenmai = get_khuyenmai($result_rand_dienthoai['id_km']);
                                                    $gia_old = money_format($result_rand_dienthoai['gia_sp']);
                                                    $gia_new = price_after_promotion($result_rand_dienthoai['gia_sp'], $khuyenmai['giam_km']);
                                                    $gia_new = money_format($gia_new);
                                                ?>
                                                    <div v-for="tp in top_product" class="card float-left m-1 bg-white hover-product div-top-product">
                                                        <a href="product_detail.php?id_product=<?php echo $result_rand_dienthoai['id_sp'] ?>" class="a-top-product">
                                                            <img src="<?php echo $result_rand_dienthoai['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                                                            <div class="p-1">
                                                                <div class="div-discount ">
                                                                    <i class="fa fa-gift" aria-hidden="true"></i>
                                                                    <span>
                                                                        <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                                                    </span>
                                                                </div>
                                                                <div class="text-center">
                                                                    <p class="text-name-product">
                                                                        <?php echo $result_rand_dienthoai['ten_sp'] ?>
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
                                    <!-- slider 2 -->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-12 ml-1">
                                                <?php
                                                include 'function/function_show_database.php';
                                                //hàm dùng để lấy query điện thoại khuyến mãi chưa hiển thị (limit là 5)
                                                $query = get_dienthoai_khuyenmai_not_displayed($displayed);
                                                while ($result_rand_dienthoai = mysqli_fetch_array($query)) {
                                                    $khuyenmai = get_khuyenmai($result_rand_dienthoai['id_km']);
                                                    $gia_old = money_format($result_rand_dienthoai['gia_sp']);
                                                    $gia_new = price_after_promotion($result_rand_dienthoai['gia_sp'], $khuyenmai['giam_km']);
                                                    $gia_new = money_format($gia_new);
                                                ?>
                                                    <div v-for="tp in top_product" class="card float-left m-1 bg-white hover-product div-top-product">
                                                        <a href="product_detail.php?id_product=<?php echo $result_rand_dienthoai['id_sp'] ?>" class="a-top-product">
                                                            <img src="<?php echo $result_rand_dienthoai['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                                                            <div class="p-1">
                                                                <div class="div-discount ">
                                                                    <i class="fa fa-gift" aria-hidden="true"></i>
                                                                    <span>
                                                                        <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                                                    </span>
                                                                </div>
                                                                <div class="text-center">
                                                                    <p class="text-name-product">
                                                                        <?php echo $result_rand_dienthoai['ten_sp'] ?>
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


                            <?php
                                //nếu điện thoại khuyến mãi có số lượng <6 thì in ra 1 slider sản phẩm nổi bật
                            } else if ($num_dienthoai_khuyenmai < 6) {
                            ?>
                                <ol class="carousel-indicators">
                                    <li data-target="#topproduct" data-slide-to="0" class="active"></li>
                                </ol>
                                <div class="carousel-inner rounded">
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-12 ml-1">
                                                <?php
                                                while ($result_rand_dienthoai = mysqli_fetch_array($query_rand_dienthoai_khuyenmai)) {
                                                    $khuyenmai = get_khuyenmai($result_rand_dienthoai['id_km']);
                                                    $gia_old = money_format($result_rand_dienthoai['gia_sp']);
                                                    $gia_new = price_after_promotion($result_rand_dienthoai['gia_sp'], $khuyenmai['giam_km']);
                                                    $gia_new = money_format($gia_new);
                                                ?>
                                                    <div v-for="tp in top_product" class="card float-left m-1 bg-white hover-product div-top-product">
                                                        <a href="product_detail.php?id_product=<?php echo $result_rand_dienthoai['id_sp'] ?>" class="a-top-product">
                                                            <img src="<?php echo $result_rand_dienthoai['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                                                            <div class="p-1">
                                                                <div class="div-discount ">
                                                                    <i class="fa fa-gift" aria-hidden="true"></i>
                                                                    <span>
                                                                        <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                                                    </span>
                                                                </div>
                                                                <div class="text-center">
                                                                    <p class="text-name-product">
                                                                        <?php echo $result_rand_dienthoai['ten_sp'] ?>
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
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>


    <!-- bộ lọc -->
    <div class="container mb-2" data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" data-aos-offset="30" data-aos-easing="linear">
        <div id="accordion">
            <div class="card">
                <div class="card-header p-0" id="headingOne">
                    <h5 class="m-0">

                        <button class="btn btn-link text-filter p-1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-filter" aria-hidden="true"></i>
                            Bộ Lọc
                        </button>

                        <div class="float-right m-1">
                            <button id="btn-filter-asc" value="smartphone" class="btn btn-success btn-sm">
                                <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                                Giá Tăng Dần
                            </button>
                            <button id="btn-filter-desc" value="smartphone" class="btn btn-primary btn-sm">
                                <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
                                Giá Giảm Dần
                            </button>
                        </div>
                        <div class="float-right m-1 mt-2" style="font-size: 16px;">
                            Sắp Xếp Theo: <span class="sap-xep font-weight-bold"></span>
                        </div>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse text-filter" aria-labelledby="headingOne" data-parent="#accordion">
                    <div id="div-filter" class="card-body p-3">
                        <b class="text-filter-details">Thương Hiệu</b> <br>
                        <?php
                        $sql = "SELECT DISTINCT th.id_th, th.ten_th FROM `dienthoai` dt, `thuonghieu` th WHERE dt.id_th = th.id_th";
                        $query = mysqli_query($con, $sql);
                        while ($result = mysqli_fetch_array($query)) {
                            if ($result['id_th'] != 1) {
                        ?>
                                <button name="filter_detail" value="id_th=<?php echo $result['id_th'] ?>" data-tab='chua bam' type="button" class="btn btn-outline-primary p-1 text-filter-btn" style="text-transform: uppercase; min-width: 80px;">
                                    <?php echo $result['ten_th'] ?>
                                </button>
                        <?php
                            }
                        }
                        ?>

                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div class="col-6">
                                <b class="text-filter-details">Giá</b> <br>
                                <button name="filter_detail_gia" data-tab='chua bam' value="gia_sp < 2000000" type="button" class="btn btn-outline-primary p-1 text-filter-btn">
                                    Dưới 2 Triệu
                                </button>
                                <button name="filter_detail_gia" data-tab='chua bam' value="gia_sp BETWEEN 2000000 AND 4000000" type="button" class="btn btn-outline-primary p-1 text-filter-btn">
                                    Từ 2 - 4 Triệu
                                </button>
                                <button name="filter_detail_gia" data-tab='chua bam' value="gia_sp BETWEEN 4000000 AND 7000000" type="button" class="btn btn-outline-primary p-1 text-filter-btn">
                                    Từ 4 - 7 Triệu
                                </button>
                                <button name="filter_detail_gia" data-tab='chua bam' value="gia_sp BETWEEN 7000000 AND 13000000" type="button" class="btn btn-outline-primary p-1 text-filter-btn">
                                    Từ 7 - 13 Triệu
                                </button>
                                <button name="filter_detail_gia" data-tab='chua bam' value="gia_sp BETWEEN 13000000 AND 20000000" type="button" class="btn btn-outline-primary p-1 text-filter-btn">
                                    Từ 13 - 20 Triệu
                                </button>
                                <button name="filter_detail_gia" data-tab='chua bam' value="gia_sp > 20000000" type="button" class="btn btn-outline-primary p-1 text-filter-btn">
                                    Trên 20 Triệu
                                </button>
                            </div>
                            <div class="col-6">
                                <b class="text-filter-details">Hệ Điều Hành</b> <br>
                                <?php
                                $sql = "SELECT DISTINCT hdh.id_hdh, hdh.ten_hdh FROM `dienthoai` dt, `hedieuhanh` hdh WHERE dt.id_hdh = hdh.id_hdh";
                                $query = mysqli_query($con, $sql);
                                while ($result = mysqli_fetch_array($query)) {
                                    if ($result['id_hdh'] != 1) {
                                ?>
                                        <button name="filter_detail" data-tab='chua bam' value="id_hdh=<?php echo $result['id_hdh'] ?>" type="button" class="btn btn-outline-primary p-1 text-filter-btn" style="text-transform: capitalize; min-width: 80px;">
                                            <?php echo $result['ten_hdh'] ?>
                                        </button>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>

                        <div class="row">
                            <div class="col-6">
                                <b class="text-filter-details">RAM</b> <br>
                                <?php
                                $sql = "SELECT DISTINCT ram.id_ram, ram.dung_luong_ram FROM `dienthoai` dt, `ram` ram WHERE dt.id_ram = ram.id_ram";
                                $query = mysqli_query($con, $sql);
                                while ($result = mysqli_fetch_array($query)) {
                                    if ($result['id_ram'] != 1) {
                                ?>
                                        <button name="filter_detail" data-tab='chua bam' value="id_ram=<?php echo $result['id_ram'] ?>" type="button" class="btn btn-outline-primary p-1 text-filter-btn" style="text-transform: capitalize; min-width: 50px;">
                                            <?php echo $result['dung_luong_ram'] ?>
                                        </button>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-6">
                                <b class="text-filter-details">Bộ Nhớ Trong</b> <br>
                                <?php
                                $sql = "SELECT DISTINCT bn.id_bn, bn.dung_luong_bn FROM `dienthoai` dt, `bonho` bn WHERE dt.id_bn = bn.id_bn";
                                $query = mysqli_query($con, $sql);
                                while ($result = mysqli_fetch_array($query)) {
                                    if ($result['id_bn'] != 1) {
                                ?>
                                        <button name="filter_detail" data-tab='chua bam' value="id_bn=<?php echo $result['id_bn'] ?>" type="button" class="btn btn-outline-primary p-1 text-filter-btn" style="text-transform: capitalize; min-width: 50px;">
                                            <?php echo $result['dung_luong_bn'] ?>
                                        </button>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>

                        <div class="row">
                            <div class="col-6">
                                <b class="text-filter-details">Thiết Kế</b> <br>
                                <?php
                                $sql = "SELECT DISTINCT tk.id_tk, tk.kieu_tk FROM `dienthoai` dt, `thietke` tk WHERE dt.id_tk = tk.id_tk";
                                $query = mysqli_query($con, $sql);
                                while ($result = mysqli_fetch_array($query)) {
                                    if ($result['id_tk'] != 1) {
                                ?>
                                        <button name="filter_detail" data-tab='chua bam' value="id_tk=<?php echo $result['id_tk'] ?>" type="button" class="btn btn-outline-primary p-1 text-filter-btn" style="text-transform: capitalize; min-width: 80px;">
                                            <?php echo $result['kieu_tk'] ?>
                                        </button>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-6">
                                <b class="text-filter-details">Màn HÌnh</b> <br>
                                <?php
                                $sql = "SELECT DISTINCT mh.id_mh, mh.kich_thuoc_mh FROM `dienthoai` dt, `manhinh` mh WHERE dt.id_mh = mh.id_mh";
                                $query = mysqli_query($con, $sql);
                                while ($result = mysqli_fetch_array($query)) {
                                    if ($result['id_mh'] != 1) {
                                ?>
                                        <button name="filter_detail" data-tab='chua bam' value="id_mh=<?php echo $result['id_mh'] ?>" type="button" class="btn btn-outline-primary p-1 text-filter-btn" style="text-transform: capitalize; min-width: 60px;">
                                            <?php echo $result['kich_thuoc_mh'] ?>
                                        </button>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div id="btn-filter-results" class="col-12 text-center" hidden>
                                <a id="btn-remove-filter" class="btn btn-secondary text-filter-details">
                                    Bỏ Chọn
                                </a>
                                <a id="ket_qua_filter" href="search_results.php" class="btn btn-primary text-filter-details">
                                    Xem Kết Quả
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sản phẩm -->
    <div class="container mb-3">
        <div class="pl-3 pr-3">
            <div class="row" id="show_product">
                <!-- hiển thị ĐIỆN THOẠI -->
                <?php
                while ($result_all_dienthoai = mysqli_fetch_array($query_all_dienthoai)) {
                    $khuyenmai = get_khuyenmai($result_all_dienthoai['id_km']);
                    $gia_old = money_format($result_all_dienthoai['gia_sp']);
                    $gia_new = price_after_promotion($result_all_dienthoai['gia_sp'], $khuyenmai['giam_km']);
                    $gia_new = money_format($gia_new);
                ?>
                    <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
                        <div class="card float-left bg-white hover-product div-product magin-1">
                            <a href="product_detail.php?id_product=<?php echo $result_all_dienthoai['id_sp'] ?>" class="a-top-product">
                                <img src="<?php echo $result_all_dienthoai['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
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
                                        <p class="text-name-product"><?php echo $result_all_dienthoai['ten_sp'] ?></p>

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