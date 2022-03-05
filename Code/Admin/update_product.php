<?php
session_start();
include 'function/function_connect_db.php';
include 'function/function_show_database.php';
include 'function/function_find_database.php';
include 'function/function_money_format.php';

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
        <title>Cập Nhật Sản Phẩm - HT SHOP</title>

        <script src="vendor/jquery/jquery.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/summernote/summernote-lite.min.js"></script>

        <script src="javascript/javascript-manage.js"></script>
        <script src="javascript/javascript-image-product.js"></script>
        <script src="javascript/javascript-ajax-update-product.js"></script>
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
            <a class="navbar-brand text-logo" href="">
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
                switch ($_GET['update_product']) {
                    case "smartphone":
                        echo '<p class="mx-auto text-notification-header">Cập Nhật Điện Thoại</p>';
                        break;
                    case "headphone":
                        echo '<p class="mx-auto text-notification-header">Cập Nhật Tai Nghe</p>';
                        break;
                    case "phonecase":
                        echo '<p class="mx-auto text-notification-header">Cập Nhật Ốp Lưng</p>';
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


        <!-- cập nhật ĐIỆN THOẠI -->
        <?php
        if (isset($_GET['update_product']) && $_GET['update_product'] == "smartphone") {
        ?>
            <!-- khung hien thi nội dung cập nhật điện thoại-->
            <div class="container-fluid tab-content">
                <!-- khung hien thi update dien thoai -->
                <div class="container-fluid">
                    <div class="row bg-secondary m-1 p-1 pt-3 rounded text-white">
                        <div class="col-12">
                            <form id="form_update_smartphone" action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <?php
                                    $id_sp = $_GET['id_sp'];
                                    //lấy ảnh avatar
                                    $image_avatar = get_sanpham($id_sp);

                                    //lấy hình ảnh database anhsanpham lưu vào mảng để hiển thị ra màn hình
                                    $query_anhsanpham = find_anhsanpham($id_sp);
                                    $image = array();
                                    $i = 0;
                                    while ($result = mysqli_fetch_array($query_anhsanpham)) {
                                        $image[$i] = $result['anh_asp'];
                                        $i++;
                                    }
                                    ?>
                                    <!-- hien thi anh -->
                                    <div class="col-4">
                                        <!-- avatar -->
                                        <div class="float-left text-center">
                                            <label for="image_avatar" id="preview_image_avatar" class="div-show-image text-center bg-white">
                                                <img src="<?php echo $image_avatar['anh_sp']; ?>" alt="" class="image-product">
                                            </label>
                                            <input name="image_avatar" id="image_avatar" hidden type="file" onchange="show_image(this)">
                                            <input value="<?php echo $image_avatar['anh_sp']; ?>" name="image_avatar_old" hidden type="text">
                                            <p>Avatar</p>
                                        </div>

                                        <!-- ảnh 1 -->
                                        <div class="float-left text-center">
                                            <label for="image_1" id="preview_image_1" class="div-show-image text-center bg-white">
                                                <img src="<?php echo $image[0]; ?>" alt="" class="image-product">
                                            </label>
                                            <input name="image_1" id="image_1" hidden type="file" onchange="show_image(this)">
                                            <input value="<?php echo $image[0]; ?>" name="image_1_old" hidden type="text">
                                            <p>Ảnh 1</p>
                                        </div>

                                        <!-- ảnh 2 -->
                                        <div class="float-left text-center">
                                            <label for="image_2" id="preview_image_2" class="div-show-image text-center bg-white">
                                                <img src="<?php echo $image[1]; ?>" alt="" class="image-product">
                                            </label>
                                            <input name="image_2" id="image_2" hidden type="file" onchange="show_image(this)">
                                            <input value="<?php echo $image[1]; ?>" name="image_2_old" hidden type="text">
                                            <p>Ảnh 2</p>
                                        </div>

                                        <!-- ảnh 3 -->
                                        <div class="float-left text-center">
                                            <label for="image_3" id="preview_image_3" class="div-show-image text-center bg-white">
                                                <img src="<?php echo $image[2]; ?>" alt="" class="image-product">
                                            </label>
                                            <input name="image_3" id="image_3" hidden type="file" onchange="show_image(this)">
                                            <input value="<?php echo $image[2]; ?>" name="image_3_old" hidden type="text">
                                            <p>Ảnh 3</p>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <?php
                                            $result_sanpham = get_sanpham($id_sp);
                                            $gia = money_format($result_sanpham['gia_sp']);
                                            $so_luong = money_format($result_sanpham['so_luong_sp']);
                                            $result_dienthoai = get_dienthoai($id_sp);
                                            ?>
                                            <div class="col-6">
                                                <div class="form-group input-group-sm">
                                                    <!-- hiển thị ID sản phẩm để update -->
                                                    <input hidden id="update_id_smartphone" name="update_id_smartphone" value="<?php echo $result_sanpham['id_sp']; ?>" type="text" class="form-control mb-2">

                                                    <label for="update_ten_smartphone">Tên điện thoại:</label>
                                                    <input id="update_ten_smartphone" name="update_ten_smartphone" value="<?php echo $result_sanpham['ten_sp']; ?>" type="text" class="form-control mb-1">
                                                    <small id="update_ten_smartphone_help" class="form-text text-warning mb-2"></small>

                                                    <label for="update_gia_smartphone">Giá:</label>
                                                    <input id="input_show_gia" value="<?php echo $gia; ?>" type="text" class="form-control mb-1">
                                                    <small id="input_show_gia_smartphone_help" class="form-text text-warning mb-2"></small>
                                                    <input hidden id="update_gia_smartphone" name="update_gia_smartphone" value="<?php echo $result_sanpham['gia_sp']; ?>" type="text" class="form-control mb-2">

                                                    <label for="update_so_luong_smartphone">Số lượng:</label>
                                                    <input id="input_show_so_luong" value="<?php echo $so_luong; ?>" type="text" class="form-control mb-1">
                                                    <small id="input_show_so_luong_smartphone_help" class="form-text text-warning mb-2"></small>
                                                    <input hidden id="update_so_luong_smartphone" name="update_so_luong_smartphone" value="<?php echo $result_sanpham['so_luong_sp']; ?>" type="text" class="form-control mb-2">

                                                    <label for="update_nsx_smartphone">Nước sản xuất:</label>
                                                    <select class="custom-select mb-2" name="update_nsx_smartphone" id="update_nsx_smartphone">
                                                        <option value="">Chọn nước sản xuất</option>
                                                        <?php
                                                        while ($result_nsx = mysqli_fetch_array($query_nuocsanxuat)) {
                                                            if ($result_nsx['id_nsx'] == $result_sanpham['id_nsx']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_nsx['id_nsx'] ?>"><?php echo $result_nsx['ten_nsx'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_nsx['id_nsx'] ?>"><?php echo $result_nsx['ten_nsx'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_bonho_smartphone">Bộ nhớ trong:</label>
                                                    <select class="custom-select mb-2" name="update_bonho_smartphone" id="update_bonho_smartphone">
                                                        <option value="">Chọn bộ nhớ trong</option>
                                                        <?php
                                                        while ($result_bn = mysqli_fetch_array($query_bonho)) {
                                                            if ($result_bn['id_bn'] == $result_dienthoai['id_bn']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_bn['id_bn'] ?>"><?php echo $result_bn['dung_luong_bn'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_bn['id_bn'] ?>"><?php echo $result_bn['dung_luong_bn'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_ram_smartphone">Ram:</label>
                                                    <select class="custom-select mb-2" name="update_ram_smartphone" id="update_ram_smartphone">
                                                        <option value="">Chọn Ram</option>
                                                        <?php
                                                        while ($result_ram = mysqli_fetch_array($query_ram)) {
                                                            if ($result_ram['id_ram'] == $result_dienthoai['id_ram']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_ram['id_ram'] ?>"><?php echo $result_ram['dung_luong_ram'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_ram['id_ram'] ?>"><?php echo $result_ram['dung_luong_ram'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_thuonghieu_smartphone">Thương hiệu:</label>
                                                    <select class="custom-select mb-2" name="update_thuonghieu_smartphone" id="update_thuonghieu_smartphone">
                                                        <option value="">Chọn thương hiệu:</option>
                                                        <?php
                                                        while ($result_th = mysqli_fetch_array($query_thuonghieu)) {
                                                            if ($result_th['id_th'] == $result_dienthoai['id_th']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_th['id_th'] ?>"><?php echo $result_th['ten_th'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_th['id_th'] ?>"><?php echo $result_th['ten_th'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group input-group-sm">
                                                    <label for="update_hedieuhanh_smartphone">Hệ điều hành:</label>
                                                    <select class="custom-select mb-2" name="update_hedieuhanh_smartphone" id="update_hedieuhanh_smartphone">
                                                        <option value="">Chọn hệ điều hành:</option>
                                                        <?php
                                                        while ($result_hdh = mysqli_fetch_array($query_hedieuhanh)) {
                                                            if ($result_hdh['id_hdh'] == $result_dienthoai['id_hdh']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_hdh['id_hdh'] ?>"><?php echo $result_hdh['ten_hdh'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_hdh['id_hdh'] ?>"><?php echo $result_hdh['ten_hdh'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_thietke_smartphone">Thiết kế:</label>
                                                    <select class="custom-select mb-2" name="update_thietke_smartphone" id="update_thietke_smartphone">
                                                        <option value="">Chọn thiết kế:</option>
                                                        <?php
                                                        while ($result_tk = mysqli_fetch_array($query_thietke)) {
                                                            if ($result_tk['id_tk'] == $result_dienthoai['id_tk']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_tk['id_tk'] ?>"><?php echo $result_tk['kieu_tk'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_tk['id_tk'] ?>"><?php echo $result_tk['kieu_tk'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_chip_smartphone">Chip xử lý:</label>
                                                    <select class="custom-select mb-2" name="update_chip_smartphone" id="update_chip_smartphone">
                                                        <option value="">Chọn Chip xử lý:</option>
                                                        <?php
                                                        while ($result_chip = mysqli_fetch_array($query_chip)) {
                                                            if ($result_chip['id_chip'] == $result_dienthoai['id_chip']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_chip['id_chip'] ?>"><?php echo $result_chip['ten_chip'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_chip['id_chip'] ?>"><?php echo $result_chip['ten_chip'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_manhinh_smartphone">Kích thước màn hình:</label>
                                                    <select class="custom-select mb-2" name="update_manhinh_smartphone" id="update_manhinh_smartphone">
                                                        <option value="">Chọn kích thước màn hình:</option>
                                                        <?php
                                                        while ($result_mh = mysqli_fetch_array($query_manhinh)) {
                                                            if ($result_mh['id_mh'] == $result_dienthoai['id_mh']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_mh['id_mh'] ?>"><?php echo $result_mh['kich_thuoc_mh'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_mh['id_mh'] ?>"><?php echo $result_mh['kich_thuoc_mh'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_khuyenmai_smartphone">Khuyến Mãi:</label>
                                                    <select class="custom-select mb-2" name="update_khuyenmai_smartphone" id="update_khuyenmai_smartphone">
                                                        <option value="">Chọn Khuyến Mãi:</option>
                                                        <?php
                                                        while ($result_km = mysqli_fetch_array($query_khuyenmai)) {
                                                            if ($result_km['id_km'] == $result_sanpham['id_km']) {
                                                                if ($result_km['giam_km'] == 0) {
                                                        ?>
                                                                    <option selected value="<?php echo $result_km['id_km'] ?>"><?php echo "Không Giảm" ?></option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option selected value="<?php echo $result_km['id_km'] ?>"><?php echo "Giảm " . $result_km['giam_km'] . "%" ?></option>
                                                                <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $result_km['id_km'] ?>"><?php echo "Giảm " . $result_km['giam_km'] . "%" ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_trangthaisanpham_smartphone">Trạng Thái Sản Phẩm:</label>
                                                    <select class="custom-select mb-2" name="update_trangthaisanpham_smartphone" id="update_trangthaisanpham_smartphone">
                                                        <option value="">Chọn Trạng Thái Sản Phẩm:</option>
                                                        <?php
                                                        while ($result_ttsp = mysqli_fetch_array($query_trangthaisanpham)) {
                                                            if ($result_ttsp['id_ttsp'] == $result_sanpham['id_ttsp']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_ttsp['id_ttsp'] ?>"><?php echo $result_ttsp['ten_ttsp'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_ttsp['id_ttsp'] ?>"><?php echo $result_ttsp['ten_ttsp'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 bg-white p-0 rounded">
                                                <textarea class="editor" name="update_gioi_thieu_smartphone">
                                                        <?php echo $result_sanpham['gioi_thieu_sp']; ?>
                                                    </textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 mt-2 text-center">
                                        <button type="submit" id="btn_update_smartphone" class="btn btn-warning btn-sm w-50">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            Cập Nhật Điện Thoại
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

        <!-- cập nhật TAI NGHE -->
        <?php
        if (isset($_GET['update_product']) && $_GET['update_product'] == "headphone") {
        ?>
            <!-- khung hien thi nội dung cập nhật tai nghe-->
            <div class="container-fluid tab-content">
                <!-- khung hien thi update tai nghe -->
                <div class="container-fluid">
                    <div class="row bg-secondary m-1 p-1 pt-3 rounded text-white">
                        <div class="col-12">
                            <form id="form_update_headphone" action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <?php
                                    $id_sp = $_GET['id_sp'];
                                    //lấy ảnh avatar
                                    $image_avatar = get_sanpham($id_sp);

                                    //lấy hình ảnh database anhsanpham lưu vào mảng để hiển thị ra màn hình
                                    $query_anhsanpham = find_anhsanpham($id_sp);
                                    $image = array();
                                    $i = 0;
                                    while ($result = mysqli_fetch_array($query_anhsanpham)) {
                                        $image[$i] = $result['anh_asp'];
                                        $i++;
                                    }
                                    ?>
                                    <!-- hien thi anh -->
                                    <div class="col-4">
                                        <!-- avatar -->
                                        <div class="float-left text-center">
                                            <label for="image_avatar" id="preview_image_avatar" class="div-show-image text-center  bg-white">
                                                <img src="<?php echo $image_avatar['anh_sp']; ?>" alt="" class="image-product">
                                            </label>
                                            <input name="image_avatar" id="image_avatar" hidden type="file" onchange="show_image(this)">
                                            <input value="<?php echo $image_avatar['anh_sp']; ?>" name="image_avatar_old" hidden type="text">
                                            <p>Avatar</p>
                                        </div>

                                        <!-- ảnh 1 -->
                                        <div class="float-left text-center">
                                            <label for="image_1" id="preview_image_1" class="div-show-image text-center bg-white">
                                                <img src="<?php echo $image[0]; ?>" alt="" class="image-product">
                                            </label>
                                            <input name="image_1" id="image_1" hidden type="file" onchange="show_image(this)">
                                            <input value="<?php echo $image[0]; ?>" name="image_1_old" hidden type="text">
                                            <p>Ảnh 1</p>
                                        </div>

                                        <!-- ảnh 2 -->
                                        <div class="float-left text-center">
                                            <label for="image_2" id="preview_image_2" class="div-show-image text-center bg-white">
                                                <img src="<?php echo $image[1]; ?>" alt="" class="image-product">
                                            </label>
                                            <input name="image_2" id="image_2" hidden type="file" onchange="show_image(this)">
                                            <input value="<?php echo $image[1]; ?>" name="image_2_old" hidden type="text">
                                            <p>Ảnh 2</p>
                                        </div>

                                        <!-- ảnh 3 -->
                                        <div class="float-left text-center">
                                            <label for="image_3" id="preview_image_3" class="div-show-image text-center bg-white">
                                                <img src="<?php echo $image[2]; ?>" alt="" class="image-product">
                                            </label>
                                            <input name="image_3" id="image_3" hidden type="file" onchange="show_image(this)">
                                            <input value="<?php echo $image[2]; ?>" name="image_3_old" hidden type="text">
                                            <p>Ảnh 3</p>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <?php
                                            $result_sanpham = get_sanpham($id_sp);
                                            $gia = money_format($result_sanpham['gia_sp']);
                                            $so_luong = money_format($result_sanpham['so_luong_sp']);
                                            $result_tainghe = get_tainghe($id_sp);
                                            ?>
                                            <div class="col-6">
                                                <div class="form-group input-group-sm">
                                                    <!-- hiển thị ID sản phẩm để update -->
                                                    <input hidden id="update_id_headphone" name="update_id_headphone" value="<?php echo $result_sanpham['id_sp']; ?>" type="text" class="form-control mb-2">

                                                    <label for="update_ten_headphone">Tên tai nghe:</label>
                                                    <input id="update_ten_headphone" name="update_ten_headphone" value="<?php echo $result_sanpham['ten_sp']; ?>" type="text" class="form-control mb-1">
                                                    <small id="update_ten_headphone_help" class="form-text text-warning mb-2"></small>

                                                    <label for="update_gia_headphone">Giá:</label>
                                                    <input id="input_show_gia" value="<?php echo $gia; ?>" type="text" class="form-control mb-1">
                                                    <small id="input_show_gia_headphone_help" class="form-text text-warning mb-2"></small>
                                                    <input hidden id="update_gia_headphone" name="update_gia_headphone" value="<?php echo $result_sanpham['gia_sp']; ?>" type="text" class="form-control mb-2">

                                                    <label for="update_so_luong_headphone">Số lượng:</label>
                                                    <input id="input_show_so_luong" value="<?php echo $so_luong; ?>" type="text" class="form-control mb-1">
                                                    <small id="input_show_so_luong_headphone_help" class="form-text text-warning mb-2"></small>
                                                    <input hidden id="update_so_luong_headphone" name="update_so_luong_headphone" value="<?php echo $result_sanpham['so_luong_sp']; ?>" type="text" class="form-control mb-2">

                                                    <label for="update_khuyenmai_headphone">Khuyến Mãi:</label>
                                                    <select class="custom-select mb-2" name="update_khuyenmai_headphone" id="update_khuyenmai_headphone">
                                                        <option value="">Chọn Khuyến Mãi:</option>
                                                        <?php
                                                        while ($result_km = mysqli_fetch_array($query_khuyenmai)) {
                                                            if ($result_km['id_km'] == $result_sanpham['id_km']) {
                                                                if ($result_km['giam_km'] == 0) {
                                                        ?>
                                                                    <option selected value="<?php echo $result_km['id_km'] ?>"><?php echo "Không Giảm" ?></option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option selected value="<?php echo $result_km['id_km'] ?>"><?php echo "Giảm " . $result_km['giam_km'] . "%" ?></option>
                                                                <?php
                                                                }
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
                                                    <label for="update_nsx_headphone">Nước sản xuất:</label>
                                                    <select class="custom-select mb-2" name="update_nsx_headphone" id="update_nsx_headphone">
                                                        <option value="">Chọn nước sản xuất</option>
                                                        <?php
                                                        while ($result_nsx = mysqli_fetch_array($query_nuocsanxuat)) {
                                                            if ($result_nsx['id_nsx'] == $result_sanpham['id_nsx']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_nsx['id_nsx'] ?>"><?php echo $result_nsx['ten_nsx'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_nsx['id_nsx'] ?>"><?php echo $result_nsx['ten_nsx'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_thuonghieu_headphone">Thương hiệu:</label>
                                                    <select class="custom-select mb-2" name="update_thuonghieu_headphone" id="update_thuonghieu_headphone">
                                                        <option value="">Chọn thương hiệu:</option>
                                                        <?php
                                                        while ($result_th = mysqli_fetch_array($query_thuonghieu)) {
                                                            if ($result_th['id_th'] == $result_tainghe['id_th']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_th['id_th'] ?>"><?php echo $result_th['ten_th'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_th['id_th'] ?>"><?php echo $result_th['ten_th'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_loaiketnoi_headphone">Loại kết nối:</label>
                                                    <select class="custom-select mb-2" name="update_loaiketnoi_headphone" id="update_loaiketnoi_headphone">
                                                        <option value="">Chọn loại kết nối:</option>
                                                        <?php
                                                        while ($result_lkn = mysqli_fetch_array($query_loaiketnoi)) {
                                                            if ($result_lkn['id_lkn'] == $result_tainghe['id_lkn']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_lkn['id_lkn'] ?>"><?php echo $result_lkn['ten_lkn'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_lkn['id_lkn'] ?>"><?php echo $result_lkn['ten_lkn'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_trangthaisanpham_headphone">Trạng Thái Sản Phẩm:</label>
                                                    <select class="custom-select mb-2" name="update_trangthaisanpham_headphone" id="update_trangthaisanpham_headphone">
                                                        <option value="">Chọn Trạng Thái Sản Phẩm:</option>
                                                        <?php
                                                        while ($result_ttsp = mysqli_fetch_array($query_trangthaisanpham)) {
                                                            if ($result_ttsp['id_ttsp'] == $result_sanpham['id_ttsp']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_ttsp['id_ttsp'] ?>"><?php echo $result_ttsp['ten_ttsp'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_ttsp['id_ttsp'] ?>"><?php echo $result_ttsp['ten_ttsp'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-12 bg-white p-0 rounded">
                                                <textarea class="editor" name="update_gioi_thieu_headphone">
                                                        <?php echo $result_sanpham['gioi_thieu_sp']; ?>
                                                </textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 mt-2 text-center">
                                        <button type="submit" id="btn_update_headphone" class="btn btn-warning btn-sm w-50">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            Cập Nhật Tai Nghe
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>


        <!-- cập nhật ỐP LƯNG -->
        <?php
        if (isset($_GET['update_product']) && $_GET['update_product'] == "phonecase") {
        ?>
            <!-- khung hien thi nội dung cập nhật ốp lưng-->
            <div class="container-fluid tab-content">
                <!-- khung hien thi update ốp lưng -->
                <div class="container-fluid">
                    <div class="row bg-secondary m-1 p-1 pt-3 rounded text-white">
                        <div class="col-12">
                            <form id="form_update_phonecase" action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <?php
                                    $id_sp = $_GET['id_sp'];
                                    //lấy ảnh avatar
                                    $image_avatar = get_sanpham($id_sp);

                                    //lấy hình ảnh database anhsanpham lưu vào mảng để hiển thị ra màn hình
                                    $query_anhsanpham = find_anhsanpham($id_sp);
                                    $image = array();
                                    $i = 0;
                                    while ($result = mysqli_fetch_array($query_anhsanpham)) {
                                        $image[$i] = $result['anh_asp'];
                                        $i++;
                                    }
                                    ?>
                                    <!-- hien thi anh -->
                                    <div class="col-4">
                                        <!-- avatar -->
                                        <div class="float-left text-center">
                                            <label for="image_avatar" id="preview_image_avatar" class="div-show-image text-center bg-white">
                                                <img src="<?php echo $image_avatar['anh_sp']; ?>" alt="" class="image-product">
                                            </label>
                                            <input name="image_avatar" id="image_avatar" hidden type="file" onchange="show_image(this)">
                                            <input value="<?php echo $image_avatar['anh_sp']; ?>" name="image_avatar_old" hidden type="text">
                                            <p>Avatar</p>
                                        </div>

                                        <!-- ảnh 1 -->
                                        <div class="float-left text-center">
                                            <label for="image_1" id="preview_image_1" class="div-show-image text-center bg-white">
                                                <img src="<?php echo $image[0]; ?>" alt="" class="image-product">
                                            </label>
                                            <input name="image_1" id="image_1" hidden type="file" onchange="show_image(this)">
                                            <input value="<?php echo $image[0]; ?>" name="image_1_old" hidden type="text">
                                            <p>Ảnh 1</p>
                                        </div>

                                        <!-- ảnh 2 -->
                                        <div class="float-left text-center">
                                            <label for="image_2" id="preview_image_2" class="div-show-image text-center bg-white">
                                                <img src="<?php echo $image[1]; ?>" alt="" class="image-product">
                                            </label>
                                            <input name="image_2" id="image_2" hidden type="file" onchange="show_image(this)">
                                            <input value="<?php echo $image[1]; ?>" name="image_2_old" hidden type="text">
                                            <p>Ảnh 2</p>
                                        </div>

                                        <!-- ảnh 3 -->
                                        <div class="float-left text-center">
                                            <label for="image_3" id="preview_image_3" class="div-show-image text-center bg-white">
                                                <img src="<?php echo $image[2]; ?>" alt="" class="image-product">
                                            </label>
                                            <input name="image_3" id="image_3" hidden type="file" onchange="show_image(this)">
                                            <input value="<?php echo $image[2]; ?>" name="image_3_old" hidden type="text">
                                            <p>Ảnh 3</p>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <?php
                                            $result_sanpham = get_sanpham($id_sp);
                                            $gia = money_format($result_sanpham['gia_sp']);
                                            $so_luong = money_format($result_sanpham['so_luong_sp']);
                                            $result_oplung = get_oplung($id_sp);
                                            ?>
                                            <div class="col-6">
                                                <div class="form-group input-group-sm">
                                                    <!-- hiển thị ID sản phẩm để update -->
                                                    <input hidden id="update_id_phonecase" name="update_id_phonecase" value="<?php echo $result_sanpham['id_sp']; ?>" type="text" class="form-control mb-2">

                                                    <label for="update_ten_phonecase">Tên ốp lưng:</label>
                                                    <input id="update_ten_phonecase" name="update_ten_phonecase" value="<?php echo $result_sanpham['ten_sp']; ?>" type="text" class="form-control mb-1">
                                                    <small id="update_ten_phonecase_help" class="form-text text-warning mb-2"></small>

                                                    <label for="update_gia_phonecase">Giá:</label>
                                                    <input id="input_show_gia" value="<?php echo $gia; ?>" type="text" class="form-control mb-1">
                                                    <small id="input_show_gia_phonecase_help" class="form-text text-warning mb-2"></small>
                                                    <input hidden id="update_gia_phonecase" name="update_gia_phonecase" value="<?php echo $result_sanpham['gia_sp']; ?>" type="text" class="form-control mb-2">

                                                    <label for="update_so_luong_phonecase">Số lượng:</label>
                                                    <input id="input_show_so_luong" value="<?php echo $so_luong; ?>" type="text" class="form-control mb-1">
                                                    <small id="input_show_so_luong_phonecase_help" class="form-text text-warning mb-2"></small>
                                                    <input hidden id="update_so_luong_phonecase" name="update_so_luong_phonecase" value="<?php echo $result_sanpham['so_luong_sp']; ?>" type="text" class="form-control mb-2">

                                                    <label for="update_khuyenmai_phonecase">Khuyến Mãi:</label>
                                                    <select class="custom-select mb-2" name="update_khuyenmai_phonecase" id="update_khuyenmai_phonecase">
                                                        <option value="">Chọn Khuyến Mãi:</option>
                                                        <?php
                                                        while ($result_km = mysqli_fetch_array($query_khuyenmai)) {
                                                            if ($result_km['id_km'] == $result_sanpham['id_km']) {
                                                                if ($result_km['giam_km'] == 0) {
                                                        ?>
                                                                    <option selected value="<?php echo $result_km['id_km'] ?>"><?php echo "Không Giảm" ?></option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option selected value="<?php echo $result_km['id_km'] ?>"><?php echo "Giảm " . $result_km['giam_km'] . "%" ?></option>
                                                                <?php
                                                                }
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
                                                    <label for="update_nsx_phonecase">Nước sản xuất:</label>
                                                    <select class="custom-select mb-2" name="update_nsx_phonecase" id="update_nsx_phonecase">
                                                        <option value="">Chọn nước sản xuất</option>
                                                        <?php
                                                        while ($result_nsx = mysqli_fetch_array($query_nuocsanxuat)) {
                                                            if ($result_nsx['id_nsx'] == $result_sanpham['id_nsx']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_nsx['id_nsx'] ?>"><?php echo $result_nsx['ten_nsx'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_nsx['id_nsx'] ?>"><?php echo $result_nsx['ten_nsx'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_thuonghieu_phonecase">Thương hiệu:</label>
                                                    <select class="custom-select mb-2" name="update_thuonghieu_phonecase" id="update_thuonghieu_phonecase">
                                                        <option value="">Chọn thương hiệu:</option>
                                                        <?php
                                                        while ($result_th = mysqli_fetch_array($query_thuonghieu)) {
                                                            if ($result_th['id_th'] == $result_oplung['id_th']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_th['id_th'] ?>"><?php echo $result_th['ten_th'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_th['id_th'] ?>"><?php echo $result_th['ten_th'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_chatlieu_phonecase">Chất Liệu:</label>
                                                    <select class="custom-select mb-2" name="update_chatlieu_phonecase" id="update_chatlieu_phonecase">
                                                        <option value="">Chọn chất liệu:</option>
                                                        <?php
                                                        while ($result_cl = mysqli_fetch_array($query_chatlieu)) {
                                                            if ($result_cl['id_cl'] == $result_oplung['id_cl']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_cl['id_cl'] ?>"><?php echo $result_cl['ten_cl'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_cl['id_cl'] ?>"><?php echo $result_cl['ten_cl'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="update_trangthaisanpham_phonecase">Trạng Thái Sản Phẩm:</label>
                                                    <select class="custom-select mb-2" name="update_trangthaisanpham_phonecase" id="update_trangthaisanpham_phonecase">
                                                        <option value="">Chọn Trạng Thái Sản Phẩm:</option>
                                                        <?php
                                                        while ($result_ttsp = mysqli_fetch_array($query_trangthaisanpham)) {
                                                            if ($result_ttsp['id_ttsp'] == $result_sanpham['id_ttsp']) {
                                                        ?>
                                                                <option selected value="<?php echo $result_ttsp['id_ttsp'] ?>"><?php echo $result_ttsp['ten_ttsp'] ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?php echo $result_ttsp['id_ttsp'] ?>"><?php echo $result_ttsp['ten_ttsp'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>


                                                </div>
                                            </div>
                                            <div class="col-12 bg-white p-0 rounded">
                                                <textarea class="editor" name="update_gioi_thieu_phonecase">
                                                        <?php echo $result_sanpham['gioi_thieu_sp']; ?>
                                                    </textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 mt-2 text-center">
                                        <button type="submit" id="btn_update_phonecase" class="btn btn-warning btn-sm w-50">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            Cập Nhật Ốp Lưng
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
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