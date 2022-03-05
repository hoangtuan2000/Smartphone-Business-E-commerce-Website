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
        <title>Tài Khoản - HT Shop</title>

        <script src="vendor/jquery/jquery.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/vue/dist/vue.js"></script>

        <script src="javascript/javascript-ajax-login.js"></script>
        <script src="javascript/javascript-ajax-choose-address.js"></script>
        <script src="javascript/javascript-ajax-account-management.js"></script>

        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" type="text/css">

        <link rel="stylesheet" href="styles/style-base.css" type="text/css">
        <link rel="stylesheet" href="styles/style-account.css" type="text/css">

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
        $result_kh = get_khachhang($_SESSION['user']['id_kh']);
        $diachi = get_diachi_mac_dinh($result_kh['id_kh']);
        $xaphuong = get_xaphuong($diachi['id_xp']);
        $quanhuyen = get_quanhuyen($xaphuong['id_qh']);
        $tinhthanhpho = get_tinhthanhpho($quanhuyen['id_ttp']);
        $diachi = $diachi['dia_chi'] . " - " . $xaphuong['ten_xp'] . " - " . $quanhuyen['ten_qh'] . " - " . $tinhthanhpho['ten_ttp'];
        ?>


        <div class="container">
            <div class="row p-4 m-1 mb-2 rounded justify-content-center" style="background-color: #ffffffc9;">
                <!-- hiển thị thông tin tài khoản -->
                <div class="col-12 mt-1 mb-1 p-4 pt-2 shadow-lg bg-white" style="border-radius: 10px;">
                    <div class="mb-2 text-center text-header">
                        <span>Thông Tin Tài Khoản</span>
                    </div>

                    <!-- lưu id khách hàng -->
                    <input id="update_id" value="<?php echo $result_kh['id_kh'] ?>" type="text" hidden>

                    <div class="form-group row">
                        <div class="col-6">
                            <label for="update_ten">Họ Tên:</label>
                            <input id="update_ten" value="<?php echo $result_kh['ten_kh'] ?>" type="text" class="form-control form-control-sm">
                            <small id="update_ten_help" class="form-text text-danger"></small>
                        </div>
                        <div class="col-6">
                            <label for="update_email">Email:</label>
                            <input id="update_email" value="<?php echo $result_kh['email_kh'] ?>" type="text" class="form-control form-control-sm">
                            <small id="update_email_help" class="form-text text-danger"></small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-3">
                            <label for="update_sdt">Số Điện Thoại:</label>
                            <input id="update_sdt" value="<?php echo $result_kh['sdt_kh'] ?>" type="text" class="form-control form-control-sm">
                            <small id="update_sdt_help" class="form-text text-danger"></small>
                        </div>
                        <div class="col-9">
                            <label for="">Địa Chỉ:</label>
                            <input readonly value="<?php echo $diachi ?>" type="text" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="col-12 text-center mb-3">
                        <button id="btn-update-account" type="button" class="btn btn-primary btn-sm">Lưu Thông Tin Tài Khoản</button>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_matkhau">Thay Đổi Mật Khẩu</button>
                    </div>
                </div>

                <!-- cập nhật địa chỉ -->
                <p id="show_update_diachi"></p>
                <div class="col-12 mt-2 mb-2 pb-4 pt-2 shadow-lg bg-white" style="border-radius: 10px;">
                    <div class="mb-2 text-center text-header">
                        <span>Quản Lý Địa Chỉ</span>
                    </div>

                    <!-- thêm địa chỉ -->
                    <div class="form-row border rounded p-2 mb-3">
                        <div class="form-group col-md-3">
                            <label for="sl_tinhthanhpho">Tỉnh Thành Phố</label>
                            <select id="sl_tinhthanhpho" class="form-control form-control-sm">
                                <option value="" selected>Chọn tỉnh thành phố</option>
                                <?php
                                while ($row_tinhthanhpho = mysqli_fetch_array($query_tinhthanhpho)) {
                                ?>
                                    <option value="<?= $row_tinhthanhpho['id_ttp'] ?>"><?= $row_tinhthanhpho['ten_ttp'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="sl_quanhuyen">Quận Huyện</label>
                            <select id="sl_quanhuyen" class="form-control form-control-sm" disabled>
                                <option value="" selected>Chọn quận huyện</option>
                                <?php
                                while ($row_quanhuyen = mysqli_fetch_array($query_quanhuyen)) {
                                ?>
                                    <option value="<?= $row_quanhuyen['id_qh'] ?>"><?= $row_quanhuyen['ten_qh'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="sl_xaphuong">Xã Phường</label>
                            <select id="sl_xaphuong" class="form-control form-control-sm" disabled>
                                <option value="" selected>Chọn xã phường</option>
                                <?php
                                while ($row_xaphuong = mysqli_fetch_array($query_xaphuong)) {
                                ?>
                                    <option value="<?= $row_xaphuong['id_xp'] ?>"><?= $row_xaphuong['ten_xp'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="insert_dia_chi_khach_hang">Số nhà/tên đường</label>
                            <input id="insert_dia_chi_khach_hang" type="text" class="form-control form-control-sm">
                            <small id="insert_dia_chi_khach_hang_help" class="form-text text-danger"></small>
                        </div>
                        <!-- nút thêm địa chỉ -->
                        <div class="col-12 text-center">
                            <button id="btn-insert-diachi" type="button" class="btn btn-success btn-sm w-25">
                                Thêm Địa Chỉ
                            </button>
                        </div>
                    </div>

                    <div id="show_diachi">
                        <!-- cập nhật địa chỉ -->
                        <?php
                        $id_kh = $_SESSION['user']['id_kh'];
                        $query_all_diachi = get_all_diachi($id_kh);
                        while ($result_all_diachi = mysqli_fetch_array($query_all_diachi)) {
                            $id_dc = $result_all_diachi['id_dc'];
                            $diachi_mac_dinh = get_diachi_mac_dinh($id_kh);
                            $xaphuong = get_xaphuong($result_all_diachi['id_xp']);
                            $quanhuyen = get_quanhuyen($xaphuong['id_qh']);
                            $tinhthanhpho = get_tinhthanhpho($quanhuyen['id_ttp']);
                            $diachi = $result_all_diachi['dia_chi'] . "-" . $xaphuong['ten_xp'] . "-" . $quanhuyen['ten_qh'] . "-" . $tinhthanhpho['ten_ttp'];
                        ?>
                            <div class="input-group mb-2">
                                <!-- hiển thị đia chỉ -->
                                <?php
                                if ($result_all_diachi['id_dc'] == $diachi_mac_dinh['id_dc']) {
                                ?>
                                    <input name="<?php echo $id_dc ?>" value="<?php echo $diachi ?> ( mặc định )" readonly type="text" class="form-control input-order form-control-sm">
                                <?php
                                } else {
                                ?>
                                    <input name="<?php echo $id_dc ?>" value="<?php echo $diachi ?>" readonly type="text" class="form-control input-order form-control-sm">
                                <?php
                                }
                                ?>


                                <div class="input-group-prepend">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdown-update-diachi" data-toggle="dropdown">
                                            Chỉnh Sửa
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right text-center p-1" aria-labelledby="dropdown-update-diachi">

                                            <!-- //nếu khác địa chỉ mặc định thì mới cho chọn làm mặc định và xóa -->
                                            <?php
                                            if ($result_all_diachi['id_dc'] != $diachi_mac_dinh['id_dc']) {
                                            ?>
                                                <button name="btn_modal_update_diachi" value="<?php echo $id_dc ?>" class="btn btn-warning btn-sm rounded w-100 mb-1" type="button">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    Cập Nhật
                                                </button>
                                                <button name="btn_change_diachi_mac_dinh" value="<?php echo $id_dc ?>" class="btn btn-success btn-sm rounded w-100 mb-1" type="button">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    Chọn Mặc Định
                                                </button>
                                                <button name="btn_delete_diachi" value="<?php echo $id_dc ?>" class="btn btn-danger btn-sm rounded w-100 mb-1" type="button">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    Xóa
                                                </button>
                                            <?php
                                            } else {
                                            ?>
                                                <p><b>Địa chỉ mặc định</b></p>
                                                <button name="btn_modal_update_diachi" value="<?php echo $id_dc ?>" class="btn btn-warning btn-sm rounded w-100 mb-1" type="button">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    Cập Nhật
                                                </button>
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

                <!-- hiên thị hóa đơn gần đây -->
                <div id="show_don_hang_gan_day" class="col-12 mt-2 mb-4 pb-4 pt-2 shadow-lg bg-white" style="border-radius: 10px;">
                    <div class="ml-2 text-center text-header-menu">
                        <p>
                            Đơn Đặt Hàng Gần Đây
                        </p>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 100px;">Đơn Hàng</th>
                                <th class="text-center">Tên Sản Phẩm</th>
                                <th class="text-center" style="width: 160px;">Ngày Đặt</th>
                                <th class="text-center">Tổng Tiền</th>
                                <th class="text-center" style="width: 100px;">Chi Tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query_donhang = get_recent_donhang($result_kh['id_kh']);
                            $num = mysqli_num_rows($query_donhang);
                            if ($num > 0) {
                                while ($result_donhang = mysqli_fetch_array($query_donhang)) {
                                    $id_dh = $result_donhang['id_dh'];
                                    $query_chitietdonhang = get_chitietdonhang($id_dh);
                                    $tong_tien = 0;
                            ?>
                                    <tr>
                                        <td class="align-middle text-center"><?php echo $result_donhang['id_dh'] ?></td>
                                        <td class="align-middle">
                                            <ul class="pl-3 mb-0">
                                                <?php

                                                while ($result_chitietdonhang = mysqli_fetch_array($query_chitietdonhang)) {
                                                    $so_luong = $result_chitietdonhang['so_luong'];
                                                    $gia_old = $result_chitietdonhang['gia'];
                                                    $khuyenmai = $result_chitietdonhang['khuyen_mai'];
                                                    $gia_new = price_after_promotion($gia_old, $khuyenmai);
                                                    $tong_tien += $gia_new * $so_luong;
                                                    $id_sp = $result_chitietdonhang['id_sp'];
                                                    $product = get_sanpham($id_sp);
                                                    // $ten_san_pham = "<li>". $product['ten_sp'] . "<li/> <li>" . $ten_san_pham . "<li/>";
                                                ?>

                                                    <li><?php echo $product['ten_sp'] ?></li>

                                                <?php
                                                }
                                                $tong_tien = money_format($tong_tien);
                                                ?>

                                            </ul>
                                        </td>
                                        <td class="align-middle"><?php echo $result_donhang['ngay_dat'] ?></td>
                                        <td class="text-right align-middle"><?php echo $tong_tien ?> VND</td>
                                        <td class="align-middle">
                                            <a href="order_detail.php?id_dh=<?php echo $result_donhang['id_dh'] ?>" class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                xem
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_donhang">Xem tất cả đơn hàng</button>
                                    </td>
                                </tr>
                            <?php
                            } else {
                            ?>
                                <tr>
                                    <td colspan="5" class="text-center"><b>Bạn Chưa Có Đơn Hàng Nào</b></td>
                                </tr>
                            <?php
                            }
                            ?>

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