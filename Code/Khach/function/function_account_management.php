<?php
session_start();
include 'function_connect_db.php';
include 'function_find_database.php';
include 'function_show_database.php';

//kiem tra email ton tai
if (isset($_POST['send_check_email_update_exist'])) {
    $email = $_POST['send_check_email_update_exist'];
    $id_kh = $_POST['send_id_kh'];

    $sql = "SELECT * FROM `khachhang` WHERE email_kh = '$email' AND id_kh != '$id_kh'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num > 0) {
        echo "fail";
    } else {
        echo "success";
    }
}

//update thong tin khac hang
if (isset($_POST['send_update_id'])) {
    $id_kh = $_POST['send_update_id'];
    $ten_kh = $_POST['send_update_ten'];
    $email_kh = $_POST['send_update_email'];
    $sdt_kh = $_POST['send_update_sdt'];

    $sql_update = "UPDATE `khachhang` SET `ten_kh`='$ten_kh',`sdt_kh`='$sdt_kh',`email_kh`='$email_kh' WHERE id_kh = '$id_kh'";
    $query_update = mysqli_query($con, $sql_update);

    if ($query_update == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//đổi mật khẩu
if (isset($_POST['send_update_password_matkhau_cu'])) {
    $id_kh = $_POST['send_update_password_id_kh'];
    $matkhau_cu = $_POST['send_update_password_matkhau_cu'];
    $matkhau_moi = $_POST['send_update_password_matkhau_moi'];

    $sql = "SELECT * FROM `khachhang` WHERE id_kh = '$id_kh' AND password_kh = '$matkhau_cu'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num > 0) {
        $sql_update_password = "UPDATE `khachhang` SET `password_kh`='$matkhau_moi' WHERE id_kh = '$id_kh'";
        $query_update_password = mysqli_query($con, $sql_update_password);
        if ($query_update_password == true) {
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//thêm địa chỉ giao hàng
if (isset($_POST['send_insert_diachi_dia_chi'])) {
    $dia_chi = $_POST['send_insert_diachi_dia_chi'];
    $id_xp = $_POST['send_insert_diachi_id_xp'];
    $id_kh = $_SESSION['user']['id_kh'];

    $sql_insert_diachi = "INSERT INTO `diachi`(`dia_chi`, `mac_dinh`, `id_xp`, `id_kh`) VALUES ('$dia_chi',0,'$id_xp',$id_kh)";
    $query_insert_diachi = mysqli_query($con, $sql_insert_diachi);
    if ($query_insert_diachi == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//CHANGE địa chỉ mặc định
if (isset($_POST['send_change_diachi_macdinh_id'])) {
    $id_dc = $_POST['send_change_diachi_macdinh_id'];
    $id_kh = $_SESSION['user']['id_kh'];

    //tìm địa chỉ mặc định đổi thành địa chỉ thường nếu như khách hàng thêm địa chỉ mới
    $diachi_macdinh = get_diachi_mac_dinh($id_kh);
    $id_dc_macdinh = $diachi_macdinh['id_dc'];
    $sql_change_diachi_macdinh = "UPDATE `diachi` SET `mac_dinh`= 0 WHERE id_dc = $id_dc_macdinh";
    $query_change_diachi_macdinh = mysqli_query($con, $sql_change_diachi_macdinh);

    if ($query_change_diachi_macdinh == true) {

        $sql_change_diachi_macdinh = "UPDATE `diachi` SET `mac_dinh`=1 WHERE id_dc = '$id_dc'";
        $query_change_diachi_macdinh = mysqli_query($con, $sql_change_diachi_macdinh);
        if ($query_change_diachi_macdinh == true) {
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//Xóa địa chỉ
if (isset($_POST['send_delete_diachi_id'])) {
    $id_dc = $_POST['send_delete_diachi_id'];

    $sql_delete_diachi = "DELETE FROM `diachi` WHERE id_dc = '$id_dc'";
    $query_delete_diachi = mysqli_query($con, $sql_delete_diachi);

    if ($query_delete_diachi == true) {
        echo  "success";
    } else {
        echo "fail";
    }
}

//MODAL lấy thông tin địa chỉ trả về cho MODAL update địa chỉ
if (isset($_POST['send_get_diachi_id'])) {
    $id_dc = $_POST['send_get_diachi_id'];

    $sql_get_diachi = "SELECT * FROM `diachi` WHERE id_dc = $id_dc";
    $query_get_diachi = mysqli_query($con, $sql_get_diachi);

    while ($result_diachi = mysqli_fetch_array($query_get_diachi)) {
        $xaphuong = get_xaphuong($result_diachi['id_xp']);
        $quanhuyen = get_quanhuyen($xaphuong['id_qh']);
        $tinhthanhpho = get_tinhthanhpho($quanhuyen['id_ttp']);
?>
        <script src="javascript/javascript-ajax-choose-address.js"></script>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="sl_tinhthanhpho">Tỉnh Thành Phố</label>
                <select id="sl_tinhthanhpho" class="form-control">
                    <option value="">Chọn tỉnh thành phố</option>
                    <?php
                    while ($row_tinhthanhpho = mysqli_fetch_array($query_tinhthanhpho)) {
                        if ($row_tinhthanhpho['id_ttp'] == $tinhthanhpho['id_ttp']) {
                    ?>
                            <option selected value="<?= $row_tinhthanhpho['id_ttp'] ?>"><?= $row_tinhthanhpho['ten_ttp'] ?></option>
                        <?php
                        } else {
                        ?>
                            <option value="<?= $row_tinhthanhpho['id_ttp'] ?>"><?= $row_tinhthanhpho['ten_ttp'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="sl_quanhuyen">Quận Huyện</label>
                <select id="sl_quanhuyen" class="form-control" disabled>
                    <option value="" selected>Chọn quận huyện</option>
                    <?php
                    while ($row_quanhuyen = mysqli_fetch_array($query_quanhuyen)) {
                        if ($row_quanhuyen['id_qh'] == $quanhuyen['id_qh']) {
                    ?>
                            <option selected value="<?= $row_quanhuyen['id_qh'] ?>"><?= $row_quanhuyen['ten_qh'] ?></option>
                        <?php
                        } else {
                        ?>
                            <option value="<?= $row_quanhuyen['id_qh'] ?>"><?= $row_quanhuyen['ten_qh'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="sl_xaphuong">Xã Phường</label>
                <select id="sl_xaphuong" class="form-control" disabled>
                    <option value="" selected>Chọn xã phường</option>
                    <?php
                    while ($row_xaphuong = mysqli_fetch_array($query_xaphuong)) {
                        if ($row_xaphuong['id_xp'] == $xaphuong['id_xp']) {
                    ?>
                            <option selected value="<?= $row_xaphuong['id_xp'] ?>"><?= $row_xaphuong['ten_xp'] ?></option>
                        <?php
                        } else {
                        ?>
                            <option value="<?= $row_xaphuong['id_xp'] ?>"><?= $row_xaphuong['ten_xp'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="update_diachi_dia_chi">Số nhà/tên đường</label>
                <input id="update_diachi_dia_chi" value="<?php echo $result_diachi['dia_chi'] ?>" type="text" class="form-control">
                <small id="update_diachi_dia_chi_help" class="form-text text-danger"></small>
            </div>

            <!-- nút update địa chỉ -->
            <div class="col-12 text-center">
                <button id="btn_update_diachi" value="<?php echo $id_dc ?>" type="button" class="btn btn-warning btn-sm">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                    Cập Nhật Địa Chỉ
                </button>
            </div>
        </div>
        <script>
            $(function() {
                $('#update_diachi_dia_chi').on('keyup', function() {
                    check_max_min(this, 100, 1, '#update_diachi_dia_chi_help', "địa chỉ từ 1-100 ký tự", "#btn_update_diachi");
                })
            })
        </script>
<?php
    }
}

//update địa chỉ
if (isset($_POST['send_update_diachi_id'])) {
    $id_dc = $_POST['send_update_diachi_id'];
    $id_xp = $_POST['send_update_diachi_id_xp'];
    $dia_chi = $_POST['send_update_diachi_dia_chi'];

    $sql_update_diachi = "UPDATE `diachi` SET `dia_chi`='$dia_chi',`id_xp`='$id_xp' WHERE id_dc = '$id_dc'";
    $query_update_diachi = mysqli_query($con, $sql_update_diachi);
    if ($query_update_diachi == true) {
        echo "success";
    } else {
        echo "fail";
    }
}
