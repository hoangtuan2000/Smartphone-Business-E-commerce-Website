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
if (isset($_SESSION['user'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đặt Hàng - HT Shop</title>

        <script src="vendor/jquery/jquery.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <script src="javascript/javascript-ajax-choose-address.js"></script>
        <script src="javascript/javascript-ajax-login.js"></script>
        <script src="javascript/javascript-ajax-order-management.js"></script>
        <script src="javascript/javascript-ajax-cart-management.js"></script>

        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" type="text/css">

        <link rel="stylesheet" href="styles/style-base.css" type="text/css">
        <link rel="stylesheet" href="styles/style-cart.css" type="text/css">
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

        <!-- Đặt Hàng -->
        <div class="container mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="bg-white rounded p-2 min-width-1000">
                        <p class="text-cart">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            Đặt Hàng
                        </p>

                        <!-- code hiển thị giỏ hàng bên trang cart (tận dụng lại code nhưng khác chổ nút đặt hàng nên ko thể tách thành trang riêng để include) -->
                        <!-- nếu đặt mua từ giỏ hàng thì hiển thị ra thông tin giỏ hàng -->
                        <?php
                        if (isset($_GET['cart'])) {
                        ?>
                            <table id="table-cart" class="table table-hover text-table-cart table-bordered">
                                <thead>
                                    <tr>
                                        <th class="p-1 text-center">STT</th>
                                        <td class="p-1"></td>
                                        <th class="p-1 text-center input-name-product">Tên Sản Phẩm</th>
                                        <th class="p-1 text-center input-sum-product">Số Lượng</th>
                                        <th class="p-1 text-center">Giá</th>
                                        <th class="p-1 text-center">Thành Tiền</th>
                                        <th class="p-1 text-center" style="width: 100px;">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $giohang = get_giohang($_SESSION['user']['id_kh']);
                                    $query_chitietgiohang = get_chitietgiohang($giohang['id_gh']);
                                    $num = mysqli_num_rows($query_chitietgiohang);
                                    $index = 1;
                                    $tong_tien = 0;
                                    if ($num > 0) {
                                        while ($result_chitietgiohang = mysqli_fetch_array($query_chitietgiohang)) {
                                            $id_sp = $result_chitietgiohang['id_sp'];
                                            $so_luong = $result_chitietgiohang['so_luong'];
                                            $result_product = get_sanpham($id_sp);
                                            $gia_old = $result_product['gia_sp'];
                                            $khuyenmai = get_khuyenmai($result_product['id_km']);
                                            $gia_new = price_after_promotion($gia_old, $khuyenmai['giam_km']);
                                            $thanhtien = $gia_new * $so_luong;
                                            $tong_tien += $gia_new * $so_luong;
                                    ?>
                                            <tr>
                                                <th class="p-1 align-middle text-center">
                                                    <?php
                                                    echo $index;
                                                    ?>
                                                </th>
                                                <td class="table-image-cart p-1 align-middle">
                                                    <img src="<?php echo $result_product['anh_sp'] ?>" class="d-block w-100 img-thumbnail" alt="">
                                                </td>
                                                <td class="p-1 align-middle text-center">
                                                    <?php echo $result_product['ten_sp'] ?>
                                                </td>

                                                <!-- button tăng giảm số lượng -->
                                                <td class="p-1 align-middle">
                                                    <div class="input-group p-0">
                                                        <div class="input-group-prepend">
                                                            <button name="btn-minus" value="<?php echo $id_sp ?>" class="btn btn-primary p-0 btn-minus-plus" type="button">
                                                                <img src="asset/image-public/tru.png" class="d-block w-100" alt="">
                                                            </button>
                                                        </div>
                                                        <input data-item-id="input_so_luong" data-tab="<?php echo $id_sp ?>" id="input_so_luong_<?php echo $id_sp ?>" value="<?php echo $so_luong ?>" type="text" class="p-1 text-center input-number-product">
                                                        <div class="input-group-prepend">
                                                            <button name="btn-plus" value="<?php echo $id_sp ?>" class="btn btn-primary p-0 btn-minus-plus rounded-right" type="button">
                                                                <img src="asset/image-public/cong.png" class="d-block w-100" alt="">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="p-1 align-middle text-right price">
                                                    <?php echo money_format($gia_new); ?>
                                                </td>
                                                <td class="p-1 align-middle text-right price">
                                                    <span name="thanh_tien_<?php echo $result_chitietgiohang['id_sp'] ?>">
                                                        <?php echo money_format($thanhtien); ?>
                                                    </span>
                                                </td>

                                                <!-- nút xóa sản phẩm khỏi giỏ hàng -->
                                                <td class="p-0 align-middle text-center">
                                                    <button name="btn-delete-cart" value="<?php echo $id_sp ?>" type="button" class="border-0 hover-btn-remote">
                                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php
                                            $index++;
                                        }
                                        ?>
                                        <tr>
                                            <!-- input lưu tổng sản phẩm (có bao nhiêu sản phẩm) trong giỏ hàng -->
                                            <input name="quantity_product" value="<?php echo $index - 1; ?>" type="text" hidden>

                                            <td colspan="6" class="p-1 align-middle price text-right">
                                                <span class="text-total">
                                                    Tổng Tiền:&ensp;
                                                </span>
                                                <span id="tong_tien"><?php echo money_format($tong_tien) ?></span>
                                            </td>
                                            <td class="p-0 align-middle text-center">
                                                
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        }
                        ?>

                        <!-- nếu đặt mua thẳng bằng nút MUA thì hiện thông tin qua URL (biến GET) -->
                        <?php
                        if (isset($_GET['order_id_product']) && !empty($_GET['order_id_product'])) {
                            $id_sp = $_GET['order_id_product'];

                            $result_product = get_sanpham($id_sp);
                            $gia_old = $result_product['gia_sp'];
                            $khuyenmai = get_khuyenmai($result_product['id_km']);
                            $gia_new = price_after_promotion($gia_old, $khuyenmai['giam_km']);
                            $gia_new = money_format($gia_new);
                            //biến input_gia để lưu giá tiền chưa định dạng qua cho ajax xử lý thành tiền khi tăng giảm số lượng sản phẩm 
                            $input_gia = price_after_promotion($gia_old, $khuyenmai['giam_km']);
                        ?>
                            <table id="table-cart" class="table table-hover text-table-cart table-bordered">
                                <thead>
                                    <tr>
                                        <td class="p-1"></td>
                                        <th class="p-1 text-center input-name-product">Tên Sản Phẩm</th>
                                        <th class="p-1 text-center input-sum-product">Số Lượng</th>
                                        <th class="p-1 text-center">Giá</th>
                                        <th class="p-1 text-center">Thành Tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="table-image-cart p-1 align-middle">
                                            <img src="<?php echo $result_product['anh_sp'] ?>" class="d-block w-100 img-thumbnail" alt="">
                                        </td>
                                        <td class="p-1 align-middle text-center">
                                            <?php echo $result_product['ten_sp'] ?>
                                        </td>

                                        <!-- button tăng giảm số lượng -->
                                        <td class="p-1 align-middle">
                                            <div class="input-group p-0">
                                                <div class="input-group-prepend">
                                                    <button id="btn-minus-product-id" class="btn btn-primary p-0 btn-minus-plus" type="button">
                                                        <img src="asset/image-public/tru.png" class="d-block w-100" alt="">
                                                    </button>
                                                </div>
                                                <!-- input hiển thị số lượng sản phẩm -->
                                                <input id="input-quantity-product-id" value="1" type="text" class="p-1 text-center input-number-product">
                                                <div class="input-group-prepend">
                                                    <button id="btn-plus-product-id" class="btn btn-primary p-0 btn-minus-plus rounded-right" type="button">
                                                        <img src="asset/image-public/cong.png" class="d-block w-100" alt="">
                                                    </button>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-1 align-middle text-right price">
                                            <?php echo $gia_new ?>
                                        </td>
                                        <td id="thanh-tien" class="p-1 align-middle text-right price">
                                            <?php echo $gia_new ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="p-1 align-middle price text-right">
                                            <span class="text-total">
                                                Tổng Tiền:&ensp;
                                            </span>
                                            <span id="tong-tien"><?php echo $gia_new ?></span>
                                        </td>
                                    </tr>
                                    <!-- lưu giá tiền chưa định dạng để tính toán bên ajax order managent sau đó trả về giá tiền định dạng khi tăng giảm số lượng sản phẩm -->
                                    <input hidden id="input-gia-not-format" value="<?php echo $input_gia ?>" type="text">
                                    <!-- lưu id_sp sản phẩm để xử lý ajax xem có nhập số lượng > số lượng trong kho -->
                                    <input hidden id="input-id-sp" value="<?php echo $id_sp ?>" type="text">
                                </tbody>
                            </table>
                        <?php
                        }
                        ?>

                        <!-- khung nhập thông tin để đặt hàng -->
                        <div class="p-2">
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-6 form-group text-content-order">
                                        <?php
                                        $khachhang = $_SESSION['user'];
                                        $diachi_mac_dinh = get_diachi_mac_dinh($khachhang['id_kh']);
                                        $xaphuong = get_xaphuong($diachi_mac_dinh['id_xp']);
                                        $quanhuyen = get_quanhuyen($xaphuong['id_qh']);
                                        $tinhthanhpho = get_tinhthanhpho($quanhuyen['id_ttp']);
                                        $diachi = $diachi_mac_dinh['dia_chi'] . "-" . $xaphuong['ten_xp'] . "-" . $quanhuyen['ten_qh'] . "-" . $tinhthanhpho['ten_ttp'];
                                        ?>
                                        <!-- input lưu id khách hàng -->
                                        <input id="order_id_khachhang" value="<?php echo $khachhang['id_kh'] ?>" type="text" hidden>

                                        <label for="order_ten" class="col-form-label">Họ Tên:</label>
                                        <input id="order_ten" value="<?php echo $khachhang['ten_kh'] ?>" type="text" class="form-control input-order is-valid">
                                        <small id="order_ten_help" class="form-text text-danger"></small>

                                        <label for="order_sdt" class="col-form-label">Số Điện Thoại:</label>
                                        <input id="order_sdt" value="<?php echo $khachhang['sdt_kh'] ?>" type="text" class="form-control input-order is-valid">
                                        <small id="order_sdt_help" class="form-text text-danger"></small>

                                        <label for="order_email" class="col-form-label">Email:</label>
                                        <input disabled id="order_email" value="<?php echo $khachhang['email_kh'] ?>" type="text" class="form-control input-order">

                                        <label class="col-form-label">Địa chỉ giao hàng:</label>
                                        <div class="input-group">
                                            <!-- hiển thị địa chỉ giao hàng -->
                                            <input readonly id="order_dia_chi" value="<?php echo $diachi ?>" type="text" class="form-control input-order">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-primary btn-sm rounded-right input-order" type="button" data-toggle="collapse" data-target="#collapse_dia_chi">
                                                    Đổi Địa Chỉ
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="order_ghi_chu" class="col-form-label">Ghi Chú:</label>
                                        <div class="input-group">
                                            <textarea id="order_ghi_chu" cols="100" rows="5" placeholder="Nhập ghi chú khi giao hàng (Dưới 100 ký tự)" style="border-radius: 6px;"></textarea>
                                        </div>
                                        <small id="order_ghi_chu_help" class="form-text text-danger"></small>
                                    </div>

                                    <!-- hiển thị khung thay đổi địa chỉ -->
                                    <div class="col-12">
                                        <div class="collapse" id="collapse_dia_chi">
                                            <div class="card card-body">
                                                <div class="col-2 mb-3">
                                                    <a href="account.php#show_update_diachi" class="btn btn-success btn-sm">Quản Lý Địa Chỉ</a>
                                                </div>

                                                <?php
                                                $id_kh = $khachhang['id_kh'];
                                                $query_all_diachi = get_all_diachi($id_kh);
                                                while ($result_all_diachi = mysqli_fetch_array($query_all_diachi)) {
                                                    $id_dc = $result_all_diachi['id_dc'];
                                                    $diachi_mac_dinh = get_diachi_mac_dinh($id_kh);
                                                    $xaphuong = get_xaphuong($result_all_diachi['id_xp']);
                                                    $quanhuyen = get_quanhuyen($xaphuong['id_qh']);
                                                    $tinhthanhpho = get_tinhthanhpho($quanhuyen['id_ttp']);
                                                    $diachi = $result_all_diachi['dia_chi'] . "-" . $xaphuong['ten_xp'] . "-" . $quanhuyen['ten_qh'] . "-" . $tinhthanhpho['ten_ttp'];
                                                ?>
                                                    <div class="input-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <?php
                                                                if ($result_all_diachi['id_dc'] == $diachi_mac_dinh['id_dc']) {
                                                                ?>
                                                                    <input checked name="radio_dia_chi" type="radio" value="<?php echo $id_dc ?>">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <input name="radio_dia_chi" type="radio" value="<?php echo $id_dc ?>">
                                                                <?php
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                        <!-- hiển thị đia chỉ -->
                                                        <input name="<?php echo $id_dc ?>" value="<?php echo $diachi ?>" readonly type="text" class="form-control input-order">
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- nút MUA -->
                                    <?php
                                    if (isset($_GET['cart'])) {
                                    ?>
                                        <div class="col-12 text-center mt-2">
                                            <button id="btn-order" value="order_cart" type="button" class="btn btn-primary w-50 p-1 text-btn-order">Mua</button>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-12 text-center mt-2">
                                            <button id="btn-order" value="order_product" type="button" class="btn btn-primary w-50 p-1 text-btn-order">Mua</button>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </form>
                        </div>

                    </div>
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