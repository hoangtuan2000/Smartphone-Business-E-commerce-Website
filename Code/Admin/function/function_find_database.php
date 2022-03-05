<?php
include('function_connect_db.php');
/********************************************************************************************/
//lấy trang thai don hang theo mã
function get_trangthaidonhang($id_ttdh)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `trangthaidonhang` WHERE id_ttdh = '$id_ttdh'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

/********************************************************************************************/
//lấy  sản phẩm
function get_sanpham($id_sp)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `sanpham` WHERE id_sp = '$id_sp'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//lấy điện thoại theo mã
function get_dienthoai($id_sp)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `dienthoai` WHERE id_sp = '$id_sp'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//lấy tai nghe theo mã
function get_tainghe($id_sp)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `tainghe` WHERE id_sp = '$id_sp'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//lấy ốp lưng theo mã
function get_oplung($id_sp)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `oplung` WHERE id_sp = '$id_sp'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}
/********************************************************************************************/
//lấy loại sản phẩm
function get_loaisanpham($id_lsp)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `loaisanpham` WHERE id_lsp = '$id_lsp'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}


/********************************************************************************************/
//tìm ảnh sản phẩm theo mã sản phẩm trong table anhsanpham
function find_anhsanpham($id_sp)
{
    include 'function_connect_db.php';
    $sql_find_anhsanpham = "SELECT * FROM `anhsanpham` WHERE id_sp = '$id_sp'";
    $query_find_anhsanpham = mysqli_query($con, $sql_find_anhsanpham);
    return $query_find_anhsanpham;
}
/********************************************************************************************/
// chi tiết giỏ hàng
function get_chitietdonhang($id_dh)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `chitietdonhang` WHERE id_dh = '$id_dh'";
    $query = mysqli_query($con, $sql);
    return $query;
}

/********************************************************************************************/
//tìm chức vụ
function find_chucvu($id_cv)
{
    include 'function_connect_db.php';
    $sql_find_chucvu = "SELECT * FROM `chucvu` WHERE id_cv = '$id_cv'";
    $query_find_chucvu = mysqli_query($con, $sql_find_chucvu);
    return $query_find_chucvu;
}

//tìm TRẠNG THÁI HOẠT ĐỘNG
function get_trangthaihoatdong($id_tthd)
{
    include 'function_connect_db.php';
    $sql_find_trangthaihoatdong = "SELECT * FROM `trangthaihoatdong` WHERE id_tthd = '$id_tthd'";
    $query_find_trangthaihoatdong = mysqli_query($con, $sql_find_trangthaihoatdong);
    $result = mysqli_fetch_array($query_find_trangthaihoatdong);
    return $result;
}

//lấy DON HANG
function get_donhang($id_dh)
{
    include 'function_connect_db.php';
    $sql_find_donhang = "SELECT * FROM `donhang` WHERE id_dh = '$id_dh'";
    $query_find_donhang = mysqli_query($con, $sql_find_donhang);
    $result = mysqli_fetch_array($query_find_donhang);
    return $result;
}


/********************************************************************************************/
//tìm xã phường
function find_xaphuong($id_xp)
{
    include 'function_connect_db.php';
    $sql_find_xaphuong = "SELECT * FROM `xaphuong` WHERE id_xp = $id_xp";
    $query_find_xaphuong = mysqli_query($con, $sql_find_xaphuong);
    return $query_find_xaphuong;
}

//tìm quận huyện
function find_quanhuyen($id_qh)
{
    include 'function_connect_db.php';
    $sql_find_quanhuyen = "SELECT * FROM `quanhuyen` WHERE id_qh = $id_qh";
    $query_find_quanhuyen = mysqli_query($con, $sql_find_quanhuyen);
    return $query_find_quanhuyen;
}

//tìm tỉnh thành phố
function find_tinhthanhpho($id_ttp)
{
    include 'function_connect_db.php';
    $sql_find_tinhthanhpho = "SELECT * FROM `tinhthanhpho` WHERE id_ttp = $id_ttp";
    $query_find_tinhthanhpho = mysqli_query($con, $sql_find_tinhthanhpho);
    return $query_find_tinhthanhpho;
}
/********************************************************************************************/

