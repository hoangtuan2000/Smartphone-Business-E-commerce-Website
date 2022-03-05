$.getScript("javascript/javascript-function.js", function () { })

$(function () {

    /***************************************  Thêm ĐIỆN THOẠI ***************************************/
    //nhấn nút làm mới trang thêm điện thoại
    $('#btn-reset-insert-smartphone').click(function () {
        location.reload();
    })

    //kiểm tra tên chỉ dc nhập 30 ký tự
    $('#insert_ten_smartphone').keyup(function () {
        check_max_min(this, 30, 5, '#insert_ten_smartphone_help', "Tên từ 5-30 ký tự", "#btn_insert_smartphone");
    })

    //định dạng giá VND và kiểm tra giá có phải là số hay không
    $('#input_show_gia_smartphone').keyup(function () {
        check_and_format_number(this, "#input_show_gia_smartphone_help", "#insert_gia_smartphone", 10, "Giá phải là số!!!", "Chỉ cho phép nhập 10 chữ số!!!", "#btn_insert_smartphone");
    })

    //định dạng Số Lượng Sản Phẩm và kiểm tra số lượng có phải là số hay không
    $('#input_show_so_luong_smartphone').keyup(function () {
        check_and_format_number(this, "#input_show_so_luong_smartphone_help", "#insert_so_luong_smartphone", 5, "Số lượng phải là số!!!", "Chỉ cho phép nhập 5 chữ số!!!", "#btn_insert_smartphone");
    })

    //kiểm tra dữ liệu có rỗng hoặc chính xác hay ko trước khi submit thêm điện thoại
    $('#btn_insert_smartphone').click(function (e) {
        var nuocsanxuat = $('#insert_nsx_smartphone').val();
        var ten = $('#insert_ten_smartphone').val();
        var gia = $('#insert_gia_smartphone').val();
        var so_luong = $('#insert_so_luong_smartphone').val();
        var khuyenmai = $('#insert_khuyenmai_smartphone').val();
        var bonho = $('#insert_bonho_smartphone').val();
        var ram = $('#insert_ram_smartphone').val();
        var thuonghieu = $('#insert_thuonghieu_smartphone').val();
        var hedieuhanh = $('#insert_hedieuhanh_smartphone').val();
        var thietke = $('#insert_thietke_smartphone').val();
        var chip = $('#insert_chip_smartphone').val();
        var manhinh = $('#insert_manhinh_smartphone').val();
        var gioi_thieu = $('textarea[name = insert_gioi_thieu_smartphone]').val();
        var image_avatar = $('#image_avatar').val();
        var image_1 = $('#image_1').val();
        var image_2 = $('#image_2').val();
        var image_3 = $('#image_3').val();

        if (nuocsanxuat == "" || ten == "" || gia == "" || so_luong == "" || bonho == "" || ram == "" ||
            thuonghieu == "" || hedieuhanh == "" || thietke == "" || chip == "" || manhinh == "" || gioi_thieu == "" ||
            image_avatar == "" || image_1 == "" || image_2 == "" || image_3 == "" || khuyenmai == "") {
            e.preventDefault();
            $('#notification-content-fail').html('Bạn chưa nhập đủ dữ liệu');
            $('#modal-notification-fail').modal('show');
        } else if (check_max_min('#insert_ten_smartphone', 30, 5, '#insert_ten_smartphone_help', "Tên từ 5-30 ký tự", "#btn_insert_smartphone") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Tên từ 5-30 ký tự');
            $('#modal-notification-fail').modal('show');

        } else if (check_and_format_number('#input_show_gia_smartphone', "#input_show_gia_smartphone_help", "#insert_gia_smartphone", 10, "Giá phải là số!!!", "Chỉ cho phép nhập 10 chữ số!!!", "#btn_insert_smartphone") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Lỗi GIÁ');
            $('#modal-notification-fail').modal('show');
            $('#input_show_gia_smartphone').addClass('is-invalid');

        } else if (check_and_format_number('#input_show_so_luong_smartphone', "#input_show_so_luong_smartphone_help", "#insert_so_luong_smartphone", 5, "Số lượng phải là số!!!", "Chỉ cho phép nhập 5 chữ số!!!", "#btn_insert_smartphone") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Lỗi SỐ LƯỢNG');
            $('#modal-notification-fail').modal('show');
            $('#input_show_so_luong_smartphone').addClass('is-invalid');
        }
    })

    //submit them điện thoại
    $('#form_insert_smartphone').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "function/function_smartphone_management.php",
            method: "POST",
            data: new FormData(this),
            contentType: false, //false => không đặt mặc định là default: 'application/x-www-form-urlencoded; charset=UTF-8'
            processData: false, //default: true => biến dữ liệu thành chuỗi vào truyền vào tham số data, false ko đổi thành chuỗi
            success: function (data) {
                if (data == "success") {
                    $('#notification-content-success').html("Thêm Điện Thoại Thành Công");
                    var button = '<a href="manage.php" class="btn btn-success btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i>Quay Về Trang Quản Lý</a>';
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



    /***************************************  Thêm TAI NGHE ***************************************/
    //nhấn nút làm mới trang thêm tai nghe
    $('#btn-reset-insert-headphone').click(function () {
        location.reload();
    })

    //kiểm tra tên chỉ dc nhập 30 ký tự
    $('#insert_ten_headphone').keyup(function () {
        check_max_min(this, 30, 5, '#insert_ten_headphone_help', "Tên từ 5-30 ký tự", "#btn_insert_headphone");
    })

    //định dạng giá VND và kiểm tra giá có phải là số hay không
    $('#input_show_gia_headphone').keyup(function () {
        check_and_format_number(this, "#input_show_gia_headphone_help", "#insert_gia_headphone", 10, "Giá phải là số!!!", "Chỉ cho phép nhập 10 chữ số!!!", "#btn_insert_headphone");
    })

    //định dạng Số Lượng Sản Phẩm và kiểm tra số lượng có phải là số hay không
    $('#input_show_so_luong_headphone').keyup(function () {
        check_and_format_number(this, "#input_show_so_luong_headphone_help", "#insert_so_luong_headphone", 5, "Số lượng phải là số!!!", "Chỉ cho phép nhập 5 chữ số!!!", "#btn_insert_headphone");
    })

    //kiểm tra dữ liệu có rỗng hoặc chính xác hay ko trước khi submit thêm tai nghe
    $('#btn_insert_headphone').click(function (e) {
        var nuocsanxuat = $('#insert_nsx_headphone').val();
        var ten = $('#insert_ten_headphone').val();
        var gia = $('#insert_gia_headphone').val();
        var so_luong = $('#insert_so_luong_headphone').val();
        var khuyenmai = $('#insert_khuyenmai_headphone').val();
        var thuonghieu = $('#insert_thuonghieu_headphone').val();
        var loaiketnoi = $('#insert_loaiketnoi_headphone').val();
        var gioi_thieu = $('textarea[name = insert_gioi_thieu_headphone]').val();
        var image_avatar = $('#image_avatar').val();
        var image_1 = $('#image_1').val();
        var image_2 = $('#image_2').val();
        var image_3 = $('#image_3').val();

        if (nuocsanxuat == "" || ten == "" || gia == "" || so_luong == "" || khuyenmai == "" || thuonghieu == "" || loaiketnoi == "" || gioi_thieu == "" || image_avatar == "" || image_1 == "" || image_2 == "" || image_3 == "") {
            e.preventDefault();
            $('#notification-content-fail').html('Bạn chưa nhập đủ dữ liệu');
            $('#modal-notification-fail').modal('show');

        } else if (check_max_min('#insert_ten_headphone', 30, 5, '#insert_ten_headphone_help', "Tên từ 5-30 ký tự", "#btn_insert_headphone") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Tên từ 5-30 ký tự');
            $('#modal-notification-fail').modal('show');

        } else if (check_and_format_number('#input_show_gia_headphone', "#input_show_gia_headphone_help", "#insert_gia_headphone", 10, "Giá phải là số!!!", "Chỉ cho phép nhập 10 chữ số!!!", "#btn_insert_headphone") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Lỗi GIÁ');
            $('#modal-notification-fail').modal('show');
            $('#input_show_gia_headphone').addClass('is-invalid');

        } else if (check_and_format_number('#input_show_so_luong_headphone', "#input_show_so_luong_headphone_help", "#insert_so_luong_headphone", 5, "Số lượng phải là số!!!", "Chỉ cho phép nhập 5 chữ số!!!", "#btn_insert_headphone") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Lỗi SỐ LƯỢNG');
            $('#modal-notification-fail').modal('show');
            $('#input_show_so_luong_headphone').addClass('is-invalid');
        }
    })

    //submit them tai nghe
    $('#form_insert_headphone').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "function/function_headphone_management.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,//false => không đặt mặc định là default: 'application/x-www-form-urlencoded; charset=UTF-8'
            processData: false,//default: true => biến dữ liệu thành chuỗi vào truyền vào tham số data, false ko đổi thành chuỗi
            success: function (data) {
                if (data == "success") {
                    $('#notification-content-success').html("Thêm Tai Nghe Thành Công");
                    var button = '<a href="manage.php" class="btn btn-success btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i>Quay Về Trang Quản Lý</a>';
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




    /***************************************  Thêm ỐP LƯNG ***************************************/
    //nhấn nút làm mới trang thêm Ốp Lưng
    $('#btn-reset-insert-phonecase').click(function () {
        location.reload();
    })

    //kiểm tra tên chỉ dc nhập 30 ký tự
    $('#insert_ten_phonecase').keyup(function () {
        check_max_min(this, 30, 5, '#insert_ten_phonecase_help', "Tên từ 5-30 ký tự", "#btn_insert_phonecase");
    })

    //định dạng giá VND và kiểm tra giá có phải là số hay không
    $('#input_show_gia_phonecase').keyup(function () {
        check_and_format_number(this, "#input_show_gia_phonecase_help", "#insert_gia_phonecase", 10, "Giá phải là số!!!", "Chỉ cho phép nhập 10 chữ số!!!", "#btn_insert_phonecase");
    })

    //định dạng Số Lượng Sản Phẩm và kiểm tra số lượng có phải là số hay không
    $('#input_show_so_luong_phonecase').keyup(function () {
        check_and_format_number(this, "#input_show_so_luong_phonecase_help", "#insert_so_luong_phonecase", 5, "Số lượng phải là số!!!", "Chỉ cho phép nhập 5 chữ số!!!", "#btn_insert_phonecase");
    })

    //kiểm tra dữ liệu có rỗng hoặc chính xác hay ko trước khi submit thêm Ốp Lưng
    $('#btn_insert_phonecase').click(function (e) {
        var ten = $('#insert_ten_phonecase').val();
        var gia = $('#insert_gia_phonecase').val();
        var so_luong = $('#insert_so_luong_phonecase').val();
        var khuyenmai = $('#insert_khuyenmai_phonecase').val();
        var nuocsanxuat = $('#insert_nsx_phonecase').val();
        var thuonghieu = $('#insert_thuonghieu_phonecase').val();
        var chatlieu = $('#insert_chatlieu_phonecase').val();
        var gioi_thieu = $('textarea[name = insert_gioi_thieu_phonecase]').val();
        var image_avatar = $('#image_avatar').val();
        var image_1 = $('#image_1').val();
        var image_2 = $('#image_2').val();
        var image_3 = $('#image_3').val();

        if (nuocsanxuat == "" || ten == "" || gia == "" || so_luong == "" || khuyenmai == "" || thuonghieu == "" || chatlieu == "" || gioi_thieu == "" || image_avatar == "" || image_1 == "" || image_2 == "" || image_3 == "") {
            e.preventDefault();
            $('#notification-content-fail').html('Bạn chưa nhập đủ dữ liệu');
            $('#modal-notification-fail').modal('show');
        } else if (check_max_min('#insert_ten_phonecase', 30, 5, '#insert_ten_phonecase_help', "Tên từ 5-30 ký tự", "#btn_insert_phonecase") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Tên từ 5-30 ký tự');
            $('#modal-notification-fail').modal('show');

        } else if (check_and_format_number('#input_show_gia_phonecase', "#input_show_gia_phonecase_help", "#insert_gia_phonecase", 10, "Giá phải là số!!!", "Chỉ cho phép nhập 10 chữ số!!!", "#btn_insert_phonecase") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Lỗi GIÁ');
            $('#modal-notification-fail').modal('show');
            $('#input_show_gia_phonecase').addClass('is-invalid');

        } else if (check_and_format_number('#input_show_so_luong_phonecase', "#input_show_so_luong_phonecase_help", "#insert_so_luong_phonecase", 5, "Số lượng phải là số!!!", "Chỉ cho phép nhập 5 chữ số!!!", "#btn_insert_phonecase") == false) {
            e.preventDefault();
            $('#notification-content-fail').html('Lỗi SỐ LƯỢNG');
            $('#modal-notification-fail').modal('show');
            $('#input_show_so_luong_phonecase').addClass('is-invalid');
        }
    })

    //submit them Ốp Lưng
    $('#form_insert_phonecase').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "function/function_phonecase_management.php",
            method: "POST",
            data: new FormData(this),
            contentType: false, //false => không đặt mặc định là default: 'application/x-www-form-urlencoded; charset=UTF-8'
            processData: false, //default: true => biến dữ liệu thành chuỗi vào truyền vào tham số data, false ko đổi thành chuỗi
            success: function (data) {
                if (data == "success") {
                    $('#notification-content-success').html("Thêm Ốp Lưng Thành Công");
                    var button = '<a href="manage.php" class="btn btn-success btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i>Quay Về Trang Quản Lý</a>';
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
