<?php
include 'function_connect_db.php';
/**************************************************************************************************/
//show DIEN THOAI khuyen mai gioi han
$sql_rand_dienthoai_khuyenmai = "SELECT * FROM `sanpham` WHERE id_lsp = 'DT' AND id_km NOT IN (SELECT id_km FROM khuyenmai WHERE giam_km = '0') AND id_ttsp != 'NKD' ORDER BY RAND() LIMIT 5";
$query_rand_dienthoai_khuyenmai = mysqli_query($con, $sql_rand_dienthoai_khuyenmai);

//show TAI NGHE khuyen mai gioi han
$sql_rand_tainghe_khuyenmai = "SELECT * FROM `sanpham` WHERE id_lsp = 'TN' AND id_km NOT IN (SELECT id_km FROM khuyenmai WHERE giam_km = '0') AND id_ttsp != 'NKD' ORDER BY RAND() LIMIT 5";
$query_rand_tainghe_khuyenmai = mysqli_query($con, $sql_rand_tainghe_khuyenmai);

//show OP LUNG khuyen mai gioi han
$sql_rand_oplung_khuyenmai = "SELECT * FROM `sanpham` WHERE id_lsp = 'OL' AND id_km NOT IN (SELECT id_km FROM khuyenmai WHERE giam_km = '0') AND id_ttsp != 'NKD' ORDER BY RAND() LIMIT 5";
$query_rand_oplung_khuyenmai = mysqli_query($con, $sql_rand_oplung_khuyenmai);

/***************************************************************************************************/
//show SAN PHAM khuyến mãi
$sql_sanpham_khuyenmai = "SELECT * FROM `sanpham` WHERE id_km NOT IN (SELECT id_km FROM khuyenmai WHERE giam_km = '0') AND id_ttsp != 'NKD'";
$query_sanpham_khuyenmai = mysqli_query($con, $sql_sanpham_khuyenmai);

//show DIEN THOAI khuyến mãi
$sql_dienthoai_khuyenmai = "SELECT * FROM `sanpham` WHERE id_lsp = 'DT' AND id_km NOT IN (SELECT id_km FROM khuyenmai WHERE giam_km = '0') AND id_ttsp != 'NKD'";
$query_dienthoai_khuyenmai = mysqli_query($con, $sql_dienthoai_khuyenmai);

//show TAI NGHE khuyến mãi
$sql_tainghe_khuyenmai = "SELECT * FROM `sanpham` WHERE id_lsp = 'TN' AND id_km NOT IN (SELECT id_km FROM khuyenmai WHERE giam_km = '0') AND id_ttsp != 'NKD'";
$query_tainghe_khuyenmai = mysqli_query($con, $sql_tainghe_khuyenmai);

//show OP LUNG khuyến mãi
$sql_oplung_khuyenmai = "SELECT * FROM `sanpham` WHERE id_lsp = 'OL' AND id_km NOT IN (SELECT id_km FROM khuyenmai WHERE giam_km = '0') AND id_ttsp != 'NKD'";
$query_oplung_khuyenmai = mysqli_query($con, $sql_oplung_khuyenmai);

/***************************************************************************************************/
//show DIEN THOAI
$sql_rand_dienthoai = "SELECT * FROM `sanpham` WHERE id_lsp = 'DT' AND id_ttsp != 'NKD' ORDER BY RAND() LIMIT 20";
$query_rand_dienthoai = mysqli_query($con, $sql_rand_dienthoai);

//show TAI NGHE
$sql_rand_tainghe = "SELECT * FROM `sanpham` WHERE id_lsp = 'TN' AND id_ttsp != 'NKD' ORDER BY RAND() LIMIT 20";
$query_rand_tainghe = mysqli_query($con, $sql_rand_tainghe);

//show OP LUNG
$sql_rand_oplung = "SELECT * FROM `sanpham` WHERE id_lsp = 'OL' AND id_ttsp != 'NKD' ORDER BY RAND() LIMIT 20";
$query_rand_oplung = mysqli_query($con, $sql_rand_oplung);

/***************************************************************************************************/
//show DIEN THOAI
$sql_all_dienthoai = "SELECT * FROM `sanpham` WHERE id_lsp = 'DT'";
$query_all_dienthoai = mysqli_query($con, $sql_all_dienthoai);

//show TAI NGHE
$sql_all_tainghe = "SELECT * FROM `sanpham` WHERE id_lsp = 'TN'";
$query_all_tainghe = mysqli_query($con, $sql_all_tainghe);

//show OP LUNG
$sql_all_oplung = "SELECT * FROM `sanpham` WHERE id_lsp = 'OL'";
$query_all_oplung = mysqli_query($con, $sql_all_oplung);


/***************************************************************************************************/
//hien thi database table xa phuong
$sql_xaphuong = "SELECT * FROM `xaphuong`";
$query_xaphuong = mysqli_query($con, $sql_xaphuong);

//hien thi database table quan huyen
$sql_quanhuyen = "SELECT * FROM `quanhuyen`";
$query_quanhuyen = mysqli_query($con, $sql_quanhuyen);

//hien thi database table tinh thanh pho
$sql_tinhthanhpho = "SELECT * FROM `tinhthanhpho`";
$query_tinhthanhpho = mysqli_query($con, $sql_tinhthanhpho);

/***************************************************************************************************/
//hien thi database table thương hiệu
$sql_thuonghieu = "SELECT * FROM `thuonghieu`";
$query_thuonghieu = mysqli_query($con, $sql_thuonghieu);

//hien thi database table hệ điều hành
$sql_hedieuhanh = "SELECT * FROM `hedieuhanh`";
$query_hedieuhanh = mysqli_query($con, $sql_hedieuhanh);

//hien thi database table ram
$sql_ram = "SELECT * FROM `ram`";
$query_ram = mysqli_query($con, $sql_ram);

//hien thi database table bonho
$sql_bonho = "SELECT * FROM `bonho`";
$query_bonho = mysqli_query($con, $sql_bonho);

//hien thi database table thietke
$sql_thietke = "SELECT * FROM `thietke`";
$query_thietke = mysqli_query($con, $sql_thietke);

//hien thi database table manhinh
$sql_manhinh = "SELECT * FROM `manhinh`";
$query_manhinh = mysqli_query($con, $sql_manhinh);

//hien thi database table loaiketnoi
$sql_loaiketnoi = "SELECT * FROM `loaiketnoi`";
$query_loaiketnoi = mysqli_query($con, $sql_loaiketnoi);

//hien thi database table chatlieu
$sql_chatlieu = "SELECT * FROM `chatlieu`";
$query_chatlieu = mysqli_query($con, $sql_chatlieu);
