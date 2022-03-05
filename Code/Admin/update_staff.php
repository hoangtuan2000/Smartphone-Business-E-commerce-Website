<?php
session_start();
include 'function/function_connect_db.php';
include 'function/function_show_database.php';
include 'function/function_find_database.php';

$user = $_SESSION['current_user'];
?>

<?php
if ($user['id_cv'] == "QT" && isset($_GET['id_staff']) || $user['id_cv'] == "AD" && isset($_GET['id_staff'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cập Nhật Nhân Viên - HT SHOP</title>

        <script src="vendor/jquery/jquery.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="javascript/javascript-manage.js"></script>
        <script src="javascript/javascript-ajax-choose-address.js"></script>
        <script src="javascript/javascript-ajax-staff-management.js"></script>


        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css" type="text/css">

        <link rel="stylesheet" href="style/style-base.css" type="text/css">
        <link rel="stylesheet" href="style/style-manage.css" type="text/css">
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

                <p class="mx-auto text-notification-header">Cập Nhật Tài Khoản Nhân Viên</p>

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

        <!-- khung hien thi cap nhat nhân viên -->
        <div class="container tab-content">
            <?php
            $id_nv = $_GET['id_staff'];
            $sql = "SELECT * FROM `nhanvien` WHERE id_nv = '$id_nv'";
            $query = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($query)) {
                //tìm ket qua xã phường / quận huyện / tỉnh thành phố có id_xp theo nhan vien 
                $find_xaphuong  = find_xaphuong($row['id_xp']);
                $result_find_xaphuong = mysqli_fetch_array($find_xaphuong);
                $id_qh = $result_find_xaphuong['id_qh'];

                $find_quanhuyen  = find_quanhuyen($id_qh);
                $result_find_quanhuyen = mysqli_fetch_array($find_quanhuyen);
                $id_ttp = $result_find_quanhuyen['id_ttp'];

                $find_tinhthanhpho  = find_tinhthanhpho($id_ttp);
                $result_find_tinhthanhpho = mysqli_fetch_array($find_tinhthanhpho);
            ?>
                <div class="row bg-secondary rounded p-3 text-white">
                    <form class="w-100" action="" method="POST">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group input-group-sm">
                                    <input hidden id="update_id_nv" readonly type="text" value="<?= $row['id_nv'] ?>" class="form-control mb-3">

                                    <label for="update_ten_nv">Tên Nhân Viên:</label>
                                    <input id="update_ten_nv" type="text" value="<?= $row['ten_nv'] ?>" class="form-control mb-3">
                                    <small id="update_ten_nv_help" class="form-text text-warning mb-1"></small>

                                    <label for="update_sdt_nv">SDT Nhân Viên:</label>
                                    <input id="update_sdt_nv" type="text" value="<?= $row['sdt_nv'] ?>" class="form-control mb-3">
                                    <small id="update_sdt_nv_help" class="form-text text-warning mb-1"></small>

                                    <label for="update_email_nv">Email Nhân Viên:</label>
                                    <input id="update_email_nv" type="text" value="<?= $row['email_nv'] ?>" class="form-control mb-3">
                                    <small id="update_email_nv_help" class="form-text text-warning mb-1"></small>

                                    <label for="update_password_nv">PassWord:</label>
                                    <input id="update_password_nv" type="text" value="<?= $row['password'] ?>" class="form-control mb-3">
                                    <small id="update_password_nv_help" class="form-text text-warning mb-1"></small>

                                    <label for="update_sl_chucvu_nv">Chức Vụ:</label>
                                    <select id="update_sl_chucvu_nv" class="custom-select mb-3">
                                        <option value="">Vui lòng chọn Chức Vụ</option>
                                        <?php
                                        while ($row_chucvu = mysqli_fetch_array($query_chucvu)) {
                                            if ($row_chucvu['id_cv'] == $row['id_cv']) {
                                        ?>
                                                <option value="<?= $row_chucvu['id_cv'] ?>" selected><?= $row_chucvu['ten_cv'] ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?= $row_chucvu['id_cv'] ?>"><?= $row_chucvu['ten_cv'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group input-group-sm">
                                    <label for="sl_tinhthanhpho">Tỉnh Thành Phố:</label>
                                    <select id="sl_tinhthanhpho" class="custom-select mb-3">
                                        <option value="">Vui lòng chọn Tỉnh Thành Phố</option>
                                        <?php
                                        while ($row_tinhthanhpho = mysqli_fetch_array($query_tinhthanhpho)) {
                                            if ($row_tinhthanhpho['id_ttp'] == $id_ttp) {
                                        ?>
                                                <option value="<?= $row_tinhthanhpho['id_ttp'] ?>" selected><?= $row_tinhthanhpho['ten_ttp'] ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?= $row_tinhthanhpho['id_ttp'] ?>"><?= $row_tinhthanhpho['ten_ttp'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>


                                    <label for="sl_quanhuyen">Quận Huyện:</label>
                                    <select id="sl_quanhuyen" class="custom-select mb-3" disabled>
                                        <option value="">Vui lòng chọn Quận Huyện</option>
                                        <?php
                                        while ($row_quanhuyen = mysqli_fetch_array($query_quanhuyen)) {
                                            if ($row_quanhuyen['id_qh'] == $id_qh) {
                                        ?>
                                                <option value="<?= $row_quanhuyen['id_qh'] ?>" selected><?= $row_quanhuyen['ten_qh'] ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?= $row_quanhuyen['id_qh'] ?>"><?= $row_quanhuyen['ten_qh'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>


                                    <label for="sl_xaphuong">Xã Phường:</label>
                                    <select id="sl_xaphuong" class="custom-select mb-3" disabled>
                                        <option value="">Vui lòng chọn Xã Phường</option>
                                        <?php
                                        while ($row_xaphuong = mysqli_fetch_array($query_xaphuong)) {
                                            if ($row_xaphuong['id_xp'] == $row['id_xp']) {
                                        ?>
                                                <option value="<?= $row_xaphuong['id_xp'] ?>" selected><?= $row_xaphuong['ten_xp'] ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?= $row_xaphuong['id_xp'] ?>"><?= $row_xaphuong['ten_xp'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                    <label for="update_diachi_nv">Số Nhà / Tên Đường:</label>
                                    <input id="update_diachi_nv" type="text" value="<?= $row['dia_chi_nv'] ?>" class="form-control mb-3">
                                    <small id="update_diachi_nv_help" class="form-text text-warning mb-1"></small>
                                    
                                    <label for="update_sl_trangthaihoatdong_nv">Trạng Thái Hoạt Động:</label>
                                    <select id="update_sl_trangthaihoatdong_nv" class="custom-select mb-3">
                                        <option value="">Vui lòng chọn trạng thái hoạt động</option>
                                        <?php
                                        while ($row_tthd = mysqli_fetch_array($query_trangthaihoatdong)) {
                                            if ($row_tthd['id_tthd'] == $row['id_tthd']) {
                                               
                                        ?>
                                                <option value="<?= $row_tthd['id_tthd'] ?>" selected><?= $row_tthd['ten_tthd'] ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?= $row_tthd['id_tthd'] ?>"><?= $row_tthd['ten_tthd'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button name="btn-update-nv" type="button" class="btn btn-warning w-50">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    Cập Nhật Nhân Viên
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>






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