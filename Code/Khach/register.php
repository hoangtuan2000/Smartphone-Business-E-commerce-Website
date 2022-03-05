<?php
include 'function/function_connect_db.php';
include 'function/function_choose_address.php';
include 'function/function_show_database.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản - HT Shop</title>

    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="javascript/javascript-ajax-login.js"></script>
    <script src="javascript/javascript-ajax-choose-address.js"></script>
    <script src="javascript/javascript-ajax-register-management.js"></script>

    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" type="text/css">

    <link rel="stylesheet" href="styles/style-base.css" type="text/css">
    <link rel="stylesheet" href="styles/style-register.css" type="text/css">

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

    <!-- thẻ input để thông báo cho ajax login xem là có phải trang đăng ký hay ko (nếu là trang đăng ký thì đăng nhập xong phải chuyển về trang chủ index) -->
    <input id="check_page" value="register" type="text" hidden>


    <!-- đăng ký -->
    <div class="container mb-3">
        <div class="row bg-white m-1 pt-5 pb-4 rounded min-height-1000" data-aos="fade-right" data-aos-delay="500" data-aos-duration="500" data-aos-easing="linear" data-aos-offset="20">
            <div class="col-4">
                <img class="d-block w-100 object-fit-contain" src="asset/image-public/image-register.png" alt="">
            </div>
            <div class="col-6 pl-0">
                <form id="form_register" action="" method="POST">
                    <div class="form-group mb-5 text-content-register">
                        <!-- họ tên -->
                        <label for="register_ten" class="col-form-label">Họ Tên:</label>
                        <div class="input-group mb-1 w-100">
                            <div class="input-group-prepend input-register">
                                <label for="register_ten" class="input-group-text bg-secondary">
                                    <i class="fa fa-user-o icon-form" aria-hidden="true"></i>
                                </label>
                            </div>
                            <input name="register_ten" id="register_ten" type="text" class="form-control input-register" aria-label="Small">
                        </div>
                        <small id="ten_help" class="form-text text-danger"></small>

                        <!-- email -->
                        <label for="register_email" class="col-form-label">Email:</label>
                        <div class="input-group mb-1 w-100">
                            <div class="input-group-prepend input-register">
                                <label for="register_email" class="input-group-text bg-secondary">
                                    <i class="fa fa-envelope-o icon-form" aria-hidden="true"></i>
                                </label>
                            </div>
                            <input name="register_email" id="register_email" type="text" class="form-control input-register" aria-label="Small">
                        </div>
                        <small id="email_help" class="form-text text-danger"></small>

                        <!-- mật khẩu -->
                        <label for="register_mat_khau" class="col-form-label">Mật Khẩu:</label>
                        <div class="input-group mb-1 w-100">
                            <div class="input-group-prepend input-register">
                                <label for="register_mat_khau" class="input-group-text bg-secondary">
                                    <i class="fa fa-key icon-form" aria-hidden="true"></i>
                                </label>
                            </div>
                            <input name="register_mat_khau" id="register_mat_khau" type="password" class="form-control input-register" aria-label="Small">
                        </div>
                        <small id="mat_khau_help" class="form-text text-danger"></small>

                        <!-- nhập lại mật khẩu -->
                        <label for="register_nhap_lai_mat_khau" class="col-form-label">Nhập Lại Mật Khẩu:</label>
                        <div class="input-group mb-1 w-100">
                            <div class="input-group-prepend input-register">
                                <label for="register_nhap_lai_mat_khau" class="input-group-text bg-secondary">
                                    <i class="fa fa-key icon-form" aria-hidden="true"></i>
                                </label>
                            </div>
                            <input name="register_nhap_lai_mat_khau" id="register_nhap_lai_mat_khau" type="password" class="form-control input-register" aria-label="Small">
                        </div>
                        <small id="nhap_lai_mat_khau_help" class="form-text text-danger"></small>

                        <!-- số điện thoại -->
                        <label for="register_sdt" class="col-form-label">Số Điện Thoại:</label>
                        <div class="input-group mb-1 w-100">
                            <div class="input-group-prepend input-register">
                                <label for="register_sdt" class="input-group-text bg-secondary">
                                    <i class="fa fa-phone icon-form" aria-hidden="true"></i>
                                </label>
                            </div>
                            <input name="register_sdt" id="register_sdt" type="text" class="form-control input-register" aria-label="Small">
                        </div>
                        <small id="sdt_help" class="form-text text-danger"></small>

                        <!-- địa chỉ -->
                        <label for="register_dia_chi" class="col-form-label">Số nhà/tên đường:</label>
                        <div class="input-group mb-1 w-100">
                            <div class="input-group-prepend input-register">
                                <label for="register_dia_chi" class="input-group-text bg-secondary">
                                    <i class="fa fa-map-marker icon-form" aria-hidden="true"></i>
                                </label>
                            </div>
                            <input name="register_dia_chi" id="register_dia_chi" type="text" class="form-control input-register" aria-label="Small">
                        </div>
                        <small id="dia_chi_help" class="form-text text-danger"></small>

                        <!-- tỉnh -->
                        <label for="sl_tinhthanhpho">Tỉnh Thành Phố:</label>
                        <select name="sl_tinhthanhpho" id="sl_tinhthanhpho" class="custom-select mb-3">
                            <option value="" selected>Vui lòng chọn Tỉnh Thành Phố</option>
                            <?php
                            while ($row_tinhthanhpho = mysqli_fetch_array($query_tinhthanhpho)) {
                            ?>
                                <option value="<?= $row_tinhthanhpho['id_ttp'] ?>"><?= $row_tinhthanhpho['ten_ttp'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <!-- huyện -->
                        <label for="sl_quanhuyen">Quận Huyện:</label>
                        <select name="sl_quanhuyen" id="sl_quanhuyen" class="custom-select mb-3" disabled>
                            <option value="" selected>Vui lòng chọn Quận Huyện</option>
                            <?php
                            while ($row_quanhuyen = mysqli_fetch_array($query_quanhuyen)) {
                            ?>
                                <option value="<?= $row_quanhuyen['id_qh'] ?>"><?= $row_quanhuyen['ten_qh'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <!-- xã -->
                        <label for="sl_xaphuong">Xã Phường:</label>
                        <select name="sl_xaphuong" id="sl_xaphuong" class="custom-select mb-3" disabled>
                            <option value="" selected>Vui lòng chọn Xã Phường</option>
                            <?php
                            while ($row_xaphuong = mysqli_fetch_array($query_xaphuong)) {
                            ?>
                                <option value="<?= $row_xaphuong['id_xp'] ?>"><?= $row_xaphuong['ten_xp'] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <!-- checkbox đồng ý -->
                        <input type="checkbox" name="chk_agree" id="chk_agree" value="dongy" class="chk-register mt-3">
                        <label for="chk_agree" class="text-checkbox-register">
                            &nbsp;Đồng Ý Với Các
                            <a href="terms_policies.php">Điều Khoản & Chính Sách</a>
                        </label>
                        <small id="register-agree" class="form-text text-error mb-3"></small>

                        <!-- btn đăng ký -->
                        <div class="mb-3">
                            <button id="btn-register" type="submit" class="btn btn-primary w-100 p-1 text-btn-register">Đăng Ký</button>
                        </div>

                        <div class="float-right mb-3 mt-3">
                            <span>Đã Có Tài Khoản? </span>
                            <a href="#" data-toggle="modal" data-target="#modal-login">Đăng Nhập</a>
                        </div>
                    </div>
                </form>
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