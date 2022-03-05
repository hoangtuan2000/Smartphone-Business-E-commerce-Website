<?php

//hàm upload ảnh avatar
function upload_image_avatar()
{
    //********************************* copy hình ảnh vào thư mục
    //tạo biến lỗi nếu lúc insert smartphone có lỗi thì thông báo
    $errors = "";

    $image_avatar = $_FILES['image_avatar'];

    //tách tên file image thành 2 phần dựa vào dấu "."
    $extension_image_avatar = explode(".", $image_avatar['name']);

    //lấy đuôi file image sau khi tách phía trên
    $file_extension_image_avatar = end($extension_image_avatar);

    //chuyển đuổi file image thành chữ thường để không bị lỗi nếu đuôi file là chữ hoa
    $file_extension_image_avatar = strtolower($file_extension_image_avatar);

    //đường dẫn lưu file
    $path = "../../uploads/";

    //tạo thư mục để chứa ảnh nếu chưa có thư mục đó
    if (!is_dir($path)) { //return TRUE nếu thư mục tồn tại, FALSE nếu không
        mkdir($path, 0777, true); //mkdir(duong dan, quyen ghi file trên thư mục, quyền tạo thư mục con trong thư mục đó)
        //1 = thực thi quyền // 2 = ghi quyền //4 = đọc quyền
    }

    //gọi hàm kiểm tra image có hợp lệ hay không trước khi upload
    $file_image_avatar = validate_image($image_avatar, $path);

    // xem file image sau khi kiểm tra có hợp lệ hay ko nếu ko thì dừng chương trình
    if ($file_image_avatar == false) {
        $errors .= "Ảnh Avatar không đúng định dạng <br/> hoặc quá kích thước cho phép<br/>";
        echo $errors;
        return false;
    } else {
        move_uploaded_file($file_image_avatar['tmp_name'], $path . $file_image_avatar['name']);
        return $file_image_avatar;
    }
}


function upload_image_1()
{
    //********************************* copy hình ảnh vào thư mục
    //tạo biến lỗi nếu lúc insert smartphone có lỗi thì thông báo
    $errors = "";

    $image_1 = $_FILES['image_1'];

    //tách tên file image thành 2 phần dựa vào dấu "."
    $extension_image_1 = explode(".", $image_1['name']);

    //lấy đuôi file image sau khi tách phía trên
    $file_extension_image_1 = end($extension_image_1);

    //chuyển đuổi file image thành chữ thường để không bị lỗi nếu đuôi file là chữ hoa
    $file_extension_image_1 = strtolower($file_extension_image_1);

    //đường dẫn lưu file
    $path = "../../uploads/";

    //tạo thư mục để chứa ảnh nếu chưa có thư mục đó
    if (!is_dir($path)) {
        mkdir($path, 0777, true); //mkdir(duong dan, quyen ghi file trên thư mục, quyền tạo thư mục con trong thư mục đó)
    }

    //gọi hàm kiểm tra image có hợp lệ hay không trước khi upload
    $file_image_1 = validate_image($image_1, $path);

    // xem file image sau khi kiểm tra có hợp lệ hay ko nếu ko thì dừng chương trình
    if ($file_image_1 == false) {
        $errors .= "Ảnh 1 không đúng định dạng <br/> hoặc quá kích thước cho phép<br/>";
        echo $errors;
        return false;
        die();
    } else {
        move_uploaded_file($file_image_1['tmp_name'], $path . $file_image_1['name']);
        return $file_image_1;
    }
}


