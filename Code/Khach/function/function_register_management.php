<?php
include 'function_connect_db.php';

//kiem tra email ton tai
if (isset($_POST['send_check_email_exist'])) {
    $email = $_POST['send_check_email_exist'];

    $sql = "SELECT * FROM `khachhang` WHERE email_kh = '$email'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num > 0) {
        echo "fail";
    } else {
        echo "success";
    }
}

//dang ky tai khoan
if (isset($_POST['register_email']) && !empty($_POST['register_email'])) {
    $ten = $_POST['register_ten'];
    $email = $_POST['register_email'];
    $mat_khau = $_POST['register_mat_khau'];
    $sdt = $_POST['register_sdt'];
    $dia_chi = $_POST['register_dia_chi'];
    $xaphuong = $_POST['sl_xaphuong'];

    $sql_insert_khachhang = "INSERT INTO `khachhang`(`ten_kh`, `sdt_kh`, `email_kh`, `password_kh`) VALUES ('$ten','$sdt','$email','$mat_khau')";
    $query_insert_khachhang = mysqli_query($con, $sql_insert_khachhang);

    $id_kh = mysqli_insert_id($con);

    if ($query_insert_khachhang == true) {

        $sql_insert_diachi = "INSERT INTO `diachi`(`dia_chi`, `mac_dinh`, `id_xp`, `id_kh`) VALUES ('$dia_chi','1','$xaphuong','$id_kh')";
        $query_insert_diachi = mysqli_query($con, $sql_insert_diachi);

        if($query_insert_diachi == true){
            $sql_cart = "INSERT INTO `giohang`(`id_kh`) VALUES ('$id_kh')";
            $query_cart = mysqli_query($con, $sql_cart);
            if($query_cart == true){
                echo "success";
            }
            else{
                echo "fail";
            }
        }
    }
}
