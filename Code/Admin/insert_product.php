<?php
session_start();
include 'function/function_connect_db.php';
include 'function/function_show_database.php';
include 'function/function_smartphone_management.php';

$user = $_SESSION['current_user'];
?>

<?php
if (isset($_SESSION['current_user']) && !empty($_SESSION['current_user'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thêm Sản Phẩm - HT SHOP</title>

        <script src="vendor/jquery/jquery.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/summernote/summernote-lite.min.js"></script>

        <script src="javascript/javascript-manage.js"></script>
        <script src="javascript/javascript-image-product.js"></script>
        <script src="javascript/javascript-ajax-insert-product.js"></script>
        <script src="javascript/javascript-summernote.js"></script>

        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="vendor/summernote/summernote-lite.min.css" type="text/css">

        <link rel="stylesheet" href="style/style-base.css" type="text/css">
        <link rel="stylesheet" href="style/style-manage.css" type="text/css">
        <link rel="stylesheet" href="style/style-product-management.css" type="text/css">
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-dark background-blue mb-2">
            <a class="navbar-brand text-logo" href="#">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                HT SHOP
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse">
                <ul class="nav nav-pills" role="tablist" id="tab-header">
                    <!-- nut nhan quay ve trang quan ly -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link show active text-white" href="manage.php">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                            Quay Về Trang Quản Lý
                        </a>
                    </li>
                </ul>

                <?php
                switch ($_GET['insert_product']) {
                    case "smartphone":
                        echo '<p class="mx-auto text-notification-header">Thêm Điện Thoại</p>';
                        break;
                    case "headphone":
                        echo '<p class="mx-auto text-notification-header">Thêm Tai Nghe</p>';
                        break;
                    case "phonecase":
                        echo '<p class="mx-auto text-notification-header">Thêm Ốp Lưng</p>';
                        break;
                }
                ?>


                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle text-btn-menu" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <?php
                                echo $user['ten_nv'];
                                ?>
                            </button>
                            <div class="dropdown-menu text-btn-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="account.php?account_staff=<?php echo $user['id_nv'] ?>">Tài Khoản</a>
                                <a class="dropdown-item" href="function/function_logout.php" id="btn-logout">Đăng Xuất</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>


        <!-- thêm điện thoại -->
        <?php
        if (isset($_GET['insert_product']) && $_GET['insert_product'] == "smartphone") {
        ?>
            <!-- khung hien thi them dien thoai -->
            <div class="container-fluid">
                <div class="row bg-secondary m-1 p-1 pt-3 rounded text-white">
                    <div class="col-12">
                        <form id="form_insert_smartphone" action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <!-- hien thi anh -->
                                <div class="col-4">
                                    <!-- avatar -->
                                    <div class="float-left text-center">
                                        <label for="image_avatar" id="preview_image_avatar" class="div-show-image text-center">
                                            <p>
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <br> Avatar
                                                <br>600x600
                                            </p>
                                        </label>
                                        <input name="image_avatar" id="image_avatar" hidden type="file" onchange="show_image(this)">
                                        <p>Avatar</p>
                                    </div>

                                    <!-- ảnh 1 -->
                                    <div class="float-left text-center">
                                        <label for="image_1" id="preview_image_1" class="div-show-image text-center">
                                            <p>
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <br>Ảnh 1
                                                <br>600x600
                                            </p>
                                        </label>
                                        <input name="image_1" id="image_1" hidden type="file" onchange="show_image(this)">
                                        <p>Ảnh 1</p>
                                    </div>

                                    <!-- ảnh 2 -->
                                    <div class="float-left text-center">
                                        <label for="image_2" id="preview_image_2" class="div-show-image text-center">
                                            <p>
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <br>Ảnh 2
                                                <br>600x600
                                            </p>
                                        </label>
                                        <input name="image_2" id="image_2" hidden type="file" onchange="show_image(this)">
                                        <p>Ảnh 2</p>
                                    </div>

                                    <!-- ảnh 3 -->
                                    <div class="float-left text-center">
                                        <label for="image_3" id="preview_image_3" class="div-show-image text-center">
                                            <p>
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <br>Ảnh 3
                                                <br>600x600
                                            </p>
                                        </label>
                                        <input name="image_3" id="image_3" hidden type="file" onchange="show_image(this)">
                                        <p>Ảnh 3</p>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group input-group-sm">
                                                <label for="insert_ten_smartphone">Tên điện thoại:</label>
                                                <input id="insert_ten_smartphone" name="insert_ten_smartphone" type="text" class="form-control mb-1">
                                                <small id="insert_ten_smartphone_help" class="form-text text-warning mb-2"></small>

                                                <label for="insert_gia_smartphone">Giá:</label>
                                                <input type="text" class="form-control mb-1" id="input_show_gia_smartphone">
                                                <small id="input_show_gia_smartphone_help" class="form-text text-warning mb-2"></small>
                                                <input hidden id="insert_gia_smartphone" name="insert_gia_smartphone" type="text">

                                                <label for="insert_so_luong_smartphone">Số lượng:</label>
                                                <input type="text" class="form-control mb-1" id="input_show_so_luong_smartphone">
                                                <small id="input_show_so_luong_smartphone_help" class="form-text text-warning mb-2"></small>
                                                <input hidden id="insert_so_luong_smartphone" name="insert_so_luong_smartphone" type="text" class="form-control mb-2">

                                                <label for="insert_nsx_smartphone">Nước Sản Xuất:</label>
                                                <select class="custom-select mb-2" name="insert_nsx_smartphone" id="insert_nsx_smartphone">
                                                    <option value="">Chọn nước sản xuất</option>
                                                    <?php
                                                    while ($result_nsx = mysqli_fetch_array($query_nuocsanxuat)) {
                                                    ?>
                                                        <option value="<?php echo $result_nsx['id_nsx'] ?>"><?php echo $result_nsx['ten_nsx'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label for="insert_bonho_smartphone">Bộ nhớ trong:</label>
                                                <select class="custom-select mb-2" name="insert_bonho_smartphone" id="insert_bonho_smartphone">
                                                    <option value="">Chọn bộ nhớ trong</option>
                                                    <?php
                                                    while ($result_bn = mysqli_fetch_array($query_bonho)) {
                                                    ?>
                                                        <option value="<?php echo $result_bn['id_bn'] ?>"><?php echo $result_bn['dung_luong_bn'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label for="insert_ram_smartphone">Ram:</label>
                                                <select class="custom-select mb-2" name="insert_ram_smartphone" id="insert_ram_smartphone">
                                                    <option value="">Chọn Ram</option>
                                                    <?php
                                                    while ($result_ram = mysqli_fetch_array($query_ram)) {
                                                    ?>
                                                        <option value="<?php echo $result_ram['id_ram'] ?>"><?php echo $result_ram['dung_luong_ram'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group input-group-sm">
                                                <label for="insert_thuonghieu_smartphone">Thương hiệu:</label>
                                                <select class="custom-select mb-2" name="insert_thuonghieu_smartphone" id="insert_thuonghieu_smartphone">
                                                    <option value="">Chọn thương hiệu:</option>
                                                    <?php
                                                    while ($result_th = mysqli_fetch_array($query_thuonghieu)) {
                                                    ?>
                                                        <option value="<?php echo $result_th['id_th'] ?>"><?php echo $result_th['ten_th'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label for="insert_hedieuhanh_smartphone">Hệ điều hành:</label>
                                                <select class="custom-select mb-2" name="insert_hedieuhanh_smartphone" id="insert_hedieuhanh_smartphone">
                                                    <option value="">Chọn hệ điều hành:</option>
                                                    <?php
                                                    while ($result_hdh = mysqli_fetch_array($query_hedieuhanh)) {
                                                    ?>
                                                        <option value="<?php echo $result_hdh['id_hdh'] ?>"><?php echo $result_hdh['ten_hdh'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label for="insert_thietke_smartphone">Thiết kế:</label>
                                                <select class="custom-select mb-2" name="insert_thietke_smartphone" id="insert_thietke_smartphone">
                                                    <option value="">Chọn thiết kế:</option>
                                                    <?php
                                                    while ($result_tk = mysqli_fetch_array($query_thietke)) {
                                                    ?>
                                                        <option value="<?php echo $result_tk['id_tk'] ?>"><?php echo $result_tk['kieu_tk'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label for="insert_chip_smartphone">Chip xử lý:</label>
                                                <select class="custom-select mb-2" name="insert_chip_smartphone" id="insert_chip_smartphone">
                                                    <option value="">Chọn Chip xử lý:</option>
                                                    <?php
                                                    while ($result_chip = mysqli_fetch_array($query_chip)) {
                                                    ?>
                                                        <option value="<?php echo $result_chip['id_chip'] ?>"><?php echo $result_chip['ten_chip'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label for="insert_manhinh_smartphone">Kích thước màn hình:</label>
                                                <select class="custom-select mb-2" name="insert_manhinh_smartphone" id="insert_manhinh_smartphone">
                                                    <option value="">Chọn kích thước màn hình:</option>
                                                    <?php
                                                    while ($result_mh = mysqli_fetch_array($query_manhinh)) {
                                                    ?>
                                                        <option value="<?php echo $result_mh['id_mh'] ?>"><?php echo $result_mh['kich_thuoc_mh'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label for="insert_khuyenmai_smartphone">Khuyến Mãi:</label>
                                                <select class="custom-select mb-2" name="insert_khuyenmai_smartphone" id="insert_khuyenmai_smartphone">
                                                    <option value="">Chọn khuyến mãi:</option>
                                                    <?php
                                                    while ($result_km = mysqli_fetch_array($query_khuyenmai)) {
                                                        if ($result_km['giam_km'] == 0) {
                                                    ?>
                                                            <option value="<?php echo $result_km['id_km'] ?>"><?php echo "Không giảm"; ?></option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="<?php echo $result_km['id_km'] ?>"><?php echo "Giảm " . $result_km['giam_km'] . "%" ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 bg-white p-0 rounded">
                                            <textarea class="editor" name="insert_gioi_thieu_smartphone"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2 text-center">
                                    <button type="submit" id="btn_insert_smartphone" class="btn btn-primary btn-sm w-50">
                                        Thêm Điện Thoại
                                    </button>
                                    <button type="button" id="btn-reset-insert-smartphone" class="btn btn-danger btn-sm ">
                                        Làm Mới
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>


        <!-- thêm tai nghe -->
        <?php
        if (isset($_GET['insert_product']) && $_GET['insert_product'] == "headphone") {
        ?>
            <!-- khung hien thi them tai nghe -->
            <div class="container-fluid">
                <div class="row bg-secondary m-1 p-1 pt-3 rounded text-white">
                    <div class="col-12">
                        <form id="form_insert_headphone" action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <!-- hien thi anh -->
                                <div class="col-4">
                                    <!-- avatar -->
                                    <div class="float-left text-center">
                                        <label for="image_avatar" id="preview_image_avatar" class="div-show-image text-center">
                                            <p>
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <br>Ảnh Avatar
                                                <br>600x600
                                            </p>
                                        </label>
                                        <input name="image_avatar" id="image_avatar" hidden type="file" onchange="show_image(this)">
                                        <p>Avatar</p>
                                    </div>

                                    <!-- ảnh 1 -->
                                    <div class="float-left text-center">
                                        <label for="image_1" id="preview_image_1" class="div-show-image text-center">
                                            <p>
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <br>Ảnh 1
                                                <br>600x600
                                            </p>
                                        </label>
                                        <input name="image_1" id="image_1" hidden type="file" onchange="show_image(this)">
                                        <p>Ảnh 1</p>
                                    </div>

                                    <!-- ảnh 2 -->
                                    <div class="float-left text-center">
                                        <label for="image_2" id="preview_image_2" class="div-show-image text-center">
                                            <p>
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <br>Ảnh 2
                                                <br>600x600
                                            </p>
                                        </label>
                                        <input name="image_2" id="image_2" hidden type="file" onchange="show_image(this)">
                                        <p>Ảnh 2</p>
                                    </div>

                                    <!-- ảnh 3 -->
                                    <div class="float-left text-center">
                                        <label for="image_3" id="preview_image_3" class="div-show-image text-center">
                                            <p>
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <br>Ảnh 3
                                                <br>600x600
                                            </p>
                                        </label>
                                        <input name="image_3" id="image_3" hidden type="file" onchange="show_image(this)">
                                        <p>Ảnh 3</p>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group input-group-sm">
                                                <label for="insert_ten_headphone">Tên tai nghe:</label>
                                                <input id="insert_ten_headphone" name="insert_ten_headphone" type="text" class="form-control mb-1">
                                                <small id="insert_ten_headphone_help" class="form-text text-warning mb-2"></small>

                                                <label for="insert_gia_headphone">Giá:</label>
                                                <input type="text" class="form-control mb-1" id="input_show_gia_headphone">
                                                <small id="input_show_gia_headphone_help" class="form-text text-warning mb-2"></small>
                                                <input hidden id="insert_gia_headphone" name="insert_gia_headphone" type="text" class="form-control mb-2">

                                                <label for="insert_so_luong_headphone">Số lượng:</label>
                                                <input type="text" class="form-control mb-1" id="input_show_so_luong_headphone">
                                                <small id="input_show_so_luong_headphone_help" class="form-text text-warning mb-2"></small>
                                                <input hidden id="insert_so_luong_headphone" name="insert_so_luong_headphone" type="text" class="form-control mb-2">

                                                <label for="insert_khuyenmai_headphone">Khuyến Mãi:</label>
                                                <select class="custom-select mb-2" name="insert_khuyenmai_headphone" id="insert_khuyenmai_headphone">
                                                    <option value="">Chọn khuyến mãi:</option>
                                                    <?php
                                                    while ($result_km = mysqli_fetch_array($query_khuyenmai)) {
                                                        if ($result_km['giam_km'] == 0) {
                                                    ?>
                                                            <option value="<?php echo $result_km['id_km'] ?>"><?php echo "Không giảm"; ?></option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="<?php echo $result_km['id_km'] ?>"><?php echo "Giảm " . $result_km['giam_km'] . "%" ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group input-group-sm">
                                                <label for="insert_nsx_headphone">Nước Sản Xuất:</label>
                                                <select class="custom-select mb-2" name="insert_nsx_headphone" id="insert_nsx_headphone">
                                                    <option value="">Chọn nước sản xuất</option>
                                                    <?php
                                                    while ($result_nsx = mysqli_fetch_array($query_nuocsanxuat)) {
                                                    ?>
                                                        <option value="<?php echo $result_nsx['id_nsx'] ?>"><?php echo $result_nsx['ten_nsx'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label for="insert_thuonghieu_headphone">Thương hiệu:</label>
                                                <select class="custom-select mb-2" name="insert_thuonghieu_headphone" id="insert_thuonghieu_headphone">
                                                    <option value="">Chọn thương hiệu:</option>
                                                    <?php
                                                    while ($result_th = mysqli_fetch_array($query_thuonghieu)) {
                                                    ?>
                                                        <option value="<?php echo $result_th['id_th'] ?>"><?php echo $result_th['ten_th'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label for="insert_loaiketnoi_headphone">Loại kết nối:</label>
                                                <select class="custom-select mb-2" name="insert_loaiketnoi_headphone" id="insert_loaiketnoi_headphone">
                                                    <option value="">Chọn loại kết nối:</option>
                                                    <?php
                                                    while ($result_lkn = mysqli_fetch_array($query_loaiketnoi)) {
                                                    ?>
                                                        <option value="<?php echo $result_lkn['id_lkn'] ?>"><?php echo $result_lkn['ten_lkn'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 bg-white p-0 rounded">
                                            <textarea class="editor" name="insert_gioi_thieu_headphone"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2 text-center">
                                    <button type="submit" id="btn_insert_headphone" class="btn btn-primary btn-sm w-50">
                                        Thêm Tai Nghe
                                    </button>
                                    <button type="button" id="btn-reset-insert-headphone" class="btn btn-danger btn-sm ">
                                        Làm Mới
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

        <!-- thêm Ốp Lưng -->
        <?php
        if (isset($_GET['insert_product']) && $_GET['insert_product'] == "phonecase") {
        ?>
            <!-- khung hien thi them Ốp Lưng -->
            <div class="container-fluid">
                <div class="row bg-secondary m-1 p-1 pt-3 rounded text-white">
                    <div class="col-12">
                        <form id="form_insert_phonecase" action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <!-- hien thi anh -->
                                <div class="col-4">
                                    <!-- avatar -->
                                    <div class="float-left text-center">
                                        <label for="image_avatar" id="preview_image_avatar" class="div-show-image text-center">
                                            <p>
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <br>Ảnh Avatar
                                                <br>600x600
                                            </p>
                                        </label>
                                        <input name="image_avatar" id="image_avatar" hidden type="file" onchange="show_image(this)">
                                        <p>Avatar</p>
                                    </div>

                                    <!-- ảnh 1 -->
                                    <div class="float-left text-center">
                                        <label for="image_1" id="preview_image_1" class="div-show-image text-center">
                                            <p>
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <br>Ảnh 1
                                                <br>600x600
                                            </p>
                                        </label>
                                        <input name="image_1" id="image_1" hidden type="file" onchange="show_image(this)">
                                        <p>Ảnh 1</p>
                                    </div>

                                    <!-- ảnh 2 -->
                                    <div class="float-left text-center">
                                        <label for="image_2" id="preview_image_2" class="div-show-image text-center">
                                            <p>
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <br>Ảnh 2
                                                <br>600x600
                                            </p>
                                        </label>
                                        <input name="image_2" id="image_2" hidden type="file" onchange="show_image(this)">
                                        <p>Ảnh 2</p>
                                    </div>

                                    <!-- ảnh 3 -->
                                    <div class="float-left text-center">
                                        <label for="image_3" id="preview_image_3" class="div-show-image text-center">
                                            <p>
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                <br>Ảnh 3
                                                <br>600x600
                                            </p>
                                        </label>
                                        <input name="image_3" id="image_3" hidden type="file" onchange="show_image(this)">
                                        <p>Ảnh 3</p>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group input-group-sm">
                                                <label for="insert_ten_phonecase">Tên Ốp Lưng:</label>
                                                <input id="insert_ten_phonecase" name="insert_ten_phonecase" type="text" class="form-control mb-1">
                                                <small id="insert_ten_phonecase_help" class="form-text text-warning mb-2"></small>

                                                <label for="insert_gia_phonecase">Giá:</label>
                                                <input type="text" class="form-control mb-1" id="input_show_gia_phonecase">
                                                <small id="input_show_gia_phonecase_help" class="form-text text-warning mb-2"></small>
                                                <input hidden id="insert_gia_phonecase" name="insert_gia_phonecase" type="text" class="form-control mb-2">

                                                <label for="insert_so_luong_phonecase">Số lượng:</label>
                                                <input type="text" class="form-control mb-1" id="input_show_so_luong_phonecase">
                                                <small id="input_show_so_luong_phonecase_help" class="form-text text-warning mb-2"></small>
                                                <input hidden id="insert_so_luong_phonecase" name="insert_so_luong_phonecase" type="text" class="form-control mb-2">

                                                <label for="insert_khuyenmai_phonecase">Khuyến Mãi:</label>
                                                <select class="custom-select mb-2" name="insert_khuyenmai_phonecase" id="insert_khuyenmai_phonecase">
                                                    <option value="">Chọn khuyến mãi:</option>
                                                    <?php
                                                    while ($result_km = mysqli_fetch_array($query_khuyenmai)) {
                                                        if ($result_km['giam_km'] == 0) {
                                                    ?>
                                                            <option value="<?php echo $result_km['id_km'] ?>"><?php echo "Không giảm"; ?></option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="<?php echo $result_km['id_km'] ?>"><?php echo "Giảm " . $result_km['giam_km'] . "%" ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group input-group-sm">
                                                <label for="insert_nsx_phonecase">Nước Sản Xuất:</label>
                                                <select class="custom-select mb-2" name="insert_nsx_phonecase" id="insert_nsx_phonecase">
                                                    <option value="">Chọn nước sản xuất</option>
                                                    <?php
                                                    while ($result_nsx = mysqli_fetch_array($query_nuocsanxuat)) {
                                                    ?>
                                                        <option value="<?php echo $result_nsx['id_nsx'] ?>"><?php echo $result_nsx['ten_nsx'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label for="insert_thuonghieu_phonecase">Thương hiệu:</label>
                                                <select class="custom-select mb-2" name="insert_thuonghieu_phonecase" id="insert_thuonghieu_phonecase">
                                                    <option value="">Chọn thương hiệu:</option>
                                                    <?php
                                                    while ($result_th = mysqli_fetch_array($query_thuonghieu)) {
                                                    ?>
                                                        <option value="<?php echo $result_th['id_th'] ?>"><?php echo $result_th['ten_th'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                                <label for="insert_chatlieu_phonecase">Chất liệu:</label>
                                                <select class="custom-select mb-2" name="insert_chatlieu_phonecase" id="insert_chatlieu_phonecase">
                                                    <option value="">Chọn loại kết nối:</option>
                                                    <?php
                                                    while ($result_cl = mysqli_fetch_array($query_chatlieu)) {
                                                    ?>
                                                        <option value="<?php echo $result_cl['id_cl'] ?>"><?php echo $result_cl['ten_cl'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 bg-white p-0 rounded">
                                            <textarea class="editor" name="insert_gioi_thieu_phonecase"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2 text-center">
                                    <button type="submit" id="btn_insert_phonecase" class="btn btn-primary btn-sm w-50">
                                        Thêm Ốp Lưng
                                    </button>
                                    <button type="button" id="btn-reset-insert-phonecase" class="btn btn-danger btn-sm ">
                                        Làm Mới
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>


        <!-- modal thông báo -->
        <?php
        include 'modal_notification.php';
        ?>

    </body>

    </html>
<?php
} else {
    header('Location: index.php');
}
?>