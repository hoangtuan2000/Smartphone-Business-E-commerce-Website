<?php
session_start();
include 'function_connect_db.php';
include 'function_show_database.php';
include 'function_find_database.php';
include 'function_money_format.php';


//kiểm tra giỏ hàng có rỗng không
if (isset($_POST['send_check_empty_giohang'])) {
    $id_kh = $_SESSION['user']['id_kh'];
    $giohang = get_giohang($id_kh);
    $id_gh = $giohang['id_gh'];

    $sql_check_empty_giohang = "SELECT * FROM `chitietgiohang` WHERE id_gh = '$id_gh'";
    $query_check_empty_giohang = mysqli_query($con, $sql_check_empty_giohang);
    $num = mysqli_num_rows($query_check_empty_giohang);
    if ($num == 1) {
        echo "empty";
    } else {
        echo "not empty";
    }
}

//ĐẶT HÀNG thông qua GIỎ HÀNG
if (isset($_POST['send_order_cart_id_kh']) && isset($_POST['send_order_cart_nguoi_nhan'])) {
    $id_kh = $_POST['send_order_cart_id_kh'];
    $nguoi_nhan = $_POST['send_order_cart_nguoi_nhan'];
    $sdt = $_POST['send_order_cart_sdt'];
    $dia_chi_giao = $_POST['send_order_cart_dia_chi_giao'];
    $ghi_chu = $_POST['send_order_cart_ghi_chu'];

    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $ngay_dat = date('H:s:i d-m-Y');
    $error = "";

    //lấy thông tin giỏ hàng thông qua ID khách hàng
    $giohang = get_giohang($id_kh);
    $id_gh = $giohang['id_gh'];

    $sql_create_donhang = "INSERT INTO `donhang`(`nguoi_nhan`, `so_dien_thoai`, `dia_chi_giao`, `ghi_chu`, `ngay_dat`, `id_kh`, `id_ttdh`) 
    VALUES ('$nguoi_nhan','$sdt','$dia_chi_giao','$ghi_chu','$ngay_dat','$id_kh','1')";
    $query_create_donhang = mysqli_query($con, $sql_create_donhang);

    $id_dh = mysqli_insert_id($con);
    // thêm sản phẩm vào CHI TIẾT HÓA ĐƠN
    if ($query_create_donhang == true) {
        //lấy thông tin giỏ hàng thông qua ID khách hàng
        $giohang = get_giohang($id_kh);
        //lấy thông tin chi tiết giỏ hàng thông qua ID giỏ hàng
        $query_chitietgiohang = get_chitietgiohang($giohang['id_gh']);

        while ($result_chitietgiohang = mysqli_fetch_array($query_chitietgiohang)) {
            $id_sp = $result_chitietgiohang['id_sp'];
            $so_luong = $result_chitietgiohang['so_luong'];

            $product = get_sanpham($id_sp);
            $khuyenmai = get_khuyenmai($product['id_km']);
            $khuyenmai = $khuyenmai['giam_km'];
            $gia_old = $product['gia_sp'];

            $sql_insert_chitietdonhang = "INSERT INTO `chitietdonhang`(`id_dh`, `id_sp`, `gia`, `so_luong`, `khuyen_mai`) 
            VALUES ('$id_dh','$id_sp','$gia_old','$so_luong','$khuyenmai')";
            $query_insert_chitietgiohang = mysqli_query($con, $sql_insert_chitietdonhang);

            // nếu thêm vô chi tiet don hang thanh cong thi trừ số lượng trong kho
            if ($query_insert_chitietgiohang == true) {
                $so_luong_sp = $product['so_luong_sp'];
                $so_luong_con_lai = $so_luong_sp - $so_luong;
                $sql = "UPDATE `sanpham` SET `so_luong_sp`='$so_luong_con_lai' WHERE id_sp = '$id_sp'";
                $query = mysqli_query($con, $sql);
                if ($query == false) {
                    $error = "fail";
                }
            } else {
                $error = "fail";
            }
        }

        if ($error == "") {
            //nếu thêm vào đơn hàng thành công thì xóa chi tiet giỏ hàng đi
            $sql_delete_chitietgiohang = "DELETE FROM `chitietgiohang` WHERE id_gh = '$id_gh'";
            $query_delete_chitietgiohang = mysqli_query($con, $sql_delete_chitietgiohang);
            echo $id_dh;
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//ĐẶT HÀNG thông qua nút MUA thẳng theo ID sản phẩm
if (isset($_POST['send_order_id_sp']) && isset($_POST['send_order_id_kh']) && !empty($_POST['send_order_id_sp']) && !empty($_POST['send_order_id_kh'])) {
    $id_sp = $_POST['send_order_id_sp'];
    $id_kh = $_POST['send_order_id_kh'];
    $so_luong = $_POST['send_order_so_luong'];
    $nguoi_nhan = $_POST['send_order_nguoi_nhan'];
    $sdt = $_POST['send_order_sdt'];
    $dia_chi_giao = $_POST['send_order_dia_chi_giao'];
    $ghi_chu = $_POST['send_order_ghi_chu'];

    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $ngay_dat = date('H:s:i d-m-Y');
    $error = "";

    $product = get_sanpham($id_sp);
    $khuyenmai = get_khuyenmai($product['id_km']);
    $khuyenmai = $khuyenmai['giam_km'];
    $gia_old = $product['gia_sp'];

    //tạo ĐƠN HÀNG
    $sql_create_donhang = "INSERT INTO `donhang`(`nguoi_nhan`, `so_dien_thoai`, `dia_chi_giao`, `ghi_chu`, `ngay_dat`, `id_kh`, `id_ttdh`) 
    VALUES ('$nguoi_nhan','$sdt','$dia_chi_giao','$ghi_chu','$ngay_dat','$id_kh','1')";
    $query_create_donhang = mysqli_query($con, $sql_create_donhang);

    $id_dh = mysqli_insert_id($con);

    if ($query_create_donhang == true) {
        //thêm vào CHI TIET DON HANG
        $sql_insert_chitietdonhang = "INSERT INTO `chitietdonhang`(`id_dh`, `id_sp`, `gia`, `so_luong`, `khuyen_mai`) 
            VALUES ('$id_dh','$id_sp','$gia_old','$so_luong','$khuyenmai')";
        $query_insert_chitietgiohang = mysqli_query($con, $sql_insert_chitietdonhang);

        if ($query_insert_chitietgiohang == true) {
            //cập nhật lại số lượng sản phẩm khi đặt hàng thanh công
            $so_luong_sp = $product['so_luong_sp'];
            $so_luong_con_lai = $so_luong_sp - $so_luong;
            $sql_update_soluong = "UPDATE `sanpham` SET `so_luong_sp`='$so_luong_con_lai' WHERE id_sp = '$id_sp'";
            $query_update_soluong = mysqli_query($con, $sql_update_soluong);

            echo $id_dh;
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

