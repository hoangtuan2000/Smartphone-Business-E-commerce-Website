$(function () {
    /************************************************* button show MODAL DON HANG *************************************************/
    $('button[name = btn-modal-show-donhang]').on('click', function () {
        var id_dh = $(this).val();
        $.post("function/function_order_management.php", { send_show_donhang_id: id_dh }, function (result_show_donhang) {
            $('#modal-content-donhang').html(result_show_donhang);
            $('#modal-show-donhang').modal('show');
        })
    })

    /************************************************* UPDATE Trạng Thái Đơn Hàng *************************************************/

    //update đơn hàng trong bảng tất cả đơn hàng
    $('button[name = update_donhang_all]').on('click', function () {
        var id_nv = $('#id_nv').val();
        var id_dh = $(this).val();
        var id_ttdh = $('select[name = update_donhang_all_' + id_dh + ']').val();

        $.post("function/function_order_management.php", { send_update_donhang_id: id_dh, send_update_donhang_id_ttdh: id_ttdh, send_update_donhang_id_nv: id_nv }, function (result_update_donhang) {
            if (result_update_donhang == "success") {
                $('#notification-content-success').text("Cập Nhật Đơn Hàng Thành Công");
                $('#modal-notification-success').modal('show');
                $('#modal-notification-success').click(function () {
                    location.reload();
                })
            } else {
                $('#notification-content-fail').text("Cập Nhật Đơn Hàng Thất Bại");
                $('#modal-notification-fail').modal('show');
                $('#modal-notification-fail').click(function () {
                    location.reload();
                })
            }
        })
    })

    //update đơn hàng chưa xử lý
    $('button[name = update_donhang_chuaxuly]').on('click', function () {
        var id_nv = $('#id_nv').val();
        var id_dh = $(this).val();
        var id_ttdh = $('select[name = update_donhang_chuaxuly_' + id_dh + ']').val();

        $.post("function/function_order_management.php", { send_update_donhang_id: id_dh, send_update_donhang_id_ttdh: id_ttdh, send_update_donhang_id_nv: id_nv }, function (result_update_donhang) {
            if (result_update_donhang == "success") {
                $('#notification-content-success').text("Cập Nhật Đơn Hàng Thành Công");
                $('#modal-notification-success').modal('show');
                $('#modal-notification-success').click(function () {
                    location.reload();
                })
            } else {
                $('#notification-content-fail').text("Cập Nhật Đơn Hàng Thất Bại");
                $('#modal-notification-fail').modal('show');
                $('#modal-notification-fail').click(function () {
                    location.reload();
                })
            }
        })
    })

    //update đơn hàng đã xử lý
    $('button[name = update_donhang_daxuly]').on('click', function () {
        var id_nv = $('#id_nv').val();
        var id_dh = $(this).val();
        var id_ttdh = $('select[name = update_donhang_daxuly_' + id_dh + ']').val();

        $.post("function/function_order_management.php", { send_update_donhang_id: id_dh, send_update_donhang_id_ttdh: id_ttdh, send_update_donhang_id_nv: id_nv }, function (result_update_donhang) {
            if (result_update_donhang == "success") {
                $('#notification-content-success').text("Cập Nhật Đơn Hàng Thành Công");
                $('#modal-notification-success').modal('show');
                $('#modal-notification-success').click(function () {
                    location.reload();
                })
            } else {
                $('#notification-content-fail').text("Cập Nhật Đơn Hàng Thất Bại");
                $('#modal-notification-fail').modal('show');
                $('#modal-notification-fail').click(function () {
                    location.reload();
                })
            }
        })
    })

    //update đơn hàng đang vận chuyển
    $('button[name = update_donhang_dangvanchuyen]').on('click', function () {
        var id_nv = $('#id_nv').val();
        var id_dh = $(this).val();
        var id_ttdh = $('select[name = update_donhang_dangvanchuyen_' + id_dh + ']').val();

        $.post("function/function_order_management.php", { send_update_donhang_id: id_dh, send_update_donhang_id_ttdh: id_ttdh, send_update_donhang_id_nv: id_nv }, function (result_update_donhang) {
            if (result_update_donhang == "success") {
                $('#notification-content-success').text("Cập Nhật Đơn Hàng Thành Công");
                $('#modal-notification-success').modal('show');
                $('#modal-notification-success').click(function () {
                    location.reload();
                })
            } else {
                $('#notification-content-fail').text("Cập Nhật Đơn Hàng Thất Bại");
                $('#modal-notification-fail').modal('show');
                $('#modal-notification-fail').click(function () {
                    location.reload();
                })
            }
        })
    })

    //update đơn hàng đang giao hàng
    $('button[name = update_donhang_danggiaohang]').on('click', function () {
        var id_nv = $('#id_nv').val();
        var id_dh = $(this).val();
        var id_ttdh = $('select[name = update_donhang_danggiaohang_' + id_dh + ']').val();

        $.post("function/function_order_management.php", { send_update_donhang_id: id_dh, send_update_donhang_id_ttdh: id_ttdh, send_update_donhang_id_nv: id_nv }, function (result_update_donhang) {
            if (result_update_donhang == "success") {
                $('#notification-content-success').text("Cập Nhật Đơn Hàng Thành Công");
                $('#modal-notification-success').modal('show');
                $('#modal-notification-success').click(function () {
                    location.reload();
                })
            } else {
                $('#notification-content-fail').text("Cập Nhật Đơn Hàng Thất Bại");
                $('#modal-notification-fail').modal('show');
                $('#modal-notification-fail').click(function () {
                    location.reload();
                })
            }
        })
    })

    //update đơn hàng giao thành công
    $('button[name = update_donhang_giaothanhcong]').on('click', function () {
        var id_nv = $('#id_nv').val();
        var id_dh = $(this).val();
        var id_ttdh = $('select[name = update_donhang_giaothanhcong_' + id_dh + ']').val();

        $.post("function/function_order_management.php", { send_update_donhang_id: id_dh, send_update_donhang_id_ttdh: id_ttdh, send_update_donhang_id_nv: id_nv }, function (result_update_donhang) {
            if (result_update_donhang == "success") {
                $('#notification-content-success').text("Cập Nhật Đơn Hàng Thành Công");
                $('#modal-notification-success').modal('show');
                $('#modal-notification-success').click(function () {
                    location.reload();
                })
            } else {
                $('#notification-content-fail').text("Cập Nhật Đơn Hàng Thất Bại");
                $('#modal-notification-fail').modal('show');
                $('#modal-notification-fail').click(function () {
                    location.reload();
                })
            }
        })
    })
})