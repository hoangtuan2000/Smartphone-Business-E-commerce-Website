$.getScript("javascript/javascript-function.js", function () { })



$(function () {

    /***************************************   Update Nhan Vien     ***************************************/
    //kiểm tra tên chỉ dc nhập 30 ký tự
    $('#update_ten_nv').keyup(function () {
        check_max_min(this, 30, 10, '#update_ten_nv_help', "Tên từ 10-30 ký tự", "button[name = btn-update-nv]");
    })

    //kiểm tra email có đúng định dạng hay ko
    $('#update_email_nv').keyup(function () {
        var email = $(this).val();
        if (check_email(this, '#update_email_nv_help', "Email có dạng: ab...@gmail.com", "button[name = btn-update-nv]") == true) {
            if (check_max_min(this, 50, 11, '#update_email_nv_help', "Email phải ít hơn 50 ký tự", "button[name = btn-update-nv]") == true) {
                $.post("function/function_staff_management.php", { send_check_email_exits: email }, function (check_email_exits) {
                    if (check_email_exits == "success") {
                        $('#update_email_nv_help').html("");
                        $('#update_email_nv').removeClass('is-invalid');
                        $('#update_email_nv').addClass('is-valid');
                        $("button[name = btn-update-nv]").removeAttr('disabled');

                    } else {
                        $('#update_email_nv_help').html("Email đã tồn tại. Vui lòng chọn nhập email khác");
                        $('#update_email_nv').removeClass('is-valid');
                        $('#update_email_nv').addClass('is-invalid');
                        $("button[name = btn-update-nv]").attr('disabled', 'true');
                    }
                })
            }
        }
    })

    //kiểm tra số điện thoại có phải là số không và chỉ dc nhập 10 ký tự
    $('#update_sdt_nv').keyup(function () {
        if (check_sdt(this, "#update_sdt_nv_help", "button[name = btn-update-nv]") == true) {
            check_max_min(this, 10, 10, '#update_sdt_nv_help', "SDT gồm 10 chữ số", "button[name = btn-update-nv]");
        }
    })

    $('#update_password_nv').keyup(function () {
        check_max_min(this, 30, 10, '#update_password_nv_help', "Password từ 10-30 ký tự", "button[name = btn-update-nv]");
    })

    $('#update_diachi_nv').keyup(function () {
        check_max_min(this, 100, 10, '#update_diachi_nv_help', "Địa chỉ từ 10-100 ký tự", "button[name = btn-update-nv]");
    })

    $('button[name = btn-update-nv]').click(function () {
        var update_id_nv = $('#update_id_nv').val();
        var update_ten_nv_new = $('#update_ten_nv').val();
        var update_sdt_nv_new = $('#update_sdt_nv').val();
        var update_email_nv_new = $('#update_email_nv').val();
        var update_password_nv_new = $('#update_password_nv').val();
        var update_chucvu_nv_new = $('#update_sl_chucvu_nv').val();
        var update_trangthaihoatdong_nv_new = $('#update_sl_trangthaihoatdong_nv').val();
        var update_diachi_nv_new = $('#update_diachi_nv').val();
        var update_xaphuong_nv_new = $('#sl_xaphuong').val();
        var update_quanhuyen_nv_new = $('#sl_quanhuyen').val();
        var update_tinhthanhpho_nv_new = $('#sl_tinhthanhpho').val();

        //kiểm tra nội dung trước khi cập nhật (chưa nhập nội dung sẽ báo lỗi)
        if (update_id_nv == "" || update_ten_nv_new == "" || update_sdt_nv_new == "" || update_email_nv_new == "" ||
            update_password_nv_new == "" || update_chucvu_nv_new == "" || update_diachi_nv_new == "" || update_xaphuong_nv_new == "" ||
            update_quanhuyen_nv_new == "" || update_tinhthanhpho_nv_new == "" || update_trangthaihoatdong_nv_new == "") {

            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");
            $('#modal-notification-fail').modal('show');

        }
        else if (check_max_min('#update_ten_nv', 30, 10, '#update_ten_nv_help', "Tên từ 10-30 ký tự", "button[name = btn-update-nv]") == false) {
            $('#notification-content-fail').text("Tên từ 10-30 ký tự");
            $('#modal-notification-fail').modal('show');

        } else if (check_email('#update_email_nv', '#update_email_nv_help', "Email có dạng: ab...@gmail.com", "button[name = btn-update-nv]") == false) {
            $('#notification-content-fail').text("Lỗi Email");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#update_email_nv', 50, 11, '#update_email_nv_help', "Email phải ít hơn 50 ký tự", "button[name = btn-update-nv]") == false) {
            $('#notification-content-fail').text("Lỗi Email");
            $('#modal-notification-fail').modal('show');

        } else if (check_sdt('#update_sdt_nv', "#update_sdt_nv_help", "button[name = btn-update-nv]") == false) {
            $('#notification-content-fail').text("Số điện thoại không đúng định dạng");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#update_sdt_nv', 10, 10, '#update_sdt_nv_help', "SDT gồm 10 số", "button[name = btn-update-nv]") == false) {
            $('#notification-content-fail').text("Số điện thoại gồm 10 chữ số");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#update_password_nv', 30, 10, '#update_password_nv_help', "Password từ 10-30 ký tự", "button[name = btn-update-nv]") == false) {
            $('#notification-content-fail').text("Password từ 10-30 ký tự");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#update_diachi_nv', 100, 10, '#update_diachi_nv_help', "Địa chỉ từ 10-100 ký tự", "button[name = btn-update-nv]") == false) {
            $('#notification-content-fail').text("Địa chỉ từ 10-100 ký tự");
            $('#modal-notification-fail').modal('show');

        }

        else {
            $.post("function/function_staff_management.php",
                {
                    send_update_id_nv: update_id_nv, send_update_ten_nv_new: update_ten_nv_new, send_update_sdt_nv_new: update_sdt_nv_new, send_update_email_nv_new: update_email_nv_new,
                    send_update_password_nv_new: update_password_nv_new, send_update_chucvu_nv_new: update_chucvu_nv_new, send_update_diachi_nv_new: update_diachi_nv_new,
                    send_update_xaphuong_nv_new: update_xaphuong_nv_new, send_update_trangthaihoatdong_nv_new: update_trangthaihoatdong_nv_new
                }, function (update_result) {
                    if (update_result == "success") {
                        $('#notification-content-success').text("Cập Nhật Nhân Viên Thành Công");
                        $('.modal-footer').html('<a href="manage.php" class="btn btn-success btn-sm">Quay về Trang Quản Lý</a>');
                        $('#modal-notification-success').modal('show');

                    }
                    else {
                        $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Email");
                        $('#modal-notification-fail').modal('show');
                    }
                })

        }
    })


    /***************************************   Insert Nhan Vien     ***************************************/
    //kiểm tra tên chỉ dc nhập 30 ký tự
    $('#insert_ten_nv').keyup(function () {
        check_max_min(this, 30, 10, '#insert_ten_nv_help', "Tên từ 10-30 ký tự", "button[name = btn-insert-nv]");
    })

    //kiểm tra email có đúng định dạng hay ko
    $('#insert_email_nv').keyup(function () {
        var email = $(this).val();
        if (check_email(this, '#insert_email_nv_help', "Email có dạng: ab...@gmail.com", "button[name = btn-insert-nv]") == true) {
            if (check_max_min(this, 50, 11, '#insert_email_nv_help', "Email phải ít hơn 50 ký tự", "button[name = btn-insert-nv]") == true) {
                $.post("function/function_staff_management.php", { send_check_email_exits: email }, function (check_email_exits) {
                    if (check_email_exits == "success") {
                        $('#insert_email_nv_help').html("");
                        $('#insert_email_nv').removeClass('is-invalid');
                        $('#insert_email_nv').addClass('is-valid');
                        $("button[name = btn-insert-nv]").removeAttr('disabled');

                    } else {
                        $('#insert_email_nv_help').html("Email đã tồn tại. Vui lòng chọn nhập email khác");
                        $('#insert_email_nv').removeClass('is-valid');
                        $('#insert_email_nv').addClass('is-invalid');
                        $("button[name = btn-insert-nv]").attr('disabled', 'true');
                    }
                })
            }
        }
    })

    //kiểm tra số điện thoại có phải là số không và chỉ dc nhập 10 ký tự
    $('#insert_sdt_nv').keyup(function () {
        if (check_sdt(this, "#insert_sdt_nv_help", "button[name = btn-insert-nv]") == true) {
            check_max_min(this, 10, 10, '#insert_sdt_nv_help', "SDT gồm 10 chữ số", "button[name = btn-insert-nv]");
        }
    })

    $('#insert_password_nv').keyup(function () {
        check_max_min(this, 30, 10, '#insert_password_nv_help', "Password từ 10-30 ký tự", "button[name = btn-insert-nv]");
    })

    $('#insert_diachi_nv').keyup(function () {
        check_max_min(this, 100, 10, '#insert_diachi_nv_help', "Địa chỉ từ 10-100 ký tự", "button[name = btn-insert-nv]");
    })

    $('button[name = btn-insert-nv]').on('click', function () {
        var insert_ten_nv = $('#insert_ten_nv').val();
        var insert_sdt_nv = $('#insert_sdt_nv').val();
        var insert_email_nv = $('#insert_email_nv').val();
        var insert_password_nv = $('#insert_password_nv').val();
        var insert_chucvu_nv = $('#insert_sl_chucvu_nv').val();
        var insert_diachi_nv = $('#insert_diachi_nv').val();
        var insert_xaphuong_nv = $('#sl_xaphuong').val();
        var insert_quanhuyen_nv = $('#sl_quanhuyen').val();
        var insert_tinhthanhpho_nv = $('#sl_tinhthanhpho').val();

        //kiểm tra nội dung trước khi thêm database 
        if (insert_ten_nv == "" || insert_sdt_nv == "" || insert_email_nv == "" || insert_password_nv == "" ||
            insert_chucvu_nv == "" || insert_diachi_nv == "" || insert_xaphuong_nv == "" || insert_quanhuyen_nv == "" || insert_tinhthanhpho_nv == "") {

            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Đủ Dữ Liệu");
            $('#modal-notification-fail').modal('show');

        }
        else if (check_max_min('#insert_ten_nv', 30, 10, '#insert_ten_nv_help', "Tên từ 10-30 ký tự", "button[name = btn-insert-nv]") == false) {
            $('#notification-content-fail').text("Tên từ 10-30 ký tự");
            $('#modal-notification-fail').modal('show');

        } else if (check_email('#insert_email_nv', '#insert_email_nv_help', "Email có dạng: ab...@gmail.com", "button[name = btn-insert-nv]") == false) {
            $('#notification-content-fail').text("Lỗi Email");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#insert_email_nv', 50, 11, '#insert_email_nv_help', "Email phải ít hơn 50 ký tự", "button[name = btn-insert-nv]") == false) {
            $('#notification-content-fail').text("Lỗi Email");
            $('#modal-notification-fail').modal('show');

        } else if (check_sdt('#insert_sdt_nv', "#insert_sdt_nv_help", "button[name = btn-insert-nv]") == false) {
            $('#notification-content-fail').text("Số điện thoại không đúng định dạng");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#insert_sdt_nv', 10, 10, '#insert_sdt_nv_help', "SDT gồm 10 số", "button[name = btn-insert-nv]") == false) {
            $('#notification-content-fail').text("Số điện thoại gồm 10 chữ số");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#insert_password_nv', 30, 10, '#insert_password_nv_help', "Password từ 10-30 ký tự", "button[name = btn-insert-nv]") == false) {
            $('#notification-content-fail').text("Password từ 10-30 ký tự");
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#insert_diachi_nv', 100, 10, '#insert_diachi_nv_help', "Địa chỉ từ 10-100 ký tự", "button[name = btn-insert-nv]") == false) {
            $('#notification-content-fail').text("Địa chỉ từ 10-100 ký tự");
            $('#modal-notification-fail').modal('show');

        } else {
            $.post("function/function_staff_management.php", {
                send_insert_ten_nv: insert_ten_nv, send_insert_sdt_nv: insert_sdt_nv, send_insert_email_nv: insert_email_nv, send_insert_password_nv: insert_password_nv,
                send_insert_chucvu_nv: insert_chucvu_nv, send_insert_diachi_nv: insert_diachi_nv, send_insert_xaphuong_nv: insert_xaphuong_nv
            }, function (insert_result) {
                if (insert_result == "success") {
                    $('#notification-content-success').text("Thêm Nhân Viên Thành Công");
                    $('.modal-footer').html('<a href="manage.php" class="btn btn-success btn-sm">Quay về Trang Quản Lý</a>');
                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })

                }
                else {
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Đã Trùng Email");
                    $('#modal-notification-fail').modal('show');
                }
            })
        }
    })

})