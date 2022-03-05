$.getScript("javascript/javascript-function.js", function () { })

$(function () {
    /*********************************************** CHECKBOX chọn địa chỉ ***********************************************/
    $(document).on('click', 'input[name = radio_dia_chi]', function () {
        //khi click checkbox thì lấy id của input hiện địa chỉ format để hiện lên input địa chỉ giao hàng
        var id_input_show_diachi = $('input[name = radio_dia_chi]:checked').val();
        //lấy địa chỉ format của checkbox đc chọn
        var dia_chi_format = $('input[name = ' + id_input_show_diachi + ']').val();
        //gán địa chỉ format cho input địa chỉ giao hàng
        $('#order_dia_chi').val(dia_chi_format);
    })

    /*********************************************** kiểm tra đăng nhập và giỏ hàng trước khu mua ***********************************************/
    //nhấn nút đặt mua mà chưa đăng nhập thì mời đăng nhập
    $('#btn-datmua').click(function () {
        var user = $('#insert_cart_user').val();
        //nếu chưa đăng nhập thì mời đăng nhập
        if (user == "") {
            $('#modal-login').modal('show');
            return false;
        }
    })


    // khi nhấn nút xóa sản phẩm kiểm tra xem trong giỏ hàng có rỗng không nếu rỗng thì kêu ngta quay lại index
    $(document).on('click', 'button[name = btn-delete-cart]', function () {
        $.post("function/function_order_management.php", { send_check_empty_giohang: 1 }, function (result_check) {
            if (result_check == "empty") {
                $('#notification-content-fail').html("Bạn Đã Xóa Hết Sản Phẩm Trong Giỏ Hàng <br/> Vui lòng quay lại trang chủ");
                var button = '<a href="index.php" class="btn btn-primary btn-sm">Quay Về Trang Chủ</a>';
                $('.modal-footer').html(button);
                $('#modal-notification-fail').modal('show');
                $('#modal-notification-fail').click(function () {
                    window.location.href = "index.php";
                })
            }
        })
    })


    /*********************************************** đặt hàng thông qua nút MUA ***********************************************/
    //click nút  giảm sản phẩm khi mua thông qua btn MUA
    $('#btn-minus-product-id').on('click', function () {
        var so_luong = $('#input-quantity-product-id').val();
        so_luong = parseInt(so_luong);
        if (so_luong > 1) {
            so_luong -= 1;
            //gán số lượng vào input để hiển thị
            $('#input-quantity-product-id').val(so_luong);
            //lấy giá tiền để tính toán khi tăng giảm số lượng
            var gia = parseInt($('#input-gia-not-format').val());
            gia = gia * so_luong;

            //gán giá đã xử lý cho input_database
            // $('#input-gia-donhang').val(gia);

            //chuyển giá thành chuỗi để định dạng
            gia = gia.toString();
            gia = format_number(gia);
            $('#thanh-tien').html(gia);
            $('#tong-tien').html(gia);
        }
    })

    //click nút tăng  sản phẩm khi mua thông qua btn MUA
    $('#btn-plus-product-id').on('click', function () {
        var id_sp = $('#input-id-sp').val();
        var so_luong = $('#input-quantity-product-id').val();
        so_luong = parseInt(so_luong);

        $.post("function/function_cart_management.php", { send_check_quantity_id_sp: id_sp }, function (result_so_luong) {
            if (so_luong >= result_so_luong) {
                $('#notification-content-fail').html("Cửa hàng chỉ còn " + result_so_luong + " sản phẩm)");
                $('#modal-notification-fail').modal('show');
                $('#modal-notification-fail').click(function () {
                    location.reload();
                })
            } else {
                //nếu tăng số lượng hơn 10 sản phẩm thì hiện thông báo
                if (so_luong == 10) {
                    $('#notification-content-success').html("Bạn đã nhập hơn 10 sản phẩm <br/> (Vui lòng liên hệ với chúng tôi nếu mua hơn 10 sản phẩm để được nhận thêm ưu đãi)");
                    $('#modal-notification-success').modal('show');
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                if (so_luong < 10) {
                    so_luong += 1;
                    $('#input-quantity-product-id').val(so_luong);
                    //lấy giá tiền để tính toán khi tăng giảm số lượng
                    var gia = parseInt($('#input-gia-not-format').val());
                    gia = gia * so_luong;

                    //gán giá đã xử lý cho input_database
                    // $('#input-gia-donhang').val(gia);

                    //chuyển giá thành chuỗi để định dạng
                    gia = gia.toString();
                    gia = format_number(gia);
                    $('#thanh-tien').html(gia);
                    $('#tong-tien').html(gia);
                }
            }
        })
    })

    //nhập input tăng giảm số lượng
    $('#input-quantity-product-id').on('keyup', function () {
        var id_sp = $('#input-id-sp').val();
        var so_luong = $(this).val();

        if (isNaN(so_luong) || so_luong == "" || parseInt(so_luong) <= 0) {
            //nếu mà input so luong nhập rỗng or ko phải số thì khi click ra ngoài input thì sẽ value sẽ gán thành 1
            $(document).on('click', function (e) {
                if (e.target.id != '#input-quantity-product-id') {
                    var value = $('#input-quantity-product-id').val();
                    if (value == "" || isNaN(value) || parseInt(value) <= 0) {
                        location.reload();
                    }
                }
            })

        } else {
            so_luong = parseInt(so_luong);
            $.post("function/function_cart_management.php", { send_check_quantity_id_sp: id_sp }, function (result_so_luong) {
                if (so_luong > result_so_luong) {
                    $('#notification-content-fail').html("Bạn đã nhập quá số lượng sản có trong cửa hàng <br/> (Cửa hàng chỉ còn " + result_so_luong + " sản phẩm)");
                    $('#modal-notification-fail').modal('show');
                    $('#modal-notification-fail').click(function () {
                        location.reload();
                    })

                } else {
                    if (so_luong != "") {
                        if (so_luong < 1) {
                            location.reload();

                        } else if (so_luong > 10) {
                            $('#notification-content-success').html("Bạn đã nhập hơn 10 sản phẩm <br/> (Vui lòng liên hệ với chúng tôi nếu mua hơn 10 sản phẩm để được nhận thêm ưu đãi)");
                            $('#modal-notification-success').modal('show');
                            $('#modal-notification-success').click(function () {
                                location.reload();
                            })

                        } else {
                            so_luong = parseInt(so_luong);
                            //lấy giá tiền để tính toán khi tăng giảm số lượng
                            var gia = parseInt($('#input-gia-not-format').val());
                            gia = gia * so_luong;

                            //gán giá đã xử lý cho input_database
                            // $('#input-gia-donhang').val(gia);

                            //chuyển giá thành chuỗi để định dạng
                            gia = gia.toString();
                            gia = format_number(gia);
                            $('#thanh-tien').html(gia);
                            $('#tong-tien').html(gia);
                        }
                    }
                }
            })
        }
    })


    /*********************************************** Kiểm tra thông tin khách hàng trước khi nhấn nút MUA ***********************************************/
    $('#order_ten').on('keyup', function () {
        if (check_string_modal(this, '#order_ten_help', "Họ tên không được nhập số", "#btn-order") == true) {
            check_max_min(this, 30, 5, '#order_ten_help', "Họ tên từ 5-30 ký tự", "#btn-order");
        }
    })

    $('#order_ghi_chu').on('keyup', function () {
        check_max_min(this, 100, 0, '#order_ghi_chu_help', "Vui nhập dưới 100 ký tự", "#btn-order");
    })

    $('#order_sdt').on('keyup', function () {
        if (check_sdt(this, '#order_sdt_help', "#btn-order") == true) {
            check_max_min(this, 10, 10, '#order_sdt_help', "Số điện thoại gồm 10 số bắt đầu bằng số 0", "#btn-order");
        }
    })

    $('#btn-order').on('click', function () {
        var order_via = $(this).val();
        var id_kh = $('#order_id_khachhang').val();
        var nguoi_nhan = $('#order_ten').val();
        var sdt = $('#order_sdt').val();
        var dia_chi_giao = $('#order_dia_chi').val();
        var ghi_chu = $('#order_ghi_chu').val();


        var errors = "";
        if (check_string_modal('#order_ten', '#order_ten_help', "Họ tên không được nhập số", "#btn-order") == false) {
            errors = "fail";
            $('#notification-content-fail').html("Họ tên không được nhập số");
            $('#modal-notification-fail').modal('show');

        }else if(check_max_min('#order_ten', 30, 5, '#order_ten_help', "Họ Tên từ 5-30 ký tự", "#btn-order") == false){
            errors = "fail";
            $('#notification-content-fail').html("Họ Tên từ 5-30 ký tự");
            $('#modal-notification-fail').modal('show');

        }else if(check_max_min('#order_ghi_chu', 100, 0, '#order_ghi_chu_help', "Vui nhập dưới 100 ký tự", "#btn-order") == false){
            errors = "fail";
            $('#notification-content-fail').html("Vui nhập dưới 100 ký tự");
            $('#modal-notification-fail').modal('show');

        }else if(check_sdt('#order_sdt', '#order_sdt_help', "#btn-order") == false){
            errors = "fail";
            $('#notification-content-fail').html("Vui lòng kiểm tra lại số điện thoại");
            $('#modal-notification-fail').modal('show');

        }else if(check_max_min('#order_sdt', 10, 10, '#order_sdt_help', "Số điện thoại gồm 10 số bắt đầu bằng số 0", "#btn-order") == false){
            errors = "fail";
            $('#notification-content-fail').html("Số điện thoại gồm 10 số bắt đầu bằng số 0");
            $('#modal-notification-fail').modal('show');
        }

        //neu loi thi ko cho thuc hien
        if (errors == "") {
            //nếu đặt thông qua GIỎ HÀNG thì thực hiện if ngược lại đặt thông qua sản phẩm thì làm else
            if (order_via == "order_cart") {
                if (id_kh == "" || nguoi_nhan == "" || sdt == "" || dia_chi_giao == "") {
                    $('#notification-content-fail').html("Bạn Chưa Nhập Đủ Thông Tin");
                    $('#modal-notification-fail').modal('show');
                } else {
                    $.post("function/function_order_management.php",
                        { send_order_cart_id_kh: id_kh, send_order_cart_nguoi_nhan: nguoi_nhan, send_order_cart_sdt: sdt, send_order_cart_dia_chi_giao: dia_chi_giao, send_order_cart_ghi_chu: ghi_chu },
                        function (result_order) {
                            if (result_order != "fail") {
                                $('#notification-content-success').html("Đặt Hàng Thành Công");
                                var button = '<a href="index.php" class="btn btn-primary btn-sm mr-1">Tiếp tục mua hàng</a>' +
                                    '<a href="order_detail.php?id_dh=' + result_order + '" class="btn btn-success btn-sm">Xem chi tiết đơn hàng</a>';
                                $('.modal-footer').html(button);
                                $('#modal-notification-success').modal('show');
                                $('#modal-notification-success').click(function () {
                                    window.location.href = "index.php";
                                })
                            }
                            else {
                                $('#notification-content-fail').html("Đặt hàng thất bại");
                                $('#modal-notification-fail').modal('show');
                            }
                        })
                }
            }
            //mua bằng nút MUA thẳng sản phẩm  
            else if (order_via == "order_product") {
                var id_sp = $('#input-id-sp').val();
                var so_luong = $('#input-quantity-product-id').val();

                if (id_kh == "" || nguoi_nhan == "" || sdt == "" || dia_chi_giao == "" || id_sp == "" || so_luong == "") {
                    $('#notification-content-fail').html("Bạn Chưa Nhập Đủ Thông Tin");
                    $('#modal-notification-fail').modal('show');
                } else {
                    $.post("function/function_order_management.php",
                        { send_order_id_kh: id_kh, send_order_nguoi_nhan: nguoi_nhan, send_order_sdt: sdt, send_order_dia_chi_giao: dia_chi_giao, send_order_ghi_chu: ghi_chu, send_order_id_sp: id_sp, send_order_so_luong: so_luong },
                        function (result_order) {
                            if (result_order != "fail") {
                                $('#notification-content-success').html("Đặt Hàng Thành Công");
                                var button = '<a href="index.php" class="btn btn-primary btn-sm mr-1">Tiếp tục mua hàng</a>' +
                                    '<a href="order_detail.php?id_dh=' + result_order + '" class="btn btn-success btn-sm">Xem chi tiết đơn hàng</a>';
                                $('.modal-footer').html(button);
                                $('#modal-notification-success').modal('show');
                                $('#modal-notification-success').click(function () {
                                    window.location.href = "index.php";
                                })
                            }
                            else {
                                $('#notification-content-fail').html("Đặt hàng thất bại");
                                $('#modal-notification-fail').modal('show');
                            }
                        })
                }
            }
        }
    })



})