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


<?php
if (isset($_SESSION['user'])) {
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
        <script src="javascript/javascript-ajax-order-detail-management.js"></script>

        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" type="text/css">

        <link rel="stylesheet" href="styles/style-base.css" type="text/css">
        <link rel="stylesheet" href="styles/style-order.css" type="text/css">
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
        if (isset($_GET['id_dh']) && !empty($_GET['id_dh'])) {
            $id_dh = $_GET['id_dh'];
            $result_donhang = get_donhang($id_dh);
            $result_trangthaidonhang = get_trangthaidonhang($result_donhang['id_ttdh']);
        }

        ?>
        <!-- lưu tên trạng thái đơn hàng để tô màu cho icon -->
        <input id="input_ten_ttdh" value="<?php echo $result_trangthaidonhang['ten_ttdh'] ?>" type="text" hidden>

        <div class="container">
            <div class="row bg-white m-1 mb-3 rounded">
                <div class="col-12 text-center mt-3">
                    <p style="font-size: 25px; color: blue; font-weight: bold;">
                        Trạng Thái Đơn Hàng
                    </p>
                </div>

                <!-- hiển thị trạng thái đơn hàng -->
                <div class="col-12 text-center p-3 mb-3">
                    <div class="row mx-auto">
                        <div name="icon_chuaxuly" class="float-left text-center ml-auto p-0 m-1" style="opacity: 0.5;">
                            <i class="fa fa-dropbox fa-2x" aria-hidden="true"></i>
                            <br> <span class="text-12">Chưa Xử Lý</span>
                        </div>
                        <div name="icon_chuaxuly" class="float-left text-center p-0 m-1" style="opacity: 0.5;">
                            <i class="fa fa-long-arrow-right fa-2x" aria-hidden="true"></i>
                        </div>
                        <div name="icon_daxuly" class="float-left text-center p-0 m-1" style="opacity: 0.5;">
                            <i class="fa fa-gift fa-2x" aria-hidden="true"></i>
                            <br> <span class="text-12">Đã Xử Lý</span>
                        </div>
                        <div name="icon_daxuly" class="float-left text-center p-0 m-1" style="opacity: 0.5;">
                            <i class="fa fa-long-arrow-right fa-2x" aria-hidden="true"></i>
                        </div>
                        <div name="icon_dangvanchuyen" class="float-left text-center p-0 m-1" style="opacity: 0.5;">
                            <i class="fa fa-truck fa-2x" aria-hidden="true"></i>
                            <br><span class="text-12">Đang Vận Chuyển</span>
                        </div>
                        <div name="icon_dangvanchuyen" class="float-left text-center p-0 m-1" style="opacity: 0.5;">
                            <i class="fa fa-long-arrow-right fa-2x" aria-hidden="true"></i>
                        </div>
                        <div name="icon_danggiaohang" class="float-left text-center p-0 m-1" style="opacity: 0.5;">
                            <i class="fa fa-cubes fa-2x" aria-hidden="true"></i>
                            <br><span class="text-12">Đang Giao Hàng</span>
                        </div>
                        <div name="icon_danggiaohang" class="float-left text-center p-0 m-1" style="opacity: 0.5;">
                            <i class="fa fa-long-arrow-right fa-2x" aria-hidden="true"></i>
                        </div>
                        <div name="icon_giaohangthanhcong" class="float-left text-center mr-auto p-0 m-1" style="opacity: 0.5;">
                            <i class="fa fa-check-square-o fa-2x" aria-hidden="true"></i>
                            <br><span class="text-12">Giao Thành Công</span>
                        </div>
                    </div>
                </div>

                <!-- hiển thị thông tin sản phẩm -->
                <div class="col-12 min-height-600">
                    <p>
                        <b> Số Đơn Hàng:</b>
                        <?php echo $result_donhang['id_dh'] ?>
                    </p>
                    <p>
                        <b> Ngày Đặt Hàng:</b>
                        <?php echo $result_donhang['ngay_dat'] ?>
                    </p>
                    <p>
                        <b> Người Nhận:</b>
                        <?php echo $result_donhang['nguoi_nhan'] ?>
                    </p>
                    <p>
                        <b> Số Điện Thoại:</b>
                        <?php echo $result_donhang['so_dien_thoai'] ?>
                    </p>
                    <p>
                        <b> Địa Chỉ Giao Hàng:</b>
                        <?php echo $result_donhang['dia_chi_giao'] ?>
                    </p>

                    <table class="table table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th style="width: 90px;"></th>
                                <th>Tên Sản Phẩm</th>
                                <th style="width: 100px;">Số Lượng</th>
                                <th>Giá</th>
                                <th>Thành Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            $tong_tien = 0;
                            $query_chitietdonhang = get_chitietdonhang($result_donhang['id_dh']);
                            while ($result_chitietdonhang = mysqli_fetch_array($query_chitietdonhang)) {
                                $id_sp = $result_chitietdonhang['id_sp'];
                                $product = get_sanpham($id_sp);
                                $gia_old = $result_chitietdonhang['gia']; 
                                $so_luong = $result_chitietdonhang['so_luong']; 
                                $khuyen_mai = $result_chitietdonhang['khuyen_mai'];
                                $gia_new = price_after_promotion($gia_old, $khuyen_mai);
                                $thanh_tien = $gia_new * $so_luong;
                                $tong_tien += $thanh_tien; 
                            ?>
                                <tr>
                                    <td class="p-1 align-middle">
                                        <img src="<?php echo $product['anh_sp']; ?>" alt="" class="table-image-product">
                                    </td>
                                    <td class="align-middle">
                                        <a href="product_detail.php?id_product=<?= $id_sp ?>"><?php echo $product['ten_sp'] ?></a>
                                    </td>
                                    <td class="align-middle"><?php echo $result_chitietdonhang['so_luong'] ?></td>
                                    <td class="align-middle"><?php echo money_format($gia_new) ?> VNĐ</td>
                                    <td class="text-right align-middle"><?php echo money_format($thanh_tien) ?> VNĐ</td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="5" class="text-right">
                                    <span style="color: red;"><b>Tổng Tiền:</b></span>
                                    <span>
                                        <?php echo money_format($tong_tien) ?> VNĐ
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- footer -->
        <?php
        include 'footer.php';
        ?>
    </body>

    </html>
<?php
} else {
    header('Location: index.php');
}
?>