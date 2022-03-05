<?php
require('function_connect_db.php');

//kiểm tra email có tồn tại hay chưa
if(isset($_POST['send_check_email_exits'])){
    $email = $_POST['send_check_email_exits'];

    $sql = "SELECT * FROM `nhanvien` WHERE email_nv = '$email'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if($num > 0){
        echo "fail";
    }else{
        echo "success";
    }
}

//update database NHANVIEN
if (isset($_POST['send_update_id_nv'])) {
    $update_id_nv = $_POST['send_update_id_nv'];
    $update_ten_nv_new = $_POST['send_update_ten_nv_new'];
    $update_sdt_nv_new = $_POST['send_update_sdt_nv_new'];
    $update_email_nv_new = $_POST['send_update_email_nv_new'];
    $update_password_nv_new = $_POST['send_update_password_nv_new'];
    $update_chucvu_nv_new = $_POST['send_update_chucvu_nv_new'];
    $update_trangthaihoatdong_nv_new = $_POST['send_update_trangthaihoatdong_nv_new'];
    $update_diachi_nv_new = $_POST['send_update_diachi_nv_new'];
    $update_xaphuong_nv_new = $_POST['send_update_xaphuong_nv_new'];

    $sql_update_nv = "UPDATE `nhanvien` SET `ten_nv`='$update_ten_nv_new',`sdt_nv`='$update_sdt_nv_new',`dia_chi_nv`='$update_diachi_nv_new',
    `email_nv`='$update_email_nv_new',`id_xp`='$update_xaphuong_nv_new',`password`='$update_password_nv_new',
    `id_cv`='$update_chucvu_nv_new',`id_tthd`='$update_trangthaihoatdong_nv_new' WHERE id_nv = '$update_id_nv'";
    
    $query_update_nv = mysqli_query($con, $sql_update_nv);

    if ($query_update_nv == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//Insert database NHANVIEN
if (isset($_POST['send_insert_ten_nv'])) {
    $insert_ten_nv = $_POST['send_insert_ten_nv'];
    $insert_sdt_nv = $_POST['send_insert_sdt_nv'];
    $insert_email_nv = $_POST['send_insert_email_nv'];
    $insert_password_nv = $_POST['send_insert_password_nv'];
    $insert_chucvu_nv = $_POST['send_insert_chucvu_nv'];
    $insert_diachi_nv = $_POST['send_insert_diachi_nv'];
    $insert_xaphuong_nv = $_POST['send_insert_xaphuong_nv'];

    $sql_insert_nv = "INSERT INTO `nhanvien`(`ten_nv`, `sdt_nv`, `dia_chi_nv`, `email_nv`, `id_xp`, `password`, `id_cv`, `id_tthd`) 
    VALUES ('$insert_ten_nv','$insert_sdt_nv','$insert_diachi_nv','$insert_email_nv','$insert_xaphuong_nv', '$insert_password_nv','$insert_chucvu_nv','C')";
    $query_insert_nv = mysqli_query($con, $sql_insert_nv);

    if ($query_insert_nv == true) {
        echo "success";
    } else {
        echo "fail";
    }
}


