<?php


/********************************************************************************/
//hàm lấy trạng thái Đơn hàng
function get_trangthaidonhang($id_ttdh){
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `trangthaidonhang` WHERE id_ttdh = '$id_ttdh'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

/********************************************************************************/
//lấy chi tiet don hang
function get_chitietdonhang($id_dh){
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `chitietdonhang` WHERE id_dh = '$id_dh'";
    $query = mysqli_query($con, $sql);
    return $query;
}


/********************************************************************************/
//hàm lấy đơn hàng limit 5
function get_recent_donhang($id_kh)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `donhang` WHERE id_kh = '$id_kh' ORDER BY id_dh DESC LIMIT 5";
    $query = mysqli_query($con, $sql);
    return $query;
}

//hàm lấy đơn hàng limit 5
function get_all_donhang($id_kh)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `donhang` WHERE id_kh = '$id_kh' ORDER BY id_dh DESC";
    $query = mysqli_query($con, $sql);
    return $query;
}

//hàm lấy đơn hàng theo id DON HANg
function get_donhang($id_dh)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `donhang` WHERE id_dh = '$id_dh'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

/********************************************************************************/
//hàm lấy thông tin khách hàng
function get_khachhang($id_kh)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `khachhang` WHERE id_kh = '$id_kh'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}


/********************************************************************************/
//hàm lấy giỏ hàng
function get_giohang($id_kh)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `giohang` WHERE id_kh = '$id_kh'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//hàm lấy giỏ hàng
function get_chitietgiohang($id_gh)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `chitietgiohang` WHERE id_gh = '$id_gh'";
    $query = mysqli_query($con, $sql);
    return $query;
}

/********************************************************************************/
//hàm lấy khuyến mãi
function get_khuyenmai($id_km)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `khuyenmai` WHERE id_km = '$id_km'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

/********************************************************************************/
//hàm lấy điện thoại khuyến mãi chưa được hiển thị
function get_dienthoai_khuyenmai_not_displayed($displayed)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `sanpham` WHERE id_lsp = 'DT' AND id_sp NOT IN ($displayed) AND id_km NOT IN (SELECT id_km FROM khuyenmai WHERE giam_km = '0') ORDER BY RAND() LIMIT 5";
    $query = mysqli_query($con, $sql);
    return $query;
}
//hàm lấy tai nghe khuyến mãi chưa được hiển thị
function get_tainghe_khuyenmai_not_displayed($displayed)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `sanpham` WHERE id_lsp = 'TN' AND id_sp NOT IN ($displayed) AND id_km NOT IN (SELECT id_km FROM khuyenmai WHERE giam_km = '0') ORDER BY RAND() LIMIT 5";
    $query = mysqli_query($con, $sql);
    return $query;
}
//hàm lấy ốp lưng khuyến mãi chưa được hiển thị
function get_oplung_khuyenmai_not_displayed($displayed)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `sanpham` WHERE id_lsp = 'OL' AND id_sp NOT IN ($displayed) AND id_km NOT IN (SELECT id_km FROM khuyenmai WHERE giam_km = '0') ORDER BY RAND() LIMIT 5";
    $query = mysqli_query($con, $sql);
    return $query;
}

/********************************************************************************/
//ham lay SAN PHAM theo ID
function get_sanpham($id_sp)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `sanpham` WHERE id_sp = '$id_sp'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//ham lay DIEN THOAI theo ID
function get_dienthoai($id_sp)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `dienthoai` WHERE id_sp = '$id_sp'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//ham lay TAI NGHE theo ID
function get_tainghe($id_sp)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `tainghe` WHERE id_sp = '$id_sp'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//ham lay OP LUNG theo ID
function get_oplung($id_sp)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `oplung` WHERE id_sp = '$id_sp'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

/********************************************************************************/
//ham lay ANH SAN PHAM theo ID
function get_anhsanpham($id_sp)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `anhsanpham` WHERE id_sp = '$id_sp'";
    $query = mysqli_query($con, $sql);
    return $query;
}


/********************************************************************************/
//ham lay BO NHO theo ID
function get_bonho($id_bn)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `bonho` WHERE id_bn = '$id_bn'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//ham lay RAM theo ID
function get_ram($id_ram)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `ram` WHERE id_ram = '$id_ram'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//ham lay THUONG HIEU theo ID
function get_thuonghieu($id_th)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `thuonghieu` WHERE id_th = '$id_th'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//ham lay HE DIEU HANH theo ID
function get_hedieuhanh($id_hdh)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `hedieuhanh` WHERE id_hdh = '$id_hdh'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//ham lay THIET KE theo ID
function get_thietke($id_tk)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `thietke` WHERE id_tk = '$id_tk'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//ham lay CHIP theo ID
function get_chip($id_chip)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `chip` WHERE id_chip = '$id_chip'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//ham lay MAN HINH theo ID
function get_manhinh($id_mh)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `manhinh` WHERE id_mh = '$id_mh'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//ham lay NUOC SAN XUAT theo ID
function get_nuocsanxuat($id_nsx)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `nuocsanxuat` WHERE id_nsx = '$id_nsx'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//ham lay LOAI KET NOI theo ID
function get_loaiketnoi($id_lkn)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `loaiketnoi` WHERE id_lkn = '$id_lkn'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//ham lay CHAT LIEU theo ID
function get_chatlieu($id_cl)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `chatlieu` WHERE id_cl = '$id_cl'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

/********************************************************************************/
//hàm lấy toàn bộ địa chỉ của khách hàng
function get_all_diachi($id_kh)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `diachi` WHERE id_kh = $id_kh";
    $query = mysqli_query($con, $sql);
    return $query;
}

//hàm lấy địa chỉ mặc định
function get_diachi_mac_dinh($id_kh)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `diachi` WHERE id_kh = $id_kh AND mac_dinh = 1";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}

//hàm lấy xã phường
function get_xaphuong($id_xp)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `xaphuong` WHERE id_xp = $id_xp";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}
//hàm lấy quận huyện
function get_quanhuyen($id_qh)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `quanhuyen` WHERE id_qh = $id_qh";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}
//hàm lấy tỉnh thành phố
function get_tinhthanhpho($id_ttp)
{
    include 'function_connect_db.php';
    $sql = "SELECT * FROM `tinhthanhpho` WHERE id_ttp = $id_ttp";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}