function upload_image_2()
{
    //********************************* copy hình ảnh vào thư mục
    //tạo biến lỗi nếu lúc insert smartphone có lỗi thì thông báo
    $errors = "";

    $image_2 = $_FILES['image_2'];

    //tách tên file image thành 2 phần dựa vào dấu "."
    $extension_image_2 = explode(".", $image_2['name']);

    //lấy đuôi file image sau khi tách phía trên
    $file_extension_image_2 = end($extension_image_2);

    //chuyển đuổi file image thành chữ thường để không bị lỗi nếu đuôi file là chữ hoa
    $file_extension_image_2 = strtolower($file_extension_image_2);

    //đường dẫn lưu file
    $path = "../../uploads/";

    //tạo thư mục để chứa ảnh nếu chưa có thư mục đó
    if (!is_dir($path)) {
        mkdir($path, 0777, true); //mkdir(duong dan, quyen ghi file trên thư mục, quyền tạo thư mục con trong thư mục đó)
    }

    //gọi hàm kiểm tra image có hợp lệ hay không trước khi upload
    $file_image_2 = validate_image($image_2, $path);

    // xem file image sau khi kiểm tra có hợp lệ hay ko nếu ko thì dừng chương trình
    if ($file_image_2 == false) {
        $errors .= "Ảnh 2 không đúng định dạng <br/> hoặc quá kích thước cho phép<br/>";
        echo $errors;
        return false;
        die();
    } else {
        move_uploaded_file($file_image_2['tmp_name'], $path . $file_image_2['name']);
        return $file_image_2;
    }
}


function upload_image_3()
{
    //********************************* copy hình ảnh vào thư mục
    //tạo biến lỗi nếu lúc insert smartphone có lỗi thì thông báo
    $errors = "";

    $image_3 = $_FILES['image_3'];

    //tách tên file image thành 2 phần dựa vào dấu "."
    $extension_image_3 = explode(".", $image_3['name']);

    //lấy đuôi file image sau khi tách phía trên
    $file_extension_image_3 = end($extension_image_3);

    //chuyển đuổi file image thành chữ thường để không bị lỗi nếu đuôi file là chữ hoa
    $file_extension_image_3 = strtolower($file_extension_image_3);

    //đường dẫn lưu file
    $path = "../../uploads/";

    //tạo thư mục để chứa ảnh nếu chưa có thư mục đó
    if (!is_dir($path)) {
        mkdir($path, 0777, true); //mkdir(duong dan, quyen ghi file trên thư mục, quyền tạo thư mục con trong thư mục đó)
    }

    //gọi hàm kiểm tra image có hợp lệ hay không trước khi upload
    $file_image_3 = validate_image($image_3, $path);

    // xem file image sau khi kiểm tra có hợp lệ hay ko nếu ko thì dừng chương trình
    if ($file_image_3 == false) {
        $errors .= "Ảnh 1 không đúng định dạng <br/> hoặc quá kích thước cho phép<br/>";
        echo $errors;
        return false;
        die();
    } else {
        move_uploaded_file($file_image_3['tmp_name'], $path . $file_image_3['name']);
        return $file_image_3;
    }
}

//Check file hợp lệ
function validate_image($image, $path)
{
    //Kiểm tra xem có vượt quá dung lượng cho phép không?
    if ($image['size'] > 2 * 1024 * 1024) { //max upload is 2 Mb = 2 * 1024 kb * 1024 bite
        return false;
    }
    //Kiểm tra xem kiểu file có hợp lệ không?
    $validTypes = array("jpg", "jpeg", "png");
    $image_type = substr($image['name'], strrpos($image['name'], ".") + 1); //strpos return false or vị trí tìm thấy bắt đầu từ 0

    //chuyển đuôi file vừa cắt thành chữ thường
    $image_type = strtolower($image_type);

    if (!in_array($image_type, $validTypes)) { // return true false
        return false;
    }

    //Check xem file đã tồn tại chưa? Nếu tồn tại thì sửa tên
    $num = 1;
    $image_name = substr($image['name'], 0, strrpos($image['name'], "."));
    while (file_exists($path . $image_name . '.' . $image_type)) { //return true => tồn tại / return false => ko tồn tại
        $image_name = $image_name . "(" . $num . ")";
        $num++;
    }

    //sau khi đổi tên nếu trùng thì gán lại tên cho image
    $image['name'] = $image_name . '.' . $image_type;

    return $image;
}
