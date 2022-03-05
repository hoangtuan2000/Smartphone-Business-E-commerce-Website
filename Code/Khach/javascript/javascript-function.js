
//hàm thêm dấu phẩy trong số (giá, số lượng)
function format_number(so) {
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

//hàm xóa ký tự cuối cùng khi nhập quá số lượng cho phép
function delete_char_last(string, last_num) {
    //xóa ký tự cuối (-1 là ký tự cuối)
    //chuổi bắt đầu từ 0
    string = string.slice(0, last_num);
    return string;
}

//hàm kiếm tra xem nhập (đang nhập keyup) có quá ký tự cho phép ko
function resert_value(input, allow_length, notification) {
    var string = $(input).val();
    if (string.length > allow_length) {
        $('#notification-content-fail').html(notification);
        $('#modal-notification-fail').modal('show');
        $('#modal-notification-fail').click(function () {
            string = delete_char_last(string, allow_length);
            //gán input_insert (input database)  thành số lượng ký tự cho phép
            $(input).val(string);
        })
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
    } else {
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

//hàm kiểm tra có phải chữ ko
function check_string_modal(input_string, input_notification, notification, btn_disabled) {
    var string = $(input_string).val();
    var regex_string = /[0-9]/gm;
    if (regex_string.test(string) == true) {
        $(input_notification).html(notification);
        $(input_string).removeClass('is-valid');
        $(input_string).addClass('is-invalid');
        $(btn_disabled).attr('disabled', 'true');
        return false;

    } else if (!isNaN(string) && string != "") {
        $(input_notification).html(notification);
        $(input_string).removeClass('is-valid');
        $(input_string).addClass('is-invalid');
        $(btn_disabled).attr('disabled', 'true');
        return false;
        
    } else {
        return true;
    }
}

//kiểm tra xem có chọn select chưa
function check_select(select, btn_disabled) {
    var value = $(select).val();
    if (value != "") {
        $(select).removeClass('is-invalid');
        $(select).addClass('is-valid');
        $(btn_disabled).removeAttr('disabled');
        return true;
    }
    else {
        $(select).removeClass('is-valid');
        $(select).addClass('is-invalid');
        $(btn_disabled).attr('disabled', 'true');
        return false;
    }
}

//hàm kiểm tra nhập lại mật khẩu có đúng ko
function check_password_again(password, password_again, input_notification, notification, btn_disabled) {
    var pass = $(password).val();
    var pass_again = $(password_again).val();
    if (pass != pass_again) {
        $(input_notification).html(notification);
        $(password_again).removeClass('is-valid');
        $(password_again).addClass('is-invalid');
        $(btn_disabled).attr('disabled', 'true');
        return false;
    }
    else {
        $(input_notification).html("");
        $(password_again).removeClass('is-invalid');
        $(password_again).addClass('is-valid');
        $(btn_disabled).removeAttr('disabled');
        return true;
    }
}