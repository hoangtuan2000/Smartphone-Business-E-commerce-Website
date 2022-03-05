
//hàm xóa ký tự đầu tiên 
function delete_char_fist(string) {
    //xóa ký tự đầu
    //chuổi bắt đầu từ 0
    string = string.substring(1);
    return string;
}

//hàm xóa dấu phẩy trong số (giá, số lượng)
function delete_dots(so) {
    //xóa dấu phẩy
    var so_xoa_dau = "";
    for (var i = 0; i < so.length; i++) {
        if (so[i] != ",") {
            so_xoa_dau += so[i];
        }
    }
    return so_xoa_dau;
}

//hàm thêm dấu phẩy trong số (giá, số lượng)
function insert_dots(so) {
    //reverse làm việc trên mảng nên phải cắt số thành từng mảng
    var dao_nguoc_so = so.split("").reverse().join("");

    //chuyen chuoi về mảng để tạo biến chạy i
    dao_nguoc_so = dao_nguoc_so.split("");
    var dodai = dao_nguoc_so.length;

    //biến kết quả
    var ketqua_so = '';

    //vòng lặp thêm dấu ","
    for (var i = 0; i < dodai; i++) {
        if (i % 3 == 0 && i != 0) {
            ketqua_so += ",";
        }
        ketqua_so += dao_nguoc_so[i];
    }
    //sau khi thêm dấu thì đảo ngược chuỗi về ban đầu
    ketqua_so = ketqua_so.split("").reverse().join("");

    return ketqua_so;
}


//hàm kiểm tra và định dạng số
function check_and_format_number(input_show, input_show_help, input_update_csdl, allow_number, notification_not_number, notification_not_allow_number, btn_disabled) {
    var errors = "";

    var so = $(input_show).val();

    //nếu số đầu tiên là số "0" thì xóa bỏ
    if (so[0] == 0) {
        so = delete_char_fist(so);
    }

    //nếu dữ liệu khi nhập có dấu xóa bỏ để thêm dấu lại cho chính xác
    so_xoa_dau = delete_dots(so);

    //kiểm tra xem giá đẫ xóa dấu có phải là số hay không
    if (isNaN(so_xoa_dau)) {
        $(input_show_help).html(notification_not_number);
        $(input_show).removeClass('is-valid');
        $(input_show).addClass('is-invalid');
        $(btn_disabled).attr('disabled', 'true');
        errors = "fail";
    }
    else if (so_xoa_dau.length > allow_number) {
        $(input_show_help).html(notification_not_allow_number);
        $(input_show).removeClass('is-valid');
        $(input_show).addClass('is-invalid');
        $(btn_disabled).attr('disabled', 'true');
        errors = "fail";
    }
    else if (so == "") {
        $(input_show_help).html("");
        $(input_show).removeClass('is-valid');
        $(input_show).removeClass('is-invalid');
        $(btn_disabled).removeAttr('disabled');
        errors = "fail";
    }
    else {
        $(input_show_help).html("");
        $(input_show).removeClass('is-invalid');
        $(input_show).addClass('is-valid');
        $(btn_disabled).removeAttr('disabled');
    }

    //thêm dấu phẩy vào giá
    so_them_dau = insert_dots(so_xoa_dau);

    //trả kết quả về hiển thị
    $(input_show).val(so_them_dau);

    //gán kết quả cho input_insert để thêm vào csdl (thêm vào csdl thì phải xóa bỏ dấu phẩy)
    so_xoa_dau = delete_dots(so_them_dau);
    $(input_update_csdl).val(so_xoa_dau);

    if (errors == "") {
        return true;
    } else {
        return false;
    }
}


//hàm kiểm tra khi nhập
function check_max_min(input_string, max, min, input_notification, notification, btn_disabled) {
    var string = $(input_string).val();
    if (string.length > max || string.length < min) {
        $(input_notification).html(notification);
        $(input_string).removeClass('is-valid');
        $(input_string).addClass('is-invalid');
        $(btn_disabled).attr('disabled', 'true');
        return false;
    }
    else {
        $(input_notification).html("");
        $(input_string).removeClass('is-invalid');
        $(input_string).addClass('is-valid');
        $(btn_disabled).removeAttr('disabled');
        return true;
    }
}

//hàm kiểm tra số điện thoại
function check_sdt(input_sdt, input_notification, btn_disabled) {
    var sdt = $(input_sdt).val();

    if (isNaN(sdt)) {
        
        $(input_notification).html("Số điện thoại phải là số");
        $(input_sdt).removeClass('is-valid');
        $(input_sdt).addClass('is-invalid');
        $(btn_disabled).attr('disabled', 'true');
        return false;
    }
    else if (sdt[0] != 0) {
        
        $(input_notification).html("Số điện thoại bắt đầu bằng số 0");
        $(input_sdt).removeClass('is-valid');
        $(input_sdt).addClass('is-invalid');
        $(btn_disabled).attr('disabled', 'true');
        return false;
    }else{
        return true;
    } 
}

//hàm kiểm tra email
function check_email(input_email, input_notification, notification, btn_disabled) {
    var email = $(input_email).val();

    var regex_email = /^[A-Za-z0-9]{2,}@gmail.com$/gm
    if (regex_email.test(email) == false) {
        
        $(input_notification).html(notification);
        $(input_email).removeClass('is-valid');
        $(input_email).addClass('is-invalid');
        $(btn_disabled).attr('disabled', 'true');
        return false;
    } else {
        $(input_notification).html("");
        $(input_email).removeClass('is-invalid');
        $(input_email).addClass('is-valid');
        $(btn_disabled).removeAttr('disabled');
        return true
    }
}

//kiểm tra độ dài khi đã submit
function check_length_max_min(string, max, min, notification) {
    if (string.length < min || string.length > max) {
        //in ra câu thông báo LỖI trong modal-notification
        $('#notification-content-fail').html(notification);

        //hiển thị thông báo LỖI khi chưa nhập dữ liệu
        $('#modal-notification-fail').modal('show');
        return false;
    } else {
        return true;
    }
}
