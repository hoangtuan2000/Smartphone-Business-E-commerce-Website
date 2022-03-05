<?php


//update ảnh avatar
function update_image_avatar($name_image_avatar_new, $name_image_avatar_old, $id_sp)
{
    include 'function_connect_db.php';


    //nếu có chọn Avatar ảnh mới thì xóa ảnh cũ đi và thêm vào ảnh mới
    if ($name_image_avatar_new != "") {
        //thêm ảnh mới
        $file_image_avatar = upload_image_avatar();

        //xóa ảnh củ        
        if (unlink("../" . $name_image_avatar_old) == false) {
            echo "fail";
            die();
        }

        //đường dẫn lưu ảnh
        $path_image_avatar = "../uploads/" . $file_image_avatar['name'];

        //cập nhật ảnh vào csdl dienthoai
        $sql_update_avatar_dienthoai = "UPDATE `sanpham` SET `anh_sp`='$path_image_avatar' WHERE id_sp='$id_sp'";
        $query_update_avatar_dienthoai = mysqli_query($con, $sql_update_avatar_dienthoai);
        if ($query_update_avatar_dienthoai == false) {
            echo "fail";
            die();
        }
    }
}


//update ảnh 1
function update_image_1($name_image_1_new, $name_image_1_old, $id_sp)
{
    include 'function_connect_db.php';

    //nếu có chọn ảnh 1 ảnh mới thì xóa ảnh cũ đi và thêm vào ảnh mới
    if ($name_image_1_new != "") {
        //thêm ảnh mới
        $file_image_1 = upload_image_1();

        //xóa ảnh củ        
        if (unlink("../" . $name_image_1_old) == false) {
            echo "fail";
            die();
        }

        //đường dẫn lưu ảnh
        $path_image_1 = "../uploads/" . $file_image_1['name'];

        //lấy id_asp của bức ảnh trong database anhsanpham
        $sql_id_anhsanpham = "SELECT id_asp FROM `anhsanpham` WHERE id_sp = '$id_sp' AND anh_asp = '$name_image_1_old'";
        $query_id_anhsanpham = mysqli_query($con, $sql_id_anhsanpham);
        $result_id_anhsanpham = mysqli_fetch_array($query_id_anhsanpham);
        $id_asp = $result_id_anhsanpham['id_asp'];

        //cập nhật ảnh vào csdl dienthoai
        $sql_update_1_anhsanpham = "UPDATE `anhsanpham` SET `anh_asp`='$path_image_1' WHERE id_asp ='$id_asp'";
        $query_update_1_anhsanpham = mysqli_query($con, $sql_update_1_anhsanpham);
        if ($query_update_1_anhsanpham == false) {
            echo "fail";
            die();
        }
    }
}

//update ảnh 2
function update_image_2($name_image_2_new, $name_image_2_old, $id_sp)
{
    include 'function_connect_db.php';

    //nếu có chọn ảnh 2 ảnh mới thì xóa ảnh cũ đi và thêm vào ảnh mới
    if ($name_image_2_new != "") {
        //thêm ảnh mới
        $file_image_2 = upload_image_2();

        //xóa ảnh củ        
        if (unlink("../" . $name_image_2_old) == false) {
            echo "fail";
            die();
        }

        //đường dẫn lưu ảnh
        $path_image_2 = "../uploads/" . $file_image_2['name'];

        //lấy id_asp của bức ảnh trong database anhsanpham
        $sql_id_anhsanpham = "SELECT id_asp FROM `anhsanpham` WHERE id_sp = '$id_sp' AND anh_asp = '$name_image_2_old'";
        $query_id_anhsanpham = mysqli_query($con, $sql_id_anhsanpham);
        $result_id_anhsanpham = mysqli_fetch_array($query_id_anhsanpham);
        $id_asp = $result_id_anhsanpham['id_asp'];

        //cập nhật ảnh vào csdl dienthoai
        $sql_update_2_anhsanpham = "UPDATE `anhsanpham` SET `anh_asp`='$path_image_2' WHERE id_asp ='$id_asp'";
        $query_update_2_anhsanpham = mysqli_query($con, $sql_update_2_anhsanpham);
        if ($query_update_2_anhsanpham == false) {
            echo "fail";
            die();
        }
    }
}

//update ảnh 3
function update_image_3($name_image_3_new, $name_image_3_old, $id_sp)
{
    include 'function_connect_db.php';

    //nếu có chọn ảnh 3 ảnh mới thì xóa ảnh cũ đi và thêm vào ảnh mới
    if ($name_image_3_new != "") {
        //thêm ảnh mới
        $file_image_3 = upload_image_3();

        //xóa ảnh củ        
        if (unlink("../" . $name_image_3_old) == false) {
            echo "fail";
            die();
        }

        //đường dẫn lưu ảnh
        $path_image_3 = "../uploads/" . $file_image_3['name'];

        //lấy id_asp của bức ảnh trong database anhsanpham
        $sql_id_anhsanpham = "SELECT id_asp FROM `anhsanpham` WHERE id_sp = '$id_sp' AND anh_asp = '$name_image_3_old'";
        $query_id_anhsanpham = mysqli_query($con, $sql_id_anhsanpham);
        $result_id_anhsanpham = mysqli_fetch_array($query_id_anhsanpham);
        $id_asp = $result_id_anhsanpham['id_asp'];

        //cập nhật ảnh vào csdl dienthoai
        $sql_update_3_anhsanpham = "UPDATE `anhsanpham` SET `anh_asp`='$path_image_3' WHERE id_asp ='$id_asp'";
        $query_update_3_anhsanpham = mysqli_query($con, $sql_update_3_anhsanpham);
        if ($query_update_3_anhsanpham == false) {
            echo "fail";
            die();
        }
    }
}
