$.getScript("javascript/javascript-function.js", function () { })

$(function () {
    /******************************************************** tăng giảm sản phẩm trong giỏ hàng ********************************************************/
    //nút giảm sản phẩm trong giỏ hàng
    $(document).on('click', 'button[name=btn-minus]', function () {
        var id_sp = $(this).val();
        //tìm thẻ input chứ số lượng sản phẩm để lấy số lượng sản phẩm trong giỏ hàng
        var so_luong = $('#input_so_luong_' + id_sp).val();
        so_luong = parseInt(so_luong);
        if (so_luong > 1) {
            so_luong -= 1;
            $.post("function/function_cart_management.php", { send_up_down_product_id_sp: id_sp, send_up_down_product_so_luong: so_luong }, function (result) {
                if (result == "success") {
                    $("#table-cart").load(" #table-cart");

                } else {
                    $("#table-cart").load(" #table-cart");

                }
            })
        }
    })

    //nút tăng sản phẩm trong giỏ hàng
    $(document).on('click', 'button[name=btn-plus]', function () {
        var id_sp = $(this).val();
        //tìm thẻ input chứ số lượng sản phẩm để lấy số lượng sản phẩm trong giỏ hàng
        var so_luong = $('#input_so_luong_' + id_sp).val();
        so_luong = parseInt(so_luong);
        so_luong += 1;

        if (so_luong > 10) {
            $('#notification-content-fail').html("Chỉ cho phép nhập từ 1-10 <br/>(Nếu bạn mua trên 10 sản phẩm <br/>vui lòng liên hệ cho chúng tôi để có thêm nhiều ưu đãi)");
            $('#modal-notification-fail').modal('show');

        } else {
            $.post("function/function_cart_management.php", { send_check_quantity_id_sp: id_sp }, function (result_check) {
                if (so_luong > result_check) {
                    $('#notification-content-fail').html("Hiện tại cửa hàng chỉ còn " + result_check + " sản phẩm");
                    $('#modal-notification-fail').modal('show');
                    $(document).on('click', '#modal-notification-fail', function () {
                        $("#table-cart").load(" #table-cart");
                    })

                } else {
                    $.post("function/function_cart_management.php", { send_up_down_product_id_sp: id_sp, send_up_down_product_so_luong: so_luong }, function (result) {
                        if (result == "success") {
                            $("#table-cart").load(" #table-cart");

                        } else {
                            $("#table-cart").load(" #table-cart");

                        }
                    })
                }
            })
        }
    })

    //input nhập số lượng sản phẩm
    $(document).on('keyup', 'input[data-item-id = input_so_luong]', function () {
        var id_sp = $(this).data('tab');
        var so_luong = $(this).val();

        if (so_luong == "" || isNaN(so_luong)) {
            // nếu mà input so luong nhập rỗng thì khi click ra ngoài input thì sẽ value sẽ gán thành 1
            $(document).on('click', function (e) {
                if (e.target.id != '#input_so_luong_' + id_sp) {
                    var value = $('#input_so_luong_' + id_sp).val();
                    if (value == "" || isNaN(value)) {
                        $("#table-cart").load(" #table-cart");
                    }
                }
            })

        } else if (parseInt(so_luong) > 10 || parseInt(so_luong) <= 0) {
            $("#table-cart").load(" #table-cart");
            $('#notification-content-fail').html("Chỉ cho phép nhập từ 1-10 <br/>(Nếu bạn mua trên 10 sản phẩm <br/>vui lòng liên hệ cho chúng tôi để có thêm nhiều ưu đãi)");
            $('#modal-notification-fail').modal('show');

        } else {
            so_luong = parseInt(so_luong);
            $.post("function/function_cart_management.php", { send_check_quantity_id_sp: id_sp }, function (result_check) {
                if (so_luong > result_check) {
                    $('#notification-content-fail').html("Hiện tại cửa hàng chỉ còn " + result_check + " sản phẩm");
                    $('#modal-notification-fail').modal('show');
                    $(document).on('click', '#modal-notification-fail', function () {
                        $("#table-cart").load(" #table-cart");
                    })

                } else {
                    $.post("function/function_cart_management.php", { send_up_down_product_id_sp: id_sp, send_up_down_product_so_luong: so_luong }, function (result) {
                        if (result == "success") {
                            $("#table-cart").load(" #table-cart");

                        } else {
                            $("#table-cart").load(" #table-cart");

                        }
                    })
                }
            })
        }
    })


    /******************************************************** thêm sản phẩm vào giỏ hàng ********************************************************/
    $('#btn-add-cart').on('click', function () {
        var id_sp = $(this).val();
        var user = $('#insert_cart_user').val();

        //nếu chưa đăng nhập thì mời đăng nhập
        if (user == "") {
            $('#modal-login').modal('show');
        } else {
            $.post("function/function_cart_management.php", { send_insert_cart_id_sp: id_sp }, function (result_cart) {

                if (result_cart == "success") {
                    $('#notification-content-success').html("Thêm Vào Giỏ Hàng Thành Công");
                    var button = '<a href="index.php" class="btn btn-success btn-sm">Tiếp tục mua hàng</a><a href="cart.php" class="btn btn-primary btn-sm">Đi đến giỏ hàng</a>';
                    $('.modal-footer').html(button);
                    $('#modal-notification-success').modal('show');

                } else if (result_cart == "exist") {
                    $('#notification-content-success').html("Sản Phẩm Đã Có Trong Giỏ Hàng");
                    var button = '<a href="index.php" class="btn btn-success btn-sm">Tiếp tục mua hàng</a><a href="cart.php" class="btn btn-primary btn-sm">Đi đến giỏ hàng</a>';
                    $('.modal-footer').html(button);
                    $('#modal-notification-success').modal('show');

                } else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').html("Không Thể Thêm Vào Giỏ Hàng");

                    //hiển thị thông báo LỖI khi chưa nhập dữ liệu
                    $('#modal-notification-fail').modal('show');
                }

            })
        }

    })


    /******************************************************** Xóa sản phẩm vào giỏ hàng ********************************************************/
    $(document).on('click', 'button[name = btn-delete-cart]', function () {
        var id_sp = $(this).val();
        $.post("function/function_cart_management.php", { send_delete_cart_id_sp: id_sp }, function (result_cart) {
            if (result_cart == "success") {
                $('#table-cart').load(" #table-cart");
            } else {
                $('#notification-content-fail').text("Xóa Thất Bại, Bạn Hãy Thử Lại");
                $('#modal-notification-fail').modal('show');
            }
        })
    })


})
