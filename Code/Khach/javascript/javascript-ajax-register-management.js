$.getScript("javascript/javascript-function.js", function () { })

$(function () {
    $('#register_ten').on('keyup', function () {
        if (check_string_modal(this, '#ten_help', "Họ tên không được nhập số", "#btn-register") == true) {
            check_max_min(this, 30, 5, '#ten_help', "Tên từ 5-30 ký tự", "#btn-register");
        }
    })

    $('#register_email').on('keyup', function () {
        if (check_email(this, '#email_help', "Email không đúng định dạng (VD: ...@gmail.com)", "#btn-register") == true) {
            if (check_max_min(this, 50, 11, '#email_help', "Email dưới 50 ký tự", "#btn-register") == true) {
                var check_email_exist = $(this).val();
                $.post("function/function_register_management.php", { send_check_email_exist: check_email_exist }, function (result_email) {
                    if (result_email == "fail") {
                        $('#register_email').removeClass('is-valid');
                        $('#register_email').addClass('is-invalid');
                        $('#btn-register').attr('disabled', 'true');
                        $('#email_help').text("Email đã đăng ký rồi, vui lòng nhập email khác");
                    } else {
                        $('#register_email').removeClass('is-invalid');
                        $('#register_email').addClass('is-valid');
                        $('#btn-register').removeAttr('disabled');
                        $('#email_help').html("");
                    }
                })
            }
        }
    })

    $('#register_mat_khau').on('keyup', function () {
        $('#register_nhap_lai_mat_khau').val('');
        $('#register_nhap_lai_mat_khau').removeClass('is-valid');
        $('#register_nhap_lai_mat_khau').removeClass('is-invalid');
        check_max_min(this, 20, 8, '#mat_khau_help', "Mật khẩu từ 8-20 ký tự", "#btn-register");
    })

    $('#register_nhap_lai_mat_khau').on('keyup', function () {
        check_password_again("#register_mat_khau", this, '#nhap_lai_mat_khau_help', "Nhập lại mật khẩu không chính xác", "#btn-register");
    })

    $('#register_sdt').on('keyup', function () {
        if (check_sdt(this, '#sdt_help', '#btn-register') == true) {
            check_max_min(this, 10, 10, '#sdt_help', 'Số điện thoại gồm 10 chữ số', '#btn-register');
        }
    })

    $('#register_dia_chi').on('keyup', function () {
        check_max_min(this, 100, 1, '#dia_chi_help', "địa chỉ từ 1-100 ký tự", "#btn-register");
    })

    $('#sl_tinhthanhpho').on('change', function () {
        check_select(this, "#btn-register");
    })

    $('#sl_quanhuyen').on('change', function () {
        check_select(this, "#btn-register");
    })

    $('#sl_xaphuong').on('change', function () {
        check_select(this, "#btn-register");
    })

    $('#btn-register').click(function (e) {
        var ten = $('#register_ten').val();
        var email = $('#register_email').val();
        var mat_khau = $('#register_mat_khau').val();
        var nhap_lai_mat_khau = $('#register_nhap_lai_mat_khau').val();
        var sdt = $('#register_sdt').val();
        var dia_chi = $('#register_dia_chi').val();
        var tinhthanhpho = $('#sl_tinhthanhpho').val();
        var quanhuyen = $('#sl_quanhuyen').val();
        var xaphuong = $('#sl_xaphuong').val();
        var chk_agree = $('#chk_agree:checked').val();

        if (ten == "" || email == "" || mat_khau == "" || nhap_lai_mat_khau == "" || sdt == "" || dia_chi == "" || tinhthanhpho == "" || quanhuyen == "" || xaphuong == "") {
            e.preventDefault();
            $('#notification-content-fail').html("Bạn Chưa Nhập Đủ Dữ Liệu");
            $('#modal-notification-fail').modal('show');

        } else if (chk_agree == undefined) {
            e.preventDefault();
            $('#notification-content-fail').html("Bạn Chưa Đồng Ý Với Chính Sách Và Điều Khoản Của Chúng Tôi");
            $('#modal-notification-fail').modal('show');

        } else if (check_string_modal('#register_ten', '#ten_help', "Họ tên không được nhập số", "#btn-register") == false) {
            e.preventDefault();
            $('#notification-content-fail').html("Họ tên không được nhập số");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#register_ten', 30, 5, '#ten_help', "Tên từ 5-30 ký tự", "#btn-register") == false) {
            e.preventDefault();
            $('#notification-content-fail').html("Tên từ 5-30 ký tự");
            $('#modal-notification-fail').modal('show');

        } else if (check_email('#register_email', '#email_help', "Email không đúng định dạng (VD: ...@gmail.com)", "#btn-register") == false) {
            e.preventDefault();
            $('#notification-content-fail').html("Email không đúng định dạng hoặc đẫ tồn tại");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#register_email', 50, 11, '#email_help', "Email dưới 50 ký tự", "#btn-register") == false) {
            e.preventDefault();
            $('#notification-content-fail').html("Email dưới 50 ký tự");
            $('#modal-notification-fail').modal('show');
        } else if (check_max_min('#register_mat_khau', 20, 8, '#mat_khau_help', "Mật khẩu từ 8-20 ký tự", "#btn-register") == false) {
            e.preventDefault();
            $('#notification-content-fail').html("Mật khẩu từ 8-20 ký tự");
            $('#modal-notification-fail').modal('show');

        } else if (check_password_again("#register_mat_khau", '#register_nhap_lai_mat_khau', '#nhap_lai_mat_khau_help', "Nhập lại mật khẩu không chính xác", "#btn-register") == false) {
            e.preventDefault();
            $('#notification-content-fail').html("Nhập lại mật khẩu không chính xác");
            $('#modal-notification-fail').modal('show');

        } else if (check_sdt('#register_sdt', '#sdt_help', '#btn-register') == false) {
            e.preventDefault();
            $('#notification-content-fail').html("Số điện thoại không đúng định dạng");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#register_sdt', 10, 10, '#sdt_help', 'Số điện thoại gồm 10 chữ số', '#btn-register') == false) {
            e.preventDefault();
            $('#notification-content-fail').html("Số điện thoại gồm 10 số");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#register_dia_chi', 100, 1, '#dia_chi_help', "địa chỉ từ 1-100 ký tự", "#btn-register") == false) {
            e.preventDefault();
            $('#notification-content-fail').html("Địa chỉ từ 1-100 ký tự");
            $('#modal-notification-fail').modal('show');

        } else if (check_select('#sl_tinhthanhpho', "#btn-register") == false) {
            e.preventDefault();
            $('#notification-content-fail').html("Bạn chưa chọn tỉnh thành phố");
            $('#modal-notification-fail').modal('show');

        } else if (check_select('#sl_quanhuyen', "#btn-register") == false) {
            e.preventDefault();
            $('#notification-content-fail').html("Bạn chưa chọn quận huyện");
            $('#modal-notification-fail').modal('show');

        } else if (check_select('#sl_xaphuong', "#btn-register") == false) {
            e.preventDefault();
            $('#notification-content-fail').html("Bạn chưa chọn xã phường");
            $('#modal-notification-fail').modal('show');

        }


    })

    $('#form_register').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "function/function_register_management.php",
            method: "POST",
            data: new FormData(this),
            contentType: false, //false => không đặt mặc định là default: 'application/x-www-form-urlencoded; charset=UTF-8'
            processData: false, //default: true => biến dữ liệu thành chuỗi vào truyền vào tham số data, false ko đổi thành chuỗi
            success: function (data) {
                if (data == "success") {
                    $('#notification-content-success').html("Chúc Mừng Bạn Đã Đăng Ký Thành Công");
                    var button = '<button id="btn-dangnhap" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-login">Đăng Nhập Ngay</button>';
                    $('.modal-footer').html(button);
                    $('#modal-notification-success').modal('show');
                    $('#btn-dangnhap').click(function () {
                        $('#modal-notification-success').modal('hide');
                    })
                } else {
                    $('#notification-content-fail').html("Đăng Ký Thất Bại");
                    $('.modal-footer').html("");
                    $('#modal-notification-fail').modal('show');

                }
            }

        })

    })


})