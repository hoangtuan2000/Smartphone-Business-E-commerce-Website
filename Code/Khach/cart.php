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
        <title>Giỏ Hàng - HT Shop</title>

        <script src="vendor/jquery/jquery.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <script src="javascript/javascript-ajax-login.js"></script>
        <script src="javascript/javascript-ajax-cart-management.js"></script>

        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" type="text/css">

        <link rel="stylesheet" href="styles/style-base.css" type="text/css">
        <link rel="stylesheet" href="styles/style-cart.css" type="text/css">

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



        <!-- giỏ hàng -->
        <div class="container mb-2">
            <div class="row">
                <div class="col-12">
                    <div class="bg-white rounded p-2 min-height-1000">
                        <p class="text-cart">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            Giỏ hàng của bạn
                        </p>
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
                                            <a href="order.php?cart" type="button" class="border-0 btn-primary p-1 rounded">
                                                Đặt Hàng
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <h4>Bạn Chưa Có Sản Phẩm Nào Trong Giỏ Hàng</h4>
                                            <p>
                                                <a href="index.php" class="btn btn-primary">Tiếp tục mua hàng</a>
                                            </p>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>



                            </tbody>
                        </table>
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