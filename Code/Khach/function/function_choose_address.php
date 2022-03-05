<?php
require('function_connect_db.php');

/**************************************  Chọn Xã/Huyện/Tỉnh Nhân Viên-Nhà cung Cấp  **************************************/
// select update tinh =>  huyen
if (isset($_POST['send_id_tinhthanhpho'])) {
    $id_tinh = $_POST['send_id_tinhthanhpho']; //lay ID thanh pho da chon gui tu file ajax.js
    $sql_tinh = "SELECT * FROM `quanhuyen` WHERE id_ttp = '$id_tinh'";
    $query_tinh = mysqli_query($con, $sql_tinh);
    $num = mysqli_num_rows($query_tinh);
    if ($num > 0) {
?>

        <option value="">Chọn Quận Huyện</option>

        <?php
        while ($row = mysqli_fetch_array($query_tinh)) {
        ?>
            <option value="<?= $row['id_qh'] ?>"><?= $row['ten_qh'] ?></option>
<?php
        }
    }
}

//select update huyen => xa
if (isset($_POST['send_id_quanhuyen'])) {
    $id_huyen = $_POST['send_id_quanhuyen']; //lay ID huyen da chon gui tu file ajax.js
    $sql_huyen = "SELECT * FROM `xaphuong` WHERE id_qh = '$id_huyen'";
    $query_huyen = mysqli_query($con, $sql_huyen);
    $num = mysqli_num_rows($query_huyen);
    if ($num > 0) {
?>

        <option value="">Chọn Xã Phường</option>

        <?php
        while ($row = mysqli_fetch_array($query_huyen)) {
        ?>
            <option value="<?= $row['id_xp'] ?>"><?= $row['ten_xp'] ?></option>
<?php
        }
    }
}