$.getScript("javascript/javascript-function.js", function () { })

$(function () {
    /************************************************* Cập Nhật Thông Tin Tài Khoản *************************************************/
    //kiểm tra họ tên
    $('#update_ten').on('keyup', function () {
        if (check_string_modal(this, '#update_ten_help', "Họ tên không được nhập số", "#btn-update-account") == true) {
            check_max_min(this, 30, 5, '#update_ten_help', "Tên từ 5-30 ký tự", "#btn-update-account");
        }
    })

    //kiểm tra email
    $('#update_email').on('keyup', function () {
        var id_kh = $('#update_id').val();
        var email = $(this).val();
        if (check_email(this, '#update_email_help', "Email không đúng định dạng (VD: ...@gmail.com)", "#btn-update-account") == true) {
            if (check_max_min(this, 50, 11, '#update_email_help', "Email dưới 50 ký tự", "#btn-update-account") == true) {
                $.post("function/function_account_management.php", { send_check_email_update_exist: email, send_id_kh: id_kh }, function (result_check) {
                    if (result_check == "fail") {
                        $('#update_email').removeClass('is-valid');
                        $('#update_email').addClass('is-invalid');
                        $('#btn-update-account').attr('disabled', 'true');
                        $('#update_email_help').html("Email đã đăng ký rồi, vui lòng nhập email khác");
                    } else {
                        $('#update_email').removeClass('is-invalid');
                        $('#update_email').addClass('is-valid');
                        $('#btn-update-account').removeAttr('disabled');
                        $('#update_email_help').html('');
                    }
                })
            }
        }
    })

    //kiểm tra sdt
    $('#update_sdt').on('keyup', function () {
        if (check_sdt(this, '#update_sdt_help', "#btn-update-account") == true) {
            check_max_min(this, 10, 10, '#update_sdt_help', "Số điện thoại gồm 10 số bắt đầu bằng số 0", "#btn-update-account");
        }
    })

    //nút cập nhật thông tin
    $('#btn-update-account').on('click', function () {
        var errors = "";

        if (check_string_modal('#update_ten', '#update_ten_help', "Họ tên không được nhập số", "#btn-update-account") == false) {
            errors = "fail";
            $('#notification-content-fail').html("Họ tên không được nhập số");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#update_ten', 30, 5, '#update_ten_help', "Tên từ 5-30 ký tự", "#btn-update-account") == false) {
            errors = "fail";
            $('#notification-content-fail').html("Họ tên không được nhập số");
            $('#modal-notification-fail').modal('show');

        } else if (check_email('#update_email', '#update_email_help', "Email không đúng định dạng (VD: ...@gmail.com)", "#btn-update-account") == false) {
            errors = "fail";
            $('#notification-content-fail').html("Email không đúng định dạng");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#update_email', 50, 11, '#update_email_help', "Email dưới 50 ký tự", "#btn-update-account") == false) {
            errors = "fail";
            $('#notification-content-fail').html("Email dưới 50 ký tự");
            $('#modal-notification-fail').modal('show');

        } else if (check_sdt('#update_sdt', '#update_sdt_help', "#btn-update-account") == false) {
            errors = "fail";
            $('#notification-content-fail').html("Số điện thoại không đúng định dạng");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#update_sdt', 10, 10, '#update_sdt_help', "Số điện thoại gồm 10 số bắt đầu bằng số 0", "#btn-update-account") == false) {
            errors = "fail";
            $('#notification-content-fail').html("Số điện thoại gồm 10 số bắt đầu bằng số 0");
            $('#modal-notification-fail').modal('show');

        }

        //nếu lỗi thì ko cho submit
        if (errors == "") {
            var id_kh = $('#update_id').val();
            var ten = $('#update_ten').val();
            var email = $('#update_email').val();
            var sdt = $('#update_sdt').val();
            $.post("function/function_account_management.php", { send_update_id: id_kh, send_update_ten: ten, send_update_email: email, send_update_sdt: sdt }, function (result_update) {
                if (result_update == "success") {
                    $('#notification-content-success').html("Cập Nhật Thành Công");
                    $('#modal-notification-success').modal('show');
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                } else {
                    $('#notification-content-fail').html("Cập Nhật Thất bại, Có Thể Email bạn vừa nhập đã tồn tại");
                    $('#modal-notification-fail').modal('show');
                }
            })
        }
    })

    /************************************************* Cập Nhật Mật Khẩu *************************************************/
    //kiểm tra mật khẩu mới
    $('#update_password_matkhau_moi').on('keyup', function () {
        check_max_min(this, 20, 8, '#update_password_matkhau_moi_help', "Mật khẩu từ 8-20 ký tự", "#btn-update-password");
    })

    //cập nhật mật khẩu
    $('#btn-update-password').on('click', function () {
        var id_kh = $('#update_id').val();
        var matkhau_cu = $('#update_password_matkhau_cu').val();
        var matkhau_moi = $('#update_password_matkhau_moi').val();

        $.post("function/function_account_management.php",
            { send_update_password_id_kh: id_kh, send_update_password_matkhau_cu: matkhau_cu, send_update_password_matkhau_moi: matkhau_moi },
            function (result_change_password) {
                if (result_change_password == "success") {
                    $('#modal_matkhau').modal('hide');
                    $('#notification-content-success').html("Cập Nhật Mật Khẩu Thành Công");
                    $('#modal-notification-success').modal('show');
                } else {
                    $('#show_error').html('<div class="alert alert-warning" role="alert">Cập Nhật Thất Bại Kiểm Tra Lại Mật Khẩu</div>');
                }
            })
    })


    /*********************************************** Button THÊM ĐỊA CHỈ ***********************************************/
    $('#insert_dia_chi_khach_hang').keyup(function () {
        check_max_min(this, 100, 1, '#insert_dia_chi_khach_hang_help', "Địa chỉ từ 1-100 ký tự", '#btn-insert-diachi');
    })

    $(document).on('click', '#btn-insert-diachi', function () {
        var id_tinhthanhpho = $('#sl_tinhthanhpho').val();
        var id_quanhuyen = $('#sl_quanhuyen').val();
        var id_xaphuong = $('#sl_xaphuong').val();
        var dia_chi = $('#insert_dia_chi_khach_hang').val();

        if (id_tinhthanhpho == "" || id_quanhuyen == "" || id_xaphuong == "" || dia_chi == "") {
            $('#notification-content-fail').html("Bạn Chưa Nhập Đủ Dữ Liệu");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#insert_dia_chi_khach_hang', 100, 1, '#insert_dia_chi_khach_hang_help', "Số nhà tên đường từ 1-100 ký tự", '#btn-insert-diachi') == false) {
            $('#notification-content-fail').html("Số nhà tên đường từ 1-100 ký tự");
            $('#modal-notification-fail').modal('show');

        } else {
            $.post("function/function_account_management.php", { send_insert_diachi_id_xp: id_xaphuong, send_insert_diachi_dia_chi: dia_chi }, function (result_insert_diachi) {
                if (result_insert_diachi == "success") {
                    $('#notification-content-success').html("Thêm Địa Chỉ Thành Công");
                    $('#modal-notification-success').modal('show');
                    $(document).on('click', '#modal-notification-success', function () {
                        // $('#show_diachi').load(' #show_diachi');
                        location.reload();
                    })
                } else {
                    $('#notification-content-fail').html("Thêm Địa Chỉ Thất Bại");
                    $('#modal-notification-fail').modal('show');
                }
            })
        }
    })

    /*********************************************** CHECKBOX đổi địa chỉ MẶC ĐỊNH ***********************************************/
    $(document).on('click', 'button[name = btn_change_diachi_mac_dinh]', function () {
        var id_dc = $(this).val();
        if (id_dc != "") {
            $.post("function/function_account_management.php", { send_change_diachi_macdinh_id: id_dc }, function (result_change_diachi_macdinh) {
                if (result_change_diachi_macdinh == "success") {
                    $('#notification-content-success').html("Thay đổi địa chỉ mặc định thành công <br/> (Click chuột bắt kỳ nơi nào để áp dụng)");
                    $('#modal-notification-success').modal('show');
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
            })
        }
    })

    /*********************************************** Xóa địa chỉ ***********************************************/
    $(document).on('click', 'button[name = btn_delete_diachi]', function () {
        var id_dc = $(this).val();
        $.post("function/function_account_management.php", { send_delete_diachi_id: id_dc }, function (result_delete_diachi) {
            if (result_delete_diachi == "success") {
                $('#notification-content-success').html("Xóa địa chỉ thành công");
                $('#modal-notification-success').modal('show');
                $(document).on('click', '#modal-notification-success', function () {
                    $('#show_diachi').load(' #show_diachi');
                })
            } else {
                $('#notification-content-fail').html("Xóa Địa Chỉ Thất Bại");
                $('#modal-notification-fail').modal('show');
            }
        })
    })

    /*********************************************** Button hiện MODAL CẬP NHẬT ĐỊA CHỈ ***********************************************/
    $(document).on('click', 'button[name = btn_modal_update_diachi]', function () {
        var id_dc = $(this).val();
        $.post("function/function_account_management.php", { send_get_diachi_id: id_dc }, function (result_get_diachi) {
            $('#modal_content_update_diachi').html(result_get_diachi);
            $('#modal_update_diachi').modal('show');
        })
    })

    /*********************************************** Button CẬP NHẬT ĐỊA CHỈ ***********************************************/

    //CHÚ Ý: script kiểm tra nhập địa chỉ bên function_account_management.php trong phần hiện modal
    $(document).on('click', '#btn_update_diachi', function () {
        var id_dc = $(this).val();
        var id_ttp = $('#sl_tinhthanhpho').val();
        var id_qh = $('#sl_quanhuyen').val();
        var id_xp = $('#sl_xaphuong').val();
        var dia_chi = $('#update_diachi_dia_chi').val();

        if (id_ttp == "" || id_qh == "" || id_xp == "" || dia_chi == "") {
            $('#notification-content-fail').html("Bạn Chưa Nhập Đủ Dữ Liệu");
            $('#modal-notification-fail').modal('show');
            $('#modal_update_diachi').on('click', function () {
                $('#modal-notification-fail').modal('hide');
                $('#modal_update_diachi').modal('show');
            })
        } else {
            $.post("function/function_account_management.php", { send_update_diachi_id: id_dc, send_update_diachi_id_xp: id_xp, send_update_diachi_dia_chi: dia_chi }, function (result_update_diachi) {
                if (result_update_diachi == "success") {
                    $('#notification-content-success').html("Địa chỉ đã được cập nhật");
                    $('#modal-notification-success').modal('show');
                    $('#modal-notification-success').on('click', function () {
                        location.reload();
                    })
                } else {
                    $('#notification-content-fail').html("Cập Nhật Địa Chỉ Thất Bại");
                    $('#modal-notification-fail').modal('show');
                }
            })
        }

    })
})