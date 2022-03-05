$.getScript("javascript/javascript-function.js", function () { })


$(function () {

    /******************************************* Update SmartPhone *******************************************/
    //kiểm tra tên chỉ dc nhập 30 ký tự
    $('#update_ten_smartphone').keyup(function () {
        check_max_min(this, 30, 5, '#update_ten_smartphone_help', "Tên từ 5-30 ký tự", "#btn_update_smartphone");
        
    })

    //định dạng giá VND và kiểm tra giá có phải là số hay không
    $('#input_show_gia_smartphone').keyup(function () {
        check_and_format_number(this, "#input_show_gia_smartphone_help", "#update_gia_smartphone", 10, "Giá phải là số!!!", "Chỉ cho phép nhập 10 chữ số!!!", "#btn_update_smartphone");
    })

    //định dạng Số Lượng Sản Phẩm và kiểm tra số lượng có phải là số hay không
    $('#input_show_so_luong_smartphone').keyup(function () {
        check_and_format_number(this, "#input_show_so_luong_smartphone_help", "#update_so_luong_smartphone", 5, "Số lượng phải là số!!!", "Chỉ cho phép nhập 5 chữ số!!!", "#btn_update_smartphone");
    })

    //kiểm tra dữ liệu có rỗng hoặc chính xác hay ko trước khi submit
    $('#btn_update_smartphone').click(function (e) {
        var nuocsanxuat = $('#update_nsx_smartphone').val();
        var ten = $('#update_ten_smartphone').val();
        var gia = $('#update_gia_smartphone').val();
        var so_luong = $('#update_so_luong_smartphone').val();
        var bonho = $('#update_bonho_smartphone').val();
        var ram = $('#update_ram_smartphone').val();
        var thuonghieu = $('#update_thuonghieu_smartphone').val();
        var hedieuhanh = $('#update_hedieuhanh_smartphone').val();
        var thietke = $('#update_thietke_smartphone').val();
        var chip = $('#update_chip_smartphone').val();
        var manhinh = $('#update_manhinh_smartphone').val();
        var khuyenmai = $('#update_khuyenmai_smartphone').val();
        var trangthaisanpham = $('#update_trangthaisanpham_smartphone').val();
        var gioi_thieu = $('textarea[name = update_gioi_thieu_smartphone]').val();

        if (nuocsanxuat == "" || ten == "" || gia == "" || so_luong == "" || bonho == "" || ram == "" || thuonghieu == "" ||
            hedieuhanh == "" || thietke == "" || chip == "" || manhinh == "" || khuyenmai == "" || gioi_thieu == "" || trangthaisanpham == "") {
            e.preventDefault();
            $('#notification-content-fail').html('Bạn chưa nhập đủ dữ liệu');
            $('#modal-notification-fail').modal('show');
        }else if (check_max_min('#update_ten_smartphone', 30, 5, '#update_ten_smartphone_help', "Tên từ 5-30 ký tự", "#btn_update_smartphone") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Tên từ 5-30 ký tự');
            $('#modal-notification-fail').modal('show');
            // $('#update_ten_smartphone_help').html("Tên từ 5-30 ký tự");

        } else if (check_and_format_number('#input_show_gia_smartphone', "#input_show_gia_smartphone_help", "#update_gia_smartphone", 10, "Giá phải là số!!!", "Chỉ cho phép nhập 10 chữ số!!!", "#btn_update_smartphone") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Lỗi GIÁ');
            $('#modal-notification-fail').modal('show');
            $('#input_show_gia_smartphone').addClass('is-invalid');

        } else if (check_and_format_number('#input_show_so_luong_smartphone', "#input_show_so_luong_smartphone_help", "#update_so_luong_smartphone", 5, "Số lượng phải là số!!!", "Chỉ cho phép nhập 5 chữ số!!!", "#btn_update_smartphone") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Lỗi SỐ LƯỢNG');
            $('#modal-notification-fail').modal('show');
            $('#input_show_so_luong_smartphone').addClass('is-invalid');
        }
    })

    //submit update điện thoại
    $('#form_update_smartphone').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "function/function_smartphone_management.php",
            method: "POST",
            data: new FormData(this),
            contentType: false, //false => không đặt mặc định là default: 'application/x-www-form-urlencoded; charset=UTF-8'
            processData: false, //default: true => biến dữ liệu thành chuỗi vào truyền vào tham số data, false ko đổi thành chuỗi
            success: function (data) {
                if (data == "success") {
                    $('#notification-content-success').html("Cập Nhật Điện Thoại Thành Công");
                    var button = '<a href="manage.php" class="btn btn-success btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i>&ensp;Quay Về Trang Quản Lý</a>';
                    $('.modal-footer').html(button);
                    $('#modal-notification-success').modal('show');
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    $('#notification-content-fail').html(data);
                    $('#modal-notification-fail').modal('show');
                }
            }

        })
    })




    /******************************************* Update HeadPhone *******************************************/
    //kiểm tra tên chỉ dc nhập 30 ký tự
    $('#update_ten_headphone').keyup(function () {
        check_max_min(this, 30, 5, '#update_ten_headphone_help', "Tên từ 5-30 ký tự", "#btn_update_headphone");

    })

    //định dạng giá VND và kiểm tra giá có phải là số hay không
    $('#input_show_gia_headphone').keyup(function () {
        check_and_format_number(this, "#input_show_gia_headphone_help", "#update_gia_headphone", 10, "Giá phải là số!!!", "Chỉ cho phép nhập 10 chữ số!!!", "#btn_update_headphone");
    })

    //định dạng Số Lượng Sản Phẩm và kiểm tra số lượng có phải là số hay không
    $('#input_show_so_luong_headphone').keyup(function () {
        check_and_format_number(this, "#input_show_so_luong_headphone_help", "#update_so_luong_headphone", 5, "Số lượng phải là số!!!", "Chỉ cho phép nhập 5 chữ số!!!", "#btn_update_headphone");
    })

    //kiểm tra dữ liệu có rỗng hoặc chính xác hay ko trước khi submit
    $('#btn_update_headphone').click(function (e) {
        var nuocsanxuat = $('#update_nsx_headphone').val();
        var ten = $('#update_ten_headphone').val();
        var gia = $('#update_gia_headphone').val();
        var so_luong = $('#update_so_luong_headphone').val();
        var khuyenmai = $('#update_khuyenmai_headphone').val();
        var thuonghieu = $('#update_thuonghieu_headphone').val();
        var gioi_thieu = $('textarea[name = update_gioi_thieu_headphone]').val();
        var loaiketnoi = $('textarea[name = update_loaiketnoi_headphone]').val();
        var trangthaisanpham = $('#update_trangthaisanpham_headphone').val();

        if (nuocsanxuat == "" || loaiketnoi == "" || ten == "" || gia == "" || so_luong == "" || khuyenmai == "" || thuonghieu == "" || gioi_thieu == "" || trangthaisanpham == "") {
            e.preventDefault();
            $('#notification-content-fail').html('Bạn chưa nhập đủ dữ liệu');
            $('#modal-notification-fail').modal('show');
        }else if (check_max_min('#update_ten_headphone', 30, 5, '#update_ten_headphone_help', "Tên từ 5-30 ký tự", "#btn_update_headphone") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Tên từ 5-30 ký tự');
            $('#modal-notification-fail').modal('show');
            // $('#update_ten_headphone_help').html("Tên từ 5-30 ký tự");

        } else if (check_and_format_number('#input_show_gia_headphone', "#input_show_gia_headphone_help", "#update_gia_headphone", 10, "Giá phải là số!!!", "Chỉ cho phép nhập 10 chữ số!!!", "#btn_update_headphone") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Lỗi GIÁ');
            $('#modal-notification-fail').modal('show');
            $('#input_show_gia_headphone').addClass('is-invalid');

        } else if (check_and_format_number('#input_show_so_luong_headphone', "#input_show_so_luong_headphone_help", "#update_so_luong_headphone", 5, "Số lượng phải là số!!!", "Chỉ cho phép nhập 5 chữ số!!!", "#btn_update_headphone") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Lỗi SỐ LƯỢNG');
            $('#modal-notification-fail').modal('show');
            $('#input_show_so_luong_headphone').addClass('is-invalid');
        }
    })

    //submit update tai nghe
    $('#form_update_headphone').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "function/function_headphone_management.php",
            method: "POST",
            data: new FormData(this),
            contentType: false, //false => không đặt mặc định là default: 'application/x-www-form-urlencoded; charset=UTF-8'
            processData: false, //default: true => biến dữ liệu thành chuỗi vào truyền vào tham số data, false ko đổi thành chuỗi
            success: function (data) {
                if (data == "success") {
                    $('#notification-content-success').html("Cập Nhật Tai Nghe Thành Công");
                    var button = '<a href="manage.php" class="btn btn-success btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i>&ensp;Quay Về Trang Quản Lý</a>';
                    $('.modal-footer').html(button);
                    $('#modal-notification-success').modal('show');
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    $('#notification-content-fail').html(data);
                    $('#modal-notification-fail').modal('show');
                }
            }

        })
    })



    /******************************************* Update PhoneCase *******************************************/
    //kiểm tra tên chỉ dc nhập 30 ký tự
    $('#update_ten_phonecase').keyup(function () {
        check_max_min(this, 30, 5, '#update_ten_phonecase_help', "Tên từ 5-30 ký tự", "#btn_update_phonecase");

    })

    //định dạng giá VND và kiểm tra giá có phải là số hay không
    $('#input_show_gia_phonecase').keyup(function () {
        check_and_format_number(this, "#input_show_gia_phonecase_help", "#update_gia_phonecase", 10, "Giá phải là số!!!", "Chỉ cho phép nhập 10 chữ số!!!", "#btn_update_phonecase");
    })

    //định dạng Số Lượng Sản Phẩm và kiểm tra số lượng có phải là số hay không
    $('#input_show_so_luong_phonecase').keyup(function () {
        check_and_format_number(this, "#input_show_so_luong_phonecase_help", "#update_so_luong_phonecase", 5, "Số lượng phải là số!!!", "Chỉ cho phép nhập 5 chữ số!!!", "#btn_update_phonecase");
    })

    //kiểm tra dữ liệu có rỗng hoặc chính xác hay ko trước khi submit
    $('#btn_update_phonecase').click(function (e) {
        var nuocsanxuat = $('#update_nsx_phonecase').val();
        var ten = $('#update_ten_phonecase').val();
        var gia = $('#update_gia_phonecase').val();
        var so_luong = $('#update_so_luong_phonecase').val();
        var khuyenmai = $('#update_khuyenmai_phonecase').val();
        var thuonghieu = $('#update_thuonghieu_phonecase').val();
        var gioi_thieu = $('textarea[name = update_gioi_thieu_phonecase]').val();
        var chatlieu = $('textarea[name = update_chatlieu_phonecase]').val();
        var trangthaisanpham = $('#update_trangthaisanpham_phonecase').val();


        if (nuocsanxuat == "" || chatlieu == "" || ten == "" || gia == "" || so_luong == "" || khuyenmai == "" || thuonghieu == "" || gioi_thieu == "" ||
            image_avatar == "" || image_1 == "" || image_2 == "" || image_3 == "" || trangthaisanpham == "") {
            e.preventDefault();
            $('#notification-content-fail').html('Bạn chưa nhập đủ dữ liệu');
            $('#modal-notification-fail').modal('show');
        }else if (check_max_min('#update_ten_phonecase', 30, 5, '#update_ten_phonecase_help', "Tên từ 5-30 ký tự", "#btn_update_phonecase") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Tên từ 5-30 ký tự');
            $('#modal-notification-fail').modal('show');
            // $('#update_ten_phonecase_help').html("Tên từ 5-30 ký tự");

        } else if (check_and_format_number('#input_show_gia_phonecase', "#input_show_gia_phonecase_help", "#update_gia_phonecase", 10, "Giá phải là số!!!", "Chỉ cho phép nhập 10 chữ số!!!", "#btn_update_phonecase") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Lỗi GIÁ');
            $('#modal-notification-fail').modal('show');
            $('#input_show_gia_phonecase').addClass('is-invalid');

        } else if (check_and_format_number('#input_show_so_luong_phonecase', "#input_show_so_luong_phonecase_help", "#update_so_luong_phonecase", 5, "Số lượng phải là số!!!", "Chỉ cho phép nhập 5 chữ số!!!", "#btn_update_phonecase") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Lỗi SỐ LƯỢNG');
            $('#modal-notification-fail').modal('show');
            $('#input_show_so_luong_phonecase').addClass('is-invalid');
        }
    })

    //submit update op lung
    $('#form_update_phonecase').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "function/function_phonecase_management.php",
            method: "POST",
            data: new FormData(this),
            contentType: false, //false => không đặt mặc định là default: 'application/x-www-form-urlencoded; charset=UTF-8'
            processData: false, //default: true => biến dữ liệu thành chuỗi vào truyền vào tham số data, false ko đổi thành chuỗi
            success: function (data) {
                if (data == "success") {
                    $('#notification-content-success').html("Cập Nhật Ốp Lưng Thành Công");
                    var button = '<a href="manage.php" class="btn btn-success btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i>&ensp;Quay Về Trang Quản Lý</a>';
                    $('.modal-footer').html(button);
                    $('#modal-notification-success').modal('show');
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    $('#notification-content-fail').html(data);
                    $('#modal-notification-fail').modal('show');
                }
            }

        })
    })
})