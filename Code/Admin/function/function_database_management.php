<?php
require('function_connect_db.php');

/*****************************************  Update/Insert Database BONHO   *****************************************/
//update database BONHO
if (isset($_POST['send_update_id_bn_old'])) {
    $update_id_bn_old = $_POST['send_update_id_bn_old']; //lay ID bo nho cu gui tu ajax.js
    $update_id_bn_new = $_POST['send_update_id_bn_new']; //lay ID bo nho moi gui tu ajax.js
    $update_dung_luong_bn_new = $_POST['send_update_dung_luong_bn_new']; //lay dung luong bo nho moi gui tu ajax.js

    $sql_update_bn = "UPDATE `bonho` SET `id_bn`='$update_id_bn_new',`dung_luong_bn`='$update_dung_luong_bn_new' WHERE id_bn = '$update_id_bn_old'";
    $query_update_bn = mysqli_query($con, $sql_update_bn);

    if ($query_update_bn == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//delete database BONHO
if (isset($_POST['send_delete_id_bn'])) {
    $delete_id_bn = $_POST['send_delete_id_bn'];

    $sql_update_bn_dienthoai = "UPDATE `dienthoai` SET `id_bn`='1' WHERE id_bn = '$delete_id_bn'";
    $query_update_bn_dienthoai = mysqli_query($con, $sql_update_bn_dienthoai);

    if ($query_update_bn_dienthoai == true) {
        $sql_delete_bn = "DELETE FROM `bonho` WHERE id_bn = '$delete_id_bn'";
        $query_delete_bn = mysqli_query($con, $sql_delete_bn);

        if ($query_delete_bn == true) {
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//insert database BONHO
if (isset($_POST['send_insert_id_bn'])) {
    $insert_id_bn = $_POST['send_insert_id_bn'];
    $insert_dung_luong_bn = $_POST['send_insert_dung_luong_bn'];

    $sql_insert_bn = "INSERT INTO `bonho`(`id_bn`, `dung_luong_bn`) VALUES ('$insert_id_bn','$insert_dung_luong_bn')";
    $query_insert_bn = mysqli_query($con, $sql_insert_bn);

    if ($query_insert_bn == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

/*****************************************  Update/Insert Database CHIP   *****************************************/
//update database CHIP
if (isset($_POST['send_update_id_chip'])) {
    $update_id_chip = $_POST['send_update_id_chip']; //lay ID bo nho cu gui tu ajax.js
    $update_ten_chip_new = $_POST['send_update_ten_chip_new']; //lay ten chip nho moi gui tu ajax.js

    $sql_update_chip = "UPDATE `chip` SET `ten_chip`='$update_ten_chip_new' WHERE id_chip = '$update_id_chip'";
    $query_update_chip = mysqli_query($con, $sql_update_chip);

    if ($query_update_chip == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//delete database Chip
if (isset($_POST['send_delete_id_chip'])) {
    $delete_id_chip = $_POST['send_delete_id_chip'];

    $sql_update_chip_dienthoai = "UPDATE `dienthoai` SET `id_chip`='1' WHERE id_chip = '$delete_id_chip'";
    $query_update_chip_dienthoai = mysqli_query($con, $sql_update_chip_dienthoai);

    if ($query_update_chip_dienthoai == true) {
        $sql_delete_chip = "DELETE FROM `chip` WHERE id_chip = '$delete_id_chip'";
        $query_delete_chip = mysqli_query($con, $sql_delete_chip);

        if ($query_delete_chip == true) {
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//insert database CHIP
if (isset($_POST['send_insert_ten_chip'])) {
    $insert_ten_chip = $_POST['send_insert_ten_chip'];

    $sql_insert_chip = "INSERT INTO `chip`(`ten_chip`) VALUES ('$insert_ten_chip')";
    $query_insert_chip = mysqli_query($con, $sql_insert_chip);

    if ($query_insert_chip == true) {
        echo "success";
    } else {
        echo "fail";
    }
}




/*****************************************  Update/Insert Database KHUYEN MAI   *****************************************/
//update database KHUYEN MAI
if (isset($_POST['send_update_id_km'])) {
    $update_id_km = $_POST['send_update_id_km']; //lay ID bo nho cu gui tu ajax.js
    $update_giam_km_new = $_POST['send_update_giam_km_new']; //lay ten km nho moi gui tu ajax.js

    $sql_update_km = "UPDATE `khuyenmai` SET `giam_km`='$update_giam_km_new' WHERE id_km = '$update_id_km'";
    $query_update_km = mysqli_query($con, $sql_update_km);

    if ($query_update_km == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//delete database KHUYEN MAI
if (isset($_POST['send_delete_id_km'])) {
    $delete_id_km = $_POST['send_delete_id_km'];

    $sql_update_km_sanpham = "UPDATE `sanpham` SET `id_km`='1' WHERE id_km = '$delete_id_km'";
    $query_update_km_sanpham = mysqli_query($con, $sql_update_km_sanpham);

    if ($query_update_km_sanpham == true) {
        $sql_delete_km = "DELETE FROM `khuyenmai` WHERE id_km = '$delete_id_km'";
        $query_delete_km = mysqli_query($con, $sql_delete_km);
        if ($query_delete_km == true) {
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//insert database KHUYEN MAI
if (isset($_POST['send_insert_giam_km'])) {
    $insert_giam_km = $_POST['send_insert_giam_km'];

    $sql_insert_km = "INSERT INTO `khuyenmai`(`giam_km`) VALUES ('$insert_giam_km')";
    $query_insert_km = mysqli_query($con, $sql_insert_km);

    if ($query_insert_km == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

/*****************************************  Update/Insert Database He-Dieu-Hanh   *****************************************/
//update database He-Dieu-Hanh
if (isset($_POST['send_update_id_hdh_old'])) {
    $update_id_hdh_old = $_POST['send_update_id_hdh_old']; //lay ID he dieu hanh cu gui tu ajax.js
    $update_ten_hdh_new = $_POST['send_update_ten_hdh_new']; //lay ten he dieu hanh moi gui tu ajax.js

    $sql_update_hdh = "UPDATE `hedieuhanh` SET `ten_hdh`='$update_ten_hdh_new' WHERE id_hdh = '$update_id_hdh_old'";
    $query_update_hdh = mysqli_query($con, $sql_update_hdh);

    if ($query_update_hdh == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//delete database He-Dieu-Hanh
if (isset($_POST['send_delete_id_hdh'])) {
    $delete_id_hdh = $_POST['send_delete_id_hdh'];

    $sql_update_hdh_dienthoai = "UPDATE `dienthoai` SET `id_hdh`='1' WHERE id_hdh = '$delete_id_hdh'";
    $query_update_hdh_dienthoai = mysqli_query($con, $sql_update_hdh_dienthoai);

    if ($query_update_hdh_dienthoai == true) {
        $sql_delete_hdh = "DELETE FROM `hedieuhanh` WHERE id_hdh = '$delete_id_hdh'";
        $query_delete_hdh = mysqli_query($con, $sql_delete_hdh);
        if ($query_delete_hdh == true) {
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//insert database He-Dieu-Hanh
if (isset($_POST['send_insert_ten_hdh'])) {
    $insert_ten_hdh = $_POST['send_insert_ten_hdh'];

    $sql_insert_hdh = "INSERT INTO `hedieuhanh`(`ten_hdh`) VALUES ('$insert_ten_hdh')";
    $query_insert_hdh = mysqli_query($con, $sql_insert_hdh);

    if ($query_insert_hdh == true) {
        echo "success";
    } else {
        echo "fail";
    }
}


/*****************************************  Update/Insert Database Man-Hinh   *****************************************/
//update database Man-Hinh
if (isset($_POST['send_update_id_mh_old'])) {
    $update_id_mh_old = $_POST['send_update_id_mh_old']; //lay ID he dieu hanh cu gui tu ajax.js
    $update_kich_thuoc_mh_new = $_POST['send_update_kich_thuoc_mh_new']; //lay ten he dieu hanh moi gui tu ajax.js

    $sql_update_mh = "UPDATE `manhinh` SET `kich_thuoc_mh`='$update_kich_thuoc_mh_new' WHERE id_mh = '$update_id_mh_old'";
    $query_update_mh = mysqli_query($con, $sql_update_mh);

    if ($query_update_mh == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//delete database MAN HINH
if (isset($_POST['send_delete_id_mh'])) {
    $delete_id_mh = $_POST['send_delete_id_mh'];

    $sql_update_mh_dienthoai = "UPDATE `dienthoai` SET `id_mh`='1' WHERE id_mh = '$delete_id_mh'";
    $query_update_mh_dienthoai = mysqli_query($con, $sql_update_mh_dienthoai);

    if ($query_update_mh_dienthoai == true) {
        $sql_delete_mh = "DELETE FROM `manhinh` WHERE id_mh = '$delete_id_mh'";
        $query_delete_mh = mysqli_query($con, $sql_delete_mh);
        if ($query_delete_mh == true) {
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//insert database Man-Hinh
if (isset($_POST['send_insert_kich_thuoc_mh'])) {
    $insert_kich_thuoc_mh = $_POST['send_insert_kich_thuoc_mh'];

    $sql_insert_mh = "INSERT INTO `manhinh`(`kich_thuoc_mh`) VALUES ('$insert_kich_thuoc_mh')";
    $query_insert_mh = mysqli_query($con, $sql_insert_mh);

    if ($query_insert_mh == true) {
        echo "success";
    } else {
        echo "fail";
    }
}


/*****************************************  Update/Insert Database RAM   *****************************************/
//update database RAM
if (isset($_POST['send_update_id_ram_old'])) {
    $update_id_ram_old = $_POST['send_update_id_ram_old']; //lay ID he dieu hanh cu gui tu ajax.js
    $update_dung_luong_ram_new = $_POST['send_update_dung_luong_ram_new']; //lay ten he dieu hanh moi gui tu ajax.js

    $sql_update_ram = "UPDATE `ram` SET `dung_luong_ram`='$update_dung_luong_ram_new' WHERE id_ram = '$update_id_ram_old'";
    $query_update_ram = mysqli_query($con, $sql_update_ram);

    if ($query_update_ram == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//delete database RAM
if (isset($_POST['send_delete_id_ram'])) {
    $delete_id_ram = $_POST['send_delete_id_ram'];

    $sql_update_ram_dienthoai = "UPDATE `dienthoai` SET `id_ram`='1' WHERE id_ram = '$delete_id_ram'";
    $query_update_ram_dienthoai = mysqli_query($con, $sql_update_ram_dienthoai);

    if ($query_update_ram_dienthoai == true) {
        $sql_delete_ram = "DELETE FROM `ram` WHERE id_ram = '$delete_id_ram'";
        $query_delete_ram = mysqli_query($con, $sql_delete_ram);

        if ($query_delete_ram == true) {
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//insert database RAM
if (isset($_POST['send_insert_dung_luong_ram'])) {
    $insert_dung_luong_ram = $_POST['send_insert_dung_luong_ram'];

    $sql_insert_ram = "INSERT INTO `ram`(`dung_luong_ram`) VALUES ('$insert_dung_luong_ram')";
    $query_insert_ram = mysqli_query($con, $sql_insert_ram);

    if ($query_insert_ram == true) {
        echo "success";
    } else {
        echo "fail";
    }
}


/*****************************************  Update/Insert Database Thiet-Ke   *****************************************/
//update database Thiet-Ke
if (isset($_POST['send_update_id_tk_old'])) {
    $update_id_tk_old = $_POST['send_update_id_tk_old']; //lay ID he dieu hanh cu gui tu ajax.js
    $update_kieu_tk_new = $_POST['send_update_kieu_tk_new']; //lay ten he dieu hanh moi gui tu ajax.js

    $sql_update_tk = "UPDATE `thietke` SET `kieu_tk`='$update_kieu_tk_new' WHERE id_tk = '$update_id_tk_old'";
    $query_update_tk = mysqli_query($con, $sql_update_tk);

    if ($query_update_tk == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//delete database THIET KE
if (isset($_POST['send_delete_id_tk'])) {
    $delete_id_tk = $_POST['send_delete_id_tk'];

    $sql_update_tk_dienthoai = "UPDATE `dienthoai` SET `id_tk`='1' WHERE id_tk = '$delete_id_tk'";
    $query_update_tk_dienthoai = mysqli_query($con, $sql_update_tk_dienthoai);

    if ($query_update_tk_dienthoai == true) {
        $sql_delete_tk = "DELETE FROM `thietke` WHERE id_tk = '$delete_id_tk'";
        $query_delete_tk = mysqli_query($con, $sql_delete_tk);

        if ($query_delete_tk == true) {
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//insert database Thiet-Ke
if (isset($_POST['send_insert_kieu_tk'])) {
    $insert_kieu_tk = $_POST['send_insert_kieu_tk'];

    $sql_insert_tk = "INSERT INTO `thietke`(`kieu_tk`) VALUES ('$insert_kieu_tk')";
    $query_insert_tk = mysqli_query($con, $sql_insert_tk);

    if ($query_insert_tk == true) {
        echo "success";
    } else {
        echo "fail";
    }
}



/*****************************************  Update/Insert Database Thương Hiệu   *****************************************/
//update database Thương Hiệu
if (isset($_POST['send_update_id_th_old'])) {
    $update_id_th_old = $_POST['send_update_id_th_old']; //lay ID he dieu hanh cu gui tu ajax.js
    $update_ten_th_new = $_POST['send_update_ten_th_new']; //lay ten he dieu hanh moi gui tu ajax.js

    $sql_update_th = "UPDATE `thuonghieu` SET `ten_th`='$update_ten_th_new' WHERE id_th = '$update_id_th_old'";
    $query_update_th = mysqli_query($con, $sql_update_th);

    if ($query_update_th == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//delete database THUONG HIEU
if (isset($_POST['send_delete_id_th'])) {
    $delete_id_th = $_POST['send_delete_id_th'];

    $sql_update_th_dienthoai = "UPDATE `dienthoai` SET `id_th`='1' WHERE id_th = '$delete_id_th'";
    $query_update_th_dienthoai = mysqli_query($con, $sql_update_th_dienthoai);

    $sql_update_th_tainghe = "UPDATE `tainghe` SET `id_th`='1' WHERE id_th = '$delete_id_th'";
    $query_update_th_tainghe = mysqli_query($con, $sql_update_th_tainghe);

    $sql_update_th_oplung = "UPDATE `oplung` SET `id_th`='1' WHERE id_th = '$delete_id_th'";
    $query_update_th_oplung = mysqli_query($con, $sql_update_th_oplung);

    if ($query_update_th_dienthoai == true) {
        if ($query_update_th_tainghe == true) {
            if ($query_update_th_oplung == true) {
                $sql_delete_th = "DELETE FROM `thuonghieu` WHERE id_th = '$delete_id_th'";
                $query_delete_th = mysqli_query($con, $sql_delete_th);
                if ($query_delete_th == true) {
                    echo "success";
                } else {
                    echo "fail";
                }
            } else {
                echo "fail";
            }
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//insert database Thương Hiệu
if (isset($_POST['send_insert_ten_th'])) {
    $insert_ten_th = $_POST['send_insert_ten_th'];

    $sql_insert_th = "INSERT INTO `thuonghieu`(`ten_th`) VALUES ('$insert_ten_th')";
    $query_insert_th = mysqli_query($con, $sql_insert_th);

    if ($query_insert_th == true) {
        echo "success";
    } else {
        echo "fail";
    }
}



/*****************************************  Update/Insert Database Nuoc-San-Xuat   *****************************************/
//update database Nuoc-San-Xuat
if (isset($_POST['send_update_id_nsx'])) {
    $update_id_nsx = $_POST['send_update_id_nsx']; //lay ID he dieu hanh cu gui tu ajax.js
    $update_ten_nsx_new = $_POST['send_update_ten_nsx_new']; //lay ten he dieu hanh moi gui tu ajax.js

    $sql_update_nsx = "UPDATE `nuocsanxuat` SET `ten_nsx`='$update_ten_nsx_new' WHERE id_nsx = '$update_id_nsx'";
    $query_update_nsx = mysqli_query($con, $sql_update_nsx);

    if ($query_update_nsx == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//delete database NUOC SAN XUAT
if (isset($_POST['send_delete_id_nsx'])) {
    $delete_id_nsx = $_POST['send_delete_id_nsx'];

    $sql_update_nsx_sanpham = "UPDATE `sanpham` SET `id_nsx`='1' WHERE id_nsx = '$delete_id_nsx'";
    $query_update_nsx_sanpham = mysqli_query($con, $sql_update_nsx_sanpham);

    if ($query_update_nsx_sanpham == true) {
        $sql_delete_nsx = "DELETE FROM `nuocsanxuat` WHERE id_nsx = '$delete_id_nsx'";
        $query_delete_nsx = mysqli_query($con, $sql_delete_nsx);

        if ($query_delete_nsx == true) {
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//insert database Nuoc-San-Xuat
if (isset($_POST['send_insert_ten_nsx'])) {
    $insert_ten_nsx = $_POST['send_insert_ten_nsx'];

    $sql_insert_nsx = "INSERT INTO `nuocsanxuat`(`id_nsx`, `ten_nsx`) VALUES ('','$insert_ten_nsx')";
    $query_insert_nsx = mysqli_query($con, $sql_insert_nsx);

    if ($query_insert_nsx == true) {
        echo "success";
    } else {
        echo "fail";
    }
}


/*****************************************  Update/Insert Database Loai-Ket-Noi   *****************************************/
//update database Loai-Ket-Noi
if (isset($_POST['send_update_id_lkn_old'])) {
    $update_id_lkn_old = $_POST['send_update_id_lkn_old']; //lay ID he dieu hanh cu gui tu ajax.js
    $update_ten_lkn_new = $_POST['send_update_ten_lkn_new']; //lay ten he dieu hanh moi gui tu ajax.js

    $sql_update_lkn = "UPDATE `loaiketnoi` SET `ten_lkn`='$update_ten_lkn_new' WHERE id_lkn = '$update_id_lkn_old'";
    $query_update_lkn = mysqli_query($con, $sql_update_lkn);

    if ($query_update_lkn == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//delete database Loai-Ket-Noi
if (isset($_POST['send_delete_id_lkn'])) {
    $delete_id_lkn = $_POST['send_delete_id_lkn'];

    $sql_update_lkn_tainghe = "UPDATE `tainghe` SET `id_lkn`='1' WHERE id_lkn = '$delete_id_lkn'";
    $query_update_lkn_tainghe = mysqli_query($con, $sql_update_lkn_tainghe);

    if ($query_update_lkn_tainghe == true) {
        $sql_delete_lkn = "DELETE FROM `loaiketnoi` WHERE id_lkn = '$delete_id_lkn'";
        $query_delete_lkn = mysqli_query($con, $sql_delete_lkn);

        if ($query_delete_lkn == true) {
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//insert database Loai-Ket-Noi
if (isset($_POST['send_insert_ten_lkn'])) {
    $insert_ten_lkn = $_POST['send_insert_ten_lkn'];

    $sql_insert_lkn = "INSERT INTO `loaiketnoi`(`id_lkn`, `ten_lkn`) VALUES ('','$insert_ten_lkn')";
    $query_insert_lkn = mysqli_query($con, $sql_insert_lkn);

    if ($query_insert_lkn == true) {
        echo "success";
    } else {
        echo "fail";
    }
}



/*****************************************  Update/Insert Database Chat-Lieu   *****************************************/
//update database Chat-Lieu
if (isset($_POST['send_update_id_cl_old'])) {
    $update_id_cl_old = $_POST['send_update_id_cl_old']; //lay ID he dieu hanh cu gui tu ajax.js
    $update_ten_cl_new = $_POST['send_update_ten_cl_new']; //lay ten he dieu hanh moi gui tu ajax.js

    $sql_update_cl = "UPDATE `chatlieu` SET `ten_cl`='$update_ten_cl_new' WHERE id_cl = '$update_id_cl_old'";
    $query_update_cl = mysqli_query($con, $sql_update_cl);

    if ($query_update_cl == true) {
        echo "success";
    } else {
        echo "fail";
    }
}

//delete database Chat-Lieu
if (isset($_POST['send_delete_id_cl'])) {
    $delete_id_cl = $_POST['send_delete_id_cl'];

    $sql_update_cl_oplung = "UPDATE `oplung` SET `id_cl`='1' WHERE id_cl = '$delete_id_cl'";
    $query_update_cl_oplung = mysqli_query($con, $sql_update_cl_oplung);

    if ($query_update_cl_oplung == true) {
        $sql_delete_cl = "DELETE FROM `chatlieu` WHERE id_cl = '$delete_id_cl'";
        $query_delete_cl = mysqli_query($con, $sql_delete_cl);

        if ($query_delete_cl == true) {
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}

//insert database Chat-Lieu
if (isset($_POST['send_insert_ten_cl'])) {
    $insert_ten_cl = $_POST['send_insert_ten_cl'];

    $sql_insert_cl = "INSERT INTO `chatlieu`(`id_cl`, `ten_cl`) VALUES ('','$insert_ten_cl')";
    $query_insert_cl = mysqli_query($con, $sql_insert_cl);

    if ($query_insert_cl == true) {
        echo "success";
    } else {
        echo "fail";
    }
}
