//hiên thị ảnh khi chọn file trong thêm điện thoại
function show_image(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
        var id_lable_preview = $(fileInput).attr("id");
        id_lable_preview = "preview_" + id_lable_preview;

        var reader = new FileReader();
        reader.onload = function (e) { //onload dc kích hoạt khi đọc dữ liệu hoàn thành
            $('#' + id_lable_preview).css("background-color", "white");
            //truy cập vào thuộc tính result để lấy dữ liệu file dưới dạng data URL - base 64
            $("#" + id_lable_preview).html('<img id="image" src="' + e.target.result + '" alt="" class="image-product">');
        }

        // Truyền `File` vào đối tượng `FileReader` và chỉ thị đọc ra dữ liệu dưới dạng `data URL`
        // Sau khi load thành công sẽ thực hiện đoạn code trong `onload` function phía trên
        reader.readAsDataURL(fileInput.files[0]); //trả về URl đại diện cho dữ liệu đọc dc
    }
}

//kiểm tra loại ảnh có đúng định dạng cho phép hay ko
function validate_type_image(input_image, notification) {
    var image_size = $(input_image)[0].files[0];
    image_size = image_size.size;

    var allow_type_image = ["jpg", "jpeg", "png"];
    //lấy đuôi file image
    var image = $(input_image).val();
    var find_type = image.indexOf(".");
    type_image = image.substring(find_type + 1).toLowerCase();
    //nếu loại image ko đúng thì báo lỗi hoặc kích thước image lớn hơn 2MB thì lỗi
    //inArray trả về -1 nếu ko tìm thấy or vị trí đầu tiên khi tìm thấy
    if (jQuery.inArray(type_image, allow_type_image) == -1 || image_size > 2000000) {
        $('#notification-content-fail').html('Ảnh ' + notification + ' không đúng định dạng <br/> Hoặc kích thước lớn hơn 2MB');
        $('#modal-notification-fail').modal('show');
    }
}


$(function () {

    //kiểm tra định dạng file image có đúng hay ko
    $('#image_avatar').change(function () {
        validate_type_image(this, "Avatar");
    })
    //kiểm tra định dạng file image có đúng hay ko
    $('#image_1').change(function () {
        validate_type_image(this, "1");
    })
    //kiểm tra định dạng file image có đúng hay ko
    $('#image_2').change(function () {
        validate_type_image(this, "2");
    })
    //kiểm tra định dạng file image có đúng hay ko
    $('#image_3').change(function () {
        validate_type_image(this, "3");
    })
})