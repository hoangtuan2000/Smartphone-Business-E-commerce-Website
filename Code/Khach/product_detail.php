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

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
?>

<?php
if (isset($_GET['id_product']) && !empty($_GET['id_product'])) {
    $id_sp = $_GET['id_product'];
    $result_product = get_sanpham($id_sp);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $result_product['ten_sp'] ?> - HT SHOP</title>

        <script src="vendor/jquery/jquery.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <script src="javascript/javascript-ajax-login.js"></script>
        <script src="javascript/javascript-ajax-cart-management.js"></script>
        <script src="javascript/javascript-ajax-order-management.js"></script>

        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" type="text/css">

        <link rel="stylesheet" href="styles/style-base.css" type="text/css">
        <link rel="stylesheet" href="styles/style-product-details.css" type="text/css">
    </head>

    <body id="top">
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

        <!-- hiển thị chi tiết sản phẩm -->
        <div class="container mg-2">
            <div class="row bg-white m-1 pt-4 rounded">
                <!-- hiển thị hình ảnh -->
                <div class="col-md-7">
                    <div id="image_product" class="carousel slide" data-ride="carousel" data-interval="100000">
                        <ol class="carousel-indicators">
                            <li data-target="#image_product" data-slide-to="0" class="active"></li>
                            <li data-target="#image_product" data-slide-to="1"></li>
                            <li data-target="#image_product" data-slide-to="2"></li>
                            <li data-target="#image_product" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner rounded">
                            <div class="carousel-item active">
                                <!-- biến  $result_product lấy phía trên tilte-->
                                <img src="<?php echo $result_product['anh_sp'] ?>" class="d-block w-100 object-fit-contain image-product-detail" alt="First slide">
                            </div>

                            <?php
                            // biến $id_sp lấy trên tilte
                            $query_anhsanpham = get_anhsanpham($id_sp);
                            while ($result_anhsanpham = mysqli_fetch_array($query_anhsanpham)) {
                            ?>
                                <div class="carousel-item">
                                    <img src="<?php echo $result_anhsanpham['anh_asp'] ?>" class="d-block w-100 object-fit-contain image-product-detail" alt="Second slide">
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#image_product" role="button" data-slide="prev">
                            <div class="background-blue p-1 pt-2 rounded">
                                <span class="carousel-control-prev-icon icon-slider" aria-hidden="true"></span>
                            </div>
                        </a>
                        <a class="carousel-control-next" href="#image_product" role="button" data-slide="next">
                            <div class="background-blue p-1 pt-2 rounded">
                                <span class="carousel-control-next-icon icon-slider" aria-hidden="true"></span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- hiển thị tên, giá sản phẩm -->
                <div class="col-md-5 pl-1 mb-2">
                    <div class="bg-white">
                        <p class="text-name-product-detail"><?php echo $result_product['ten_sp'] ?></p>
                        <p class="icon-star">
                            <i class="fa fa-star " aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        </p>

                        <?php
                        if (isset($_GET['id_product']) && !empty($_GET['id_product'])) {
                            $id_sp = $_GET['id_product'];
                            $result_product = get_sanpham($id_sp);
                            $nuocsanxuat = get_nuocsanxuat($result_product['id_nsx']);
                            $khuyenmai = get_khuyenmai($result_product['id_km']);
                            $gia_old = $result_product['gia_sp'];
                            $gia_new = price_after_promotion($gia_old, $khuyenmai['giam_km']);
                            $id_lsp = $result_product['id_lsp'];
                            switch ($id_lsp) {
                                case "DT":
                                    $result_dienthoai = get_dienthoai($id_sp);
                                    $bonho = get_bonho($result_dienthoai['id_bn']);
                                    $ram = get_ram($result_dienthoai['id_ram']);
                                    $thuonghieu = get_thuonghieu($result_dienthoai['id_th']);
                                    $hedieuhanh = get_hedieuhanh($result_dienthoai['id_hdh']);
                                    $thietke = get_thietke($result_dienthoai['id_tk']);
                                    $chip = get_chip($result_dienthoai['id_chip']);
                                    $manhinh = get_manhinh($result_dienthoai['id_mh']);
                                    break;

                                case "TN":
                                    $result_tainghe = get_tainghe($id_sp);
                                    $thuonghieu = get_thuonghieu($result_tainghe['id_th']);
                                    $loaiketnoi = get_loaiketnoi($result_tainghe['id_lkn']);
                                    break;
                                case "OL":
                                    $result_oplung = get_oplung($id_sp);
                                    $thuonghieu = get_thuonghieu($result_oplung['id_th']);
                                    $chatlieu = get_chatlieu($result_oplung['id_cl']);
                                    break;
                            }
                        }

                        if ($result_product['id_ttsp'] != "NKD") {
                        ?>
                            <!-- hiển thị giá cũ -->
                            <?php
                            if ($khuyenmai['giam_km'] != 0) {
                            ?>
                                <p class="text-price-old-detail"><?php echo money_format($gia_old) ?></p>
                                <!-- hiển thị giá mới -->
                                <p class="text-price-new-detail"><?php echo money_format($gia_new) . " VNĐ (Giảm " . $khuyenmai['giam_km'] . "%)" ?></p>

                            <?php
                            } else {
                            ?>
                                <p></p>
                                <!-- hiển thị giá mới -->
                                <p class="text-price-new-detail"><?php echo money_format($gia_new) . " VNĐ" ?></p>
                            <?php
                            }
                            ?>


                            <div class="mb-2">
                                <!-- khi nhấn nút mua và thêm vào giỏ hàng thì kiểm tra từ input xem có đăng nhập chưa qua input "insert_cart_user" -->
                                <?php
                                if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                                ?>
                                    <input hidden id="insert_cart_user" value="<?php echo $_SESSION['user']['id_kh'] ?>" type="text">
                                <?php
                                } else {
                                ?>
                                    <input hidden id="insert_cart_user" value="" type="text">
                                <?php
                                }
                                ?>

                                <?php
                                if ($result_product['so_luong_sp'] != "0") {
                                ?>
                                    <p>
                                        Trạng thái sản phẩm: còn <?php echo money_format($result_product['so_luong_sp']) ?> sản phẩm
                                    </p>
                                    <a id="btn-datmua" href="order.php?order_id_product=<?php echo $result_product['id_sp'] ?>" type="button" class="btn rounded btn-buy mr-1">
                                        <i class="fa fa-hand-pointer-o" aria-hidden="true"></i>
                                        &nbsp;Đặt Mua
                                    </a>
                                    <button id="btn-add-cart" name="btn-add-cart" value="<?php echo $result_product['id_sp'] ?>" type="button" class="btn rounded btn-add-cart">
                                        <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                        &nbsp;Thêm Vào Giỏ Hàng
                                    </button>
                                <?php
                                } else {
                                ?>
                                    <p>
                                        Trạng thái sản phẩm: <font style="color: red; font-weight: bold;">Hết Hàng</font>
                                    </p>
                                <?php
                                }
                                ?>

                            </div>
                            <div class="border border-primary mt-2">
                                <div class="text-header-warranty">
                                    Chính Sách Bảo Hành
                                </div>
                                <p class="m-2 text-content-warranty">
                                    <i class="fa fa-shield text-primary" aria-hidden="true"></i>
                                    Bảo Hành Chính Hãng 2 Năm
                                </p>
                                <p class="m-2 text-content-warranty">
                                    <i class="fa fa-wrench text-primary" aria-hidden="true"></i>
                                    Hư Gì Đổi Nấy
                                </p>
                            </div>
                        <?php
                        } else {
                        ?>
                            <!-- hiển thị thông báo sản phẩm NGƯNG KINH DOANH -->
                            <p class="text-price-new-detail">NGƯNG KINH DOANH</p>
                        <?php
                        }
                        ?>

                    </div>
                </div>


                <div class="col-md-12 mt-2">
                    <p>
                        <button class="btn btn-product-detail-default" type="button" id="btn-product-introduction">
                            Giới Thiệu Sản Phẩm
                        </button>
                        <button class="btn btn-product-detail" type="button" id="btn-product-configuration-information">
                            Thông Tin Cấu Hình
                        </button>
                    </p>
                    <!-- hiển thị giới thiệu -->
                    <div class="collapse show" id="intro-content">
                        <div class="card card-body min-height-400">
                            <p class="text-header-info">Giới Thiệu Sản Phẩm</p>
                            <div class="text-content-intro">
                                <p>
                                    <?php echo $result_product['gioi_thieu_sp'] ?>
                                </p>
                                <a href="#top" class="btn btn-secondary btn-sm float-right">
                                    Lên Đầu Trang
                                    <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- hiển thị cấu hình smartphone -->
                    <?php
                    if ($id_lsp == "DT") {
                    ?>
                        <div class="collapse" id="configuration-information-content">
                            <div class="card card-body min-height-400">
                                <p class="text-header-info">Thông Tin Cấu Hình</p>
                                <table class="table w-50 mx-auto shadow">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">Bộ Nhớ Trong</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Dung lượng bộ nhớ:</th>
                                            <td><?php echo $bonho['dung_luong_bn'] ?></td>
                                        </tr>
                                    </tbody>

                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">RAM</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Dung lượng RAM:</th>
                                            <td><?php echo $ram['dung_luong_ram'] ?></td>
                                        </tr>
                                    </tbody>

                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">Thương Hiệu</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Tên thương hiệu:</th>
                                            <td><?php echo $thuonghieu['ten_th'] ?></td>
                                        </tr>
                                    </tbody>

                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">Hệ Điều Hành</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Hệ điều hành:</th>
                                            <td><?php echo $hedieuhanh['ten_hdh'] ?></td>
                                        </tr>
                                    </tbody>

                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">Thiết Kế</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Kiểu thiết kế:</th>
                                            <td><?php echo $thietke['kieu_tk'] ?></td>
                                        </tr>
                                    </tbody>

                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">Chip Xử Lý</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Tên Chip xử lý:</th>
                                            <td><?php echo $chip['ten_chip'] ?></td>
                                        </tr>
                                    </tbody>

                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">Màn Hình</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Kích thước màn hình:</th>
                                            <td><?php echo $manhinh['kich_thuoc_mh'] ?></td>
                                        </tr>
                                    </tbody>

                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">Nước Sản Xuất</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Xuất xứ:</th>
                                            <td><?php echo $nuocsanxuat['ten_nsx'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    <a href="#top" class="btn btn-secondary btn-sm float-right">
                                        Lên Đầu Trang
                                        <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                        //hiển thị cấu hình tai nghe
                    } else if ($id_lsp == "TN") {
                    ?>
                        <div class="collapse" id="configuration-information-content">
                            <div class="card card-body min-height-400">
                                <p class="text-header-info">Thông Tin Cấu Hình</p>
                                <table class="table w-50 mx-auto shadow">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">Thương Hiệu</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Tên thương hiệu:</th>
                                            <td><?php echo $thuonghieu['ten_th'] ?></td>
                                        </tr>
                                    </tbody>

                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">Loại Kết Nối</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Loại kết nối:</th>
                                            <td><?php echo $loaiketnoi['ten_lkn'] ?></td>
                                        </tr>
                                    </tbody>

                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">Nước Sản Xuất</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Nước sản xuất:</th>
                                            <td><?php echo $nuocsanxuat['ten_nsx'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php
                        //hiển thị cấu hình ốp lưng
                    } else if ($id_lsp == "OL") {
                    ?>
                        <div class="collapse" id="configuration-information-content">
                            <div class="card card-body min-height-400">
                                <p class="text-header-info">Thông Tin Cấu Hình</p>
                                <table class="table w-50 mx-auto shadow">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">Thương Hiệu</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Tên thương hiệu:</th>
                                            <td><?php echo $thuonghieu['ten_th'] ?></td>
                                        </tr>
                                    </tbody>

                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">Chất Liệu</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Chất liệu:</th>
                                            <td><?php echo $chatlieu['ten_cl'] ?></td>
                                        </tr>
                                    </tbody>

                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-table-header-config-info">Nước Sản Xuất</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-table-content">
                                        <tr>
                                            <th>Nước sản xuất:</th>
                                            <td><?php echo $nuocsanxuat['ten_nsx'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
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


        <!-- ############################### script ##################################### -->
        <script>
            $(function() {
                // click nút xem giới thiệu sản phẩm
                $('#btn-product-introduction').click(function() {
                    $('#intro-content').addClass('show');
                    $('#configuration-information-content').removeClass('show');
                    $('#btn-product-introduction').css("background", "#007bff");
                    $('#btn-product-configuration-information').css("background", "grey");
                })
                //click nút xem cấu hình sản phẩm
                $('#btn-product-configuration-information').click(function() {
                    $('#intro-content').removeClass('show');
                    $('#configuration-information-content').addClass('show');
                    $('#btn-product-introduction').css("background", "grey");
                    $('#btn-product-configuration-information').css("background", "#007bff");
                })
            })
        </script>


    </body>

    </html>
<?php
}
?>