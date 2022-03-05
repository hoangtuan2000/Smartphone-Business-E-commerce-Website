<?php

include('function_connect_db.php');

/*******************************************************************************/
//hien thi database table ốp lưng
$sql_sanpham_oplung = "SELECT * FROM `sanpham` WHERE id_lsp = 'OL' ORDER BY ten_sp ASC";
$query_sanpham_oplung = mysqli_query($con, $sql_sanpham_oplung);

//hien thi database table tainghe
$sql_sanpham_tainghe = "SELECT * FROM `sanpham` WHERE id_lsp = 'TN' ORDER BY ten_sp ASC";
$query_sanpham_tainghe = mysqli_query($con, $sql_sanpham_tainghe);

//hien thi database table dienthoai
$sql_sanpham_dienthoai = "SELECT * FROM `sanpham` WHERE id_lsp = 'DT' ORDER BY ten_sp ASC";
$query_sanpham_dienthoai = mysqli_query($con, $sql_sanpham_dienthoai);

/*******************************************************************************/
//hien thi database table nhân viên
$sql_nhanvien = "SELECT * FROM `nhanvien` ORDER BY id_nv ASC";
$query_nhanvien = mysqli_query($con, $sql_nhanvien);

/*******************************************************************************/
//hien thi database table chuc vu
$sql_chucvu = "SELECT * FROM `chucvu` ORDER BY id_cv ASC";
$query_chucvu = mysqli_query($con, $sql_chucvu);

//hien thi database table bo nho
$sql_bonho = "SELECT * FROM `bonho` ORDER BY id_bn ASC";
$query_bonho = mysqli_query($con, $sql_bonho);

//hien thi database table chip
$sql_chip = "SELECT * FROM `chip` ORDER BY ten_chip ASC";
$query_chip = mysqli_query($con, $sql_chip);

//hien thi database table khuyenmai
$sql_khuyenmai = "SELECT * FROM `khuyenmai` ORDER BY giam_km ASC";
$query_khuyenmai = mysqli_query($con, $sql_khuyenmai);

//hien thi database table he dieu hanh
$sql_hedieuhanh = "SELECT * FROM `hedieuhanh` ORDER BY ten_hdh ASC";
$query_hedieuhanh = mysqli_query($con, $sql_hedieuhanh);


//hien thi database table man hinh
$sql_manhinh = "SELECT * FROM `manhinh` ORDER BY id_mh ASC";
$query_manhinh = mysqli_query($con, $sql_manhinh);

//hien thi database table ram
$sql_ram = "SELECT * FROM `ram` ORDER BY dung_luong_ram ASC";
$query_ram = mysqli_query($con, $sql_ram);

//hien thi database table thiet ke
$sql_thietke = "SELECT * FROM `thietke` ORDER BY kieu_tk ASC";
$query_thietke = mysqli_query($con, $sql_thietke);

//hien thi database table loai ket noi
$sql_loaiketnoi = "SELECT * FROM `loaiketnoi`ORDER BY ten_lkn ASC";
$query_loaiketnoi = mysqli_query($con, $sql_loaiketnoi);

//hien thi database table chat lieu
$sql_chatlieu = "SELECT * FROM `chatlieu`ORDER BY ten_cl ASC";
$query_chatlieu = mysqli_query($con, $sql_chatlieu);

//hien thi database table thuong hieu
$sql_thuonghieu = "SELECT * FROM `thuonghieu`ORDER BY ten_th ASC";
$query_thuonghieu = mysqli_query($con, $sql_thuonghieu);

//hien thi database table don vi van chuyen
$sql_donvivanchuyen = "SELECT * FROM `donvivanchuyen` ORDER BY ten_dvvc ASC";
$query_donvivanchuyen = mysqli_query($con, $sql_donvivanchuyen);

//hien thi database table nuoc san xuat
$sql_nuocsanxuat = "SELECT * FROM `nuocsanxuat` ORDER BY id_nsx ASC";
$query_nuocsanxuat = mysqli_query($con, $sql_nuocsanxuat);

//hien thi database table TRANG THAI SAN PHAM
$sql_trangthaisanpham = "SELECT * FROM `trangthaisanpham` ORDER BY ten_ttsp ASC";
$query_trangthaisanpham = mysqli_query($con, $sql_trangthaisanpham);

//hien thi database table TRANG THAI ĐƠN HÀNG
$sql_trangthaidonhang = "SELECT * FROM `trangthaidonhang` ORDER BY id_ttdh ASC";
$query_trangthaidonhang = mysqli_query($con, $sql_trangthaidonhang);

//hien thi database table TRANG THAI HOAT DONG
$sql_trangthaihoatdong = "SELECT * FROM `trangthaihoatdong` ORDER BY id_tthd ASC";
$query_trangthaihoatdong = mysqli_query($con, $sql_trangthaihoatdong);

/*******************************************************************************/
//hien thi database table xa phuong
$sql_xaphuong = "SELECT * FROM `xaphuong`";
$query_xaphuong = mysqli_query($con, $sql_xaphuong);

//hien thi database table quan huyen
$sql_quanhuyen = "SELECT * FROM `quanhuyen`";
$query_quanhuyen = mysqli_query($con, $sql_quanhuyen);

//hien thi database table tinh thanh pho
$sql_tinhthanhpho = "SELECT * FROM `tinhthanhpho`";
$query_tinhthanhpho = mysqli_query($con, $sql_tinhthanhpho);

/*******************************************************************************/
//hien thi database table tat ca don hang
$sql_donhang = "SELECT * FROM `donhang`";
$query_donhang = mysqli_query($con, $sql_donhang);

//hien thi database table don hang chua xu ly
$sql_donhang_chuaxuly = "SELECT * FROM `donhang` WHERE id_ttdh = '1'";
$query_donhang_chuaxuly = mysqli_query($con, $sql_donhang_chuaxuly);

//hien thi database table don hang da xu ly
$sql_donhang_daxuly = "SELECT * FROM `donhang` WHERE id_ttdh = '2'";
$query_donhang_daxuly = mysqli_query($con, $sql_donhang_daxuly);

//hien thi database table don hang dang van chuyen
$sql_donhang_dangvanchuyen = "SELECT * FROM `donhang` WHERE id_ttdh = '3'";
$query_donhang_dangvanchuyen = mysqli_query($con, $sql_donhang_dangvanchuyen);

//hien thi database table don hang dang giao hàng
$sql_donhang_danggiaohang = "SELECT * FROM `donhang` WHERE id_ttdh = '4'";
$query_donhang_danggiaohang = mysqli_query($con, $sql_donhang_danggiaohang);

//hien thi database table don hang giao hàng thành công
$sql_donhang_giaothanhcong = "SELECT * FROM `donhang` WHERE id_ttdh = '5'";
$query_donhang_giaothanhcong = mysqli_query($con, $sql_donhang_giaothanhcong);




