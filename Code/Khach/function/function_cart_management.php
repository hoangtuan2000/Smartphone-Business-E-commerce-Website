<?php
session_start();
include 'function_connect_db.php';
include 'function_find_database.php';
include 'function_show_database.php';
include 'function_money_format.php';

//kiểm tra số lượng sản phẩm có trong kho
if (isset($_POST['send_check_quantity_id_sp'])) {
    $id_sp = $_POST['send_check_quantity_id_sp'];

    $result_product = get_sanpham($id_sp);
    echo $result_product['so_luong_sp'];
}


//thêm sản phẩm vào giỏ hàng
if (isset($_POST['send_insert_cart_id_sp'])) {
    $id_sp = $_POST['send_insert_cart_id_sp'];
    $id_kh = $_SESSION['user']['id_kh'];
    $giohang = get_giohang($id_kh);
    $id_gh = $giohang['id_gh'];

    $product = get_sanpham($id_sp);
    $khuyenmai = get_khuyenmai($product['id_km']);
    $gia_old = $product['gia_sp'];
    $gia_new = price_after_promotion($gia_old, $khuyenmai['giam_km']);

    $sql_check_cart = "SELECT * FROM `chitietgiohang` WHERE id_sp = '$id_sp' AND id_gh = '$id_gh'";
    $query_check_cart = mysqli_query($con, $sql_check_cart);
    $num = mysqli_num_rows($query_check_cart);
    if ($num > 0) {
        echo "exist";
    } else {
        $sql_insert_cart = "INSERT INTO `chitietgiohang`(`id_sp`, `id_gh`, `so_luong`) VALUES ('$id_sp','$id_gh','1')";
        $query_insert_cart = mysqli_query($con, $sql_insert_cart);
        if ($query_insert_cart == true) {
            echo "success";
        } else {
            echo "fail";
        }
    }
}


//xóa sản phẩm trong giỏ hàng
if (isset($_POST['send_delete_cart_id_sp'])) {
    $id_sp = $_POST['send_delete_cart_id_sp'];
    $id_kh = $_SESSION['user']['id_kh'];
    $giohang = get_giohang($id_kh);
    $id_gh = $giohang['id_gh'];

    $sql_delete_giohang = "DELETE FROM `chitietgiohang` WHERE id_gh = '$id_gh' AND id_sp = '$id_sp'";
    $query_delete_giohang = mysqli_query($con, $sql_delete_giohang);

    if ($query_delete_giohang = true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//tăng giảm sản phẩm trong giỏ hàng
if(isset($_POST['send_up_down_product_id_sp']) && isset($_POST['send_up_down_product_so_luong'])){
    $id_sp = $_POST['send_up_down_product_id_sp'];
    $so_luong = $_POST['send_up_down_product_so_luong'];
    $id_kh = $_SESSION['user']['id_kh'];
    $giohang = get_giohang($id_kh);
    $id_gh = $giohang['id_gh'];

    $sql = "UPDATE `chitietgiohang` SET `so_luong`='$so_luong' WHERE id_sp = '$id_sp' AND id_gh = '$id_gh'";
    $query = mysqli_query($con, $sql);
    if($query == true){
        echo "success";
    }else{
        echo "fail";
    }
}