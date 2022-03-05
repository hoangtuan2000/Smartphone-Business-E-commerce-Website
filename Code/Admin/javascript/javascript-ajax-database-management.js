$.getScript("javascript/javascript-function.js", function () { })


$(function () {
    /***************************************       Database BONHO     ***************************************/
    //////////// ajax cập nhật database BỘ NHỚ  
    $('button[name = btn-update-bonho]').click(function () {
        var update_id_bn_old = $(this).val();
        var update_id_bn_new = $('#update_id_bn_' + update_id_bn_old).val();
        var update_dung_luong_bn_new = $('#update_dung_luong_bn_' + update_id_bn_old).val();

        //kiểm tra nội dung trước khi cập nhật
        //nếu chưa nhập nội dung thì không cập nhật
        if (update_id_bn_old == "" || update_id_bn_new == "" || update_dung_luong_bn_new == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');

        }
        else if (isNaN(update_id_bn_new)) {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Mã Bộ Nhớ Phải Là Số");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_update_id_bn_new: update_id_bn_new, send_update_dung_luong_bn_new: update_dung_luong_bn_new, send_update_id_bn_old: update_id_bn_old }, function (update_result) {
                if (update_result == "success") {
                    //neu cap nhat thanh cong thi doi id vs value cua input id_bonho thanh gia tri moi
                    $('#update_id_bn_' + update_id_bn_old).attr("value", update_id_bn_new);
                    $('#update_id_bn_' + update_id_bn_old).attr("id", "update_id_bn_" + update_id_bn_new);

                    //neu cap nhat thanh cong thi doi id vs value cua input dung_luong_bonho thanh gia tri moi
                    $('#update_dung_luong_bn_' + update_id_bn_old).attr("value", update_dung_luong_bn_new);
                    $('#update_dung_luong_bn_' + update_id_bn_old).attr("id", "update_dung_luong_bn_" + update_id_bn_new);

                    //neu cap nhat thanh cong thi doi value cua nut button cap nhat thanh value moi
                    var btn = "button[value=\"" + update_id_bn_old + "\"]";
                    $(btn).attr("value", update_id_bn_new);

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Cập Nhật Bộ Nhớ Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Mã Hoặc Tên Bộ Nhớ");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })

        }

    })

    /////////// hiện modal chấp nhận xóa BỘ NHỚ
    $('button[name = btn-delete-bonho]').click(function () {
        var id_bn = $(this).val();

        var button = '<button id="modal-btn-delete-bonho" value="' + id_bn + '" class="btn btn-danger btn-sm">Xóa</button><button data-dismiss="modal" class="btn btn-secondary btn-sm w-50">Hủy</button>';

        $('#modal-content-delete').html(button);
        $('#modal-notification-delete').modal('show');

        //sau đó nếu nhấn nút xóa thì gửi qua php để xử lý
        $('#modal-btn-delete-bonho').click(function () {
            //khi click xóa thì ẩn modal chấp nhận xóa đi
            $('#modal-notification-delete').modal('hide');

            var delete_id_bn = $('#modal-btn-delete-bonho').val();

            $.post("function/function_database_management.php", { send_delete_id_bn: delete_id_bn }, function (delete_result) {
                if (delete_result == "success") {
                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Xóa Bộ Nhớ Thành Công");

                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Xóa Bộ Nhớ Thất Bại");

                    $('#modal-notification-fail').modal('show');
                }
            })
        })
    })


    //////////////// ajax thêm database BỘ NHỚ
    $('#btn-insert-bonho').on('click', function () {
        var insert_id_bn = $('#insert_id_bonho').val();
        var insert_dung_luong_bn = $('#insert_dung_luong_bonho').val();

        //kiểm tra nội dung trước khi thêm database bộ nhớ
        if (insert_id_bn == "" || insert_dung_luong_bn == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else if (isNaN(insert_id_bn)) {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Mã Bộ Nhớ Phải Là Số");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_insert_id_bn: insert_id_bn, send_insert_dung_luong_bn: insert_dung_luong_bn }, function (insert_result) {
                if (insert_result == "success") {
                    //xóa text trong input lúc nhập
                    $('#insert_id_bonho').val("");
                    $('#insert_dung_luong_bonho').val("");

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Thêm Bộ Nhớ Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Mã Hoặc Tên Bộ Nhớ");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })
        }
    })



    /***************************************       Database CHIP     ***************************************/
    /////////// ajax cập nhật database CHIP
    $('button[name = btn-update-chip]').click(function () {
        var update_id_chip = $(this).val().toUpperCase();
        var update_ten_chip_new = $('#update_ten_chip_' + update_id_chip).val();

        //kiểm tra nội dung trước khi cập nhật (chưa nhập nội dung sẽ báo lỗi)
        if (update_id_chip == "" || update_ten_chip_new == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');

        }
        else {
            $.post("function/function_database_management.php", { send_update_ten_chip_new: update_ten_chip_new, send_update_id_chip: update_id_chip }, function (update_result) {
                if (update_result == "success") {
                    //neu cap nhat thanh cong thi doi id vs value cua input ten_chip thanh gia tri moi
                    $('#update_ten_chip_' + update_id_chip).attr("value", update_ten_chip_new);

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Cập Nhật Chip Xử Lý Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Mã Hoặc Tên Chip Xử Lý");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })

        }

    })

    /////////// hiện modal chấp nhận xóa CHIP
    $('button[name = btn-delete-chip]').click(function () {
        var id_chip = $(this).val();

        var button = '<button id="modal-btn-delete-chip" value="' + id_chip + '" class="btn btn-danger btn-sm">Xóa</button><button data-dismiss="modal" class="btn btn-secondary btn-sm w-50">Hủy</button>';

        $('#modal-content-delete').html(button);
        $('#modal-notification-delete').modal('show');

        //sau đó nếu nhấn nút xóa thì gửi qua php để xử lý
        $('#modal-btn-delete-chip').click(function () {
            //khi click xóa thì ẩn modal chấp nhận xóa đi
            $('#modal-notification-delete').modal('hide');

            var delete_id_chip = $('#modal-btn-delete-chip').val();

            $.post("function/function_database_management.php", { send_delete_id_chip: delete_id_chip }, function (delete_result) {
                if (delete_result == "success") {
                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Xóa Chip Xử Lý Thành Công");

                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Xóa Chip Xử Lý Thất Bại");

                    $('#modal-notification-fail').modal('show');
                }
            })
        })
    })

    //////////// ajax thêm database CHIP
    $('#btn-insert-chip').on('click', function () {
        var insert_ten_chip = $('#insert_ten_chip').val();

        //kiểm tra nội dung trước khi thêm database chip
        if (insert_ten_chip == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_insert_ten_chip: insert_ten_chip }, function (insert_result) {
                if (insert_result == "success") {
                    //xóa text trong input lúc nhập
                    $('#insert_ten_chip').val("");

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Thêm Chip Xử Lý Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Tên Chip Xử Lý");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })
        }
    })



    /***************************************       Database KHUYEN MAI     ***************************************/
    /////////// ajax cập nhật database KHUYEN MAI
    $('button[name = btn-update-km]').click(function () {
        var update_id_km = $(this).val().toUpperCase();
        var update_giam_km_new = $('#update_giam_km_' + update_id_km).val();

        //kiểm tra nội dung trước khi cập nhật (chưa nhập nội dung sẽ báo lỗi)
        if (update_id_km == "" || update_giam_km_new == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');

        }
        else if (isNaN(update_giam_km_new)) {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! khuyến mãi phải là số");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else if (update_giam_km_new.length > 2) {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! khuyến mãi chỉ được nhập 2 ký tự");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_update_giam_km_new: update_giam_km_new, send_update_id_km: update_id_km }, function (update_result) {
                if (update_result == "success") {
                    //neu cap nhat thanh cong thi doi id vs value cua input giam_km thanh gia tri moi
                    $('#update_giam_km_' + update_id_km).attr("value", update_giam_km_new);

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Cập Nhật Khuyến Mãi Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Khuyến Mãi");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })

        }

    })

    /////////// hiện modal chấp nhận xóa KHUYEN MAI
    $('button[name = btn-delete-km]').click(function () {
        var id_km = $(this).val();

        var button = '<button id="modal-btn-delete-km" value="' + id_km + '" class="btn btn-danger btn-sm">Xóa</button><button data-dismiss="modal" class="btn btn-secondary btn-sm w-50">Hủy</button>';

        $('#modal-content-delete').html(button);
        $('#modal-notification-delete').modal('show');

        //sau đó nếu nhấn nút xóa thì gửi qua php để xử lý
        $('#modal-btn-delete-km').click(function () {
            //khi click xóa thì ẩn modal chấp nhận xóa đi
            $('#modal-notification-delete').modal('hide');

            var delete_id_km = $('#modal-btn-delete-km').val();

            $.post("function/function_database_management.php", { send_delete_id_km: delete_id_km }, function (delete_result) {
                if (delete_result == "success") {
                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Xóa Khuyến Mãi Thành Công");

                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Xóa Khuyến Mãi Thất Bại");

                    $('#modal-notification-fail').modal('show');
                }
            })
        })
    })

    //////////// ajax thêm database KHUYEN MAI
    $('#btn-insert-km').on('click', function () {
        var insert_giam_km = $('#insert_giam_km').val();

        //kiểm tra nội dung trước khi thêm database km
        if (insert_giam_km == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else if (isNaN(insert_giam_km)) {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Khuyến mãi phải là số");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else if (insert_giam_km.length > 2) {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! khuyến mãi chỉ được nhập 2 ký tự");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_insert_giam_km: insert_giam_km }, function (insert_result) {
                if (insert_result == "success") {
                    //xóa text trong input lúc nhập
                    $('#insert_giam_km').val("");

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Thêm Khuyến Mãi Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Khuyến Mãi");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })
        }
    })

    
    /***************************************       Database HE-DIEU-HANH     ***************************************/
    /////////// ajax cập nhật database HE-DIEU-HANH
    $('button[name = btn-update-hdh]').click(function () {
        var update_id_hdh_old = $(this).val().toUpperCase();
        var update_ten_hdh_new = $('#update_ten_hdh_' + update_id_hdh_old).val();


        //kiểm tra nội dung trước khi cập nhật (chưa nhập nội dung sẽ báo lỗi)
        if (update_id_hdh_old == "" || update_ten_hdh_new == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');

        }
        else {
            $.post("function/function_database_management.php", { send_update_ten_hdh_new: update_ten_hdh_new, send_update_id_hdh_old: update_id_hdh_old }, function (update_result) {
                if (update_result == "success") {
                    //neu cap nhat thanh cong thi doi id vs value cua input ten_hdh thanh gia tri moi
                    $('#update_ten_hdh_' + update_id_hdh_old).attr("value", update_ten_hdh_new);
                    $('#update_ten_hdh_' + update_id_hdh_old).attr("id", "update_ten_hdh_" + update_id_hdh_old);

                    //neu cap nhat thanh cong thi doi value cua nut button cap nhat thanh value moi
                    var btn = "button[value=\"" + update_id_hdh_old + "\"]";
                    $(btn).attr("value", update_id_hdh_old);

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Cập Nhật Hệ Điều Hành Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Mã Hoặc Tên Hệ Điều Hành");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })

        }

    })

    /////////// hiện modal chấp nhận xóa HE DIEU HANH
    $('button[name = btn-delete-hdh]').click(function () {
        var id_hdh = $(this).val();

        var button = '<button id="modal-btn-delete-hdh" value="' + id_hdh + '" class="btn btn-danger btn-sm">Xóa</button><button data-dismiss="modal" class="btn btn-secondary btn-sm w-50">Hủy</button>';

        $('#modal-content-delete').html(button);
        $('#modal-notification-delete').modal('show');

        //sau đó nếu nhấn nút xóa thì gửi qua php để xử lý
        $('#modal-btn-delete-hdh').click(function () {
            //khi click xóa thì ẩn modal chấp nhận xóa đi
            $('#modal-notification-delete').modal('hide');

            var delete_id_hdh = $('#modal-btn-delete-hdh').val();

            $.post("function/function_database_management.php", { send_delete_id_hdh: delete_id_hdh }, function (delete_result) {
                if (delete_result == "success") {
                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Xóa Hệ Điều Hành Thành Công");

                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Xóa Hệ Điều Hành Thất Bại");

                    $('#modal-notification-fail').modal('show');
                }
            })
        })
    })

    //////////// ajax thêm database HE-DIEU-HANH
    $('#btn-insert-hdh').on('click', function () {
        var insert_ten_hdh = $('#insert_ten_hdh').val();

        //kiểm tra nội dung trước khi thêm database hdh
        if (insert_ten_hdh == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_insert_ten_hdh: insert_ten_hdh }, function (insert_result) {
                if (insert_result == "success") {
                    //xóa text trong input lúc nhập
                    $('#insert_ten_hdh').val("");

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Thêm Hệ Điều Hành Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Tên Hệ Điều Hành");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })
        }
    })



    /***************************************       Database Man-Hinh     ***************************************/
    /////////// ajax cập nhật database Man-Hinh
    $('button[name = btn-update-mh]').click(function () {
        var update_id_mh_old = $(this).val();
        var update_kich_thuoc_mh_new = $('#update_kich_thuoc_mh_' + update_id_mh_old).val();

        //kiểm tra nội dung trước khi cập nhật (chưa nhập nội dung sẽ báo lỗi)
        if (update_id_mh_old == "" || update_kich_thuoc_mh_new == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');

        }
        else if (isNaN(update_id_mh_old)) {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Mã Kích Thước Màn Hình Phải Là Số");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_update_kich_thuoc_mh_new: update_kich_thuoc_mh_new, send_update_id_mh_old: update_id_mh_old }, function (update_result) {
                if (update_result == "success") {
                    //neu cap nhat thanh cong thi doi id vs value cua input kich_thuoc_mh thanh gia tri moi
                    $('#update_kich_thuoc_mh_' + update_id_mh_old).attr("value", update_kich_thuoc_mh_new);

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Cập Nhật Kích Thước Màn Hình Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Mã Hoặc Tên Kích Thước Màn Hình");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })

        }

    })

    /////////// hiện modal chấp nhận xóa MAN HINH
    $('button[name = btn-delete-mh]').click(function () {
        var id_mh = $(this).val();

        var button = '<button id="modal-btn-delete-mh" value="' + id_mh + '" class="btn btn-danger btn-sm">Xóa</button><button data-dismiss="modal" class="btn btn-secondary btn-sm w-50">Hủy</button>';

        $('#modal-content-delete').html(button);
        $('#modal-notification-delete').modal('show');

        //sau đó nếu nhấn nút xóa thì gửi qua php để xử lý
        $('#modal-btn-delete-mh').click(function () {
            //khi click xóa thì ẩn modal chấp nhận xóa đi
            $('#modal-notification-delete').modal('hide');

            var delete_id_mh = $('#modal-btn-delete-mh').val();

            $.post("function/function_database_management.php", { send_delete_id_mh: delete_id_mh }, function (delete_result) {
                if (delete_result == "success") {
                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Xóa Kích Thước Màn Hình Thành Công");

                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Xóa Kích Thước Màn Hình Thất Bại");

                    $('#modal-notification-fail').modal('show');
                }
            })
        })
    })

    //////////// ajax thêm database Man-Hinh
    $('#btn-insert-mh').on('click', function () {
        var insert_kich_thuoc_mh = $('#insert_kich_thuoc_mh').val();

        //kiểm tra nội dung trước khi thêm database mh
        if (insert_kich_thuoc_mh == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_insert_kich_thuoc_mh: insert_kich_thuoc_mh }, function (insert_result) {
                if (insert_result == "success") {
                    //xóa text trong input lúc nhập
                    $('#insert_kich_thuoc_mh').val("");

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Thêm Kích Thước Màn Hình Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Kích Thước Màn Hình");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })
        }


    })



    /***************************************       Database RAM     ***************************************/
    /////////// ajax cập nhật database RAM
    $('button[name = btn-update-ram]').click(function () {
        var update_id_ram_old = $(this).val();
        var update_dung_luong_ram_new = $('#update_dung_luong_ram_' + update_id_ram_old).val();

        //kiểm tra nội dung trước khi cập nhật (chưa nhập nội dung sẽ báo lỗi)
        if (update_id_ram_old == "" || update_dung_luong_ram_new == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');

        }
        else if (isNaN(update_id_ram_old)) {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Mã RAM Phải Là Số");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_update_dung_luong_ram_new: update_dung_luong_ram_new, send_update_id_ram_old: update_id_ram_old }, function (update_result) {
                if (update_result == "success") {

                    //neu cap nhat thanh cong thi doi id vs value cua input dung_luong_ram thanh gia tri moi
                    $('#update_dung_luong_ram_' + update_id_ram_old).attr("value", update_dung_luong_ram_new);

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Cập Nhật RAM Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Mã Hoặc Tên RAM");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })

        }

    })

    /////////// hiện modal chấp nhận xóa RAM
    $('button[name = btn-delete-ram]').click(function () {
        var id_ram = $(this).val();

        var button = '<button id="modal-btn-delete-ram" value="' + id_ram + '" class="btn btn-danger btn-sm">Xóa</button><button data-dismiss="modal" class="btn btn-secondary btn-sm w-50">Hủy</button>';

        $('#modal-content-delete').html(button);
        $('#modal-notification-delete').modal('show');

        //sau đó nếu nhấn nút xóa thì gửi qua php để xử lý
        $('#modal-btn-delete-ram').click(function () {
            //khi click xóa thì ẩn modal chấp nhận xóa đi
            $('#modal-notification-delete').modal('hide');

            var delete_id_ram = $('#modal-btn-delete-ram').val();

            $.post("function/function_database_management.php", { send_delete_id_ram: delete_id_ram }, function (delete_result) {
                if (delete_result == "success") {
                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Xóa RAM Thành Công");

                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Xóa RAM Thất Bại");

                    $('#modal-notification-fail').modal('show');
                }
            })
        })
    })

    //////////// ajax thêm database RAM
    $('#btn-insert-ram').on('click', function () {
        var insert_dung_luong_ram = $('#insert_dung_luong_ram').val();

        //kiểm tra nội dung trước khi thêm database ram
        if (insert_dung_luong_ram == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_insert_dung_luong_ram: insert_dung_luong_ram }, function (insert_result) {
                if (insert_result == "success") {
                    //xóa text trong input lúc nhập
                    $('#insert_dung_luong_ram').val("");

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Thêm RAM Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Tên RAM");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })
        }


    })


    /***************************************       Database Thiet-Ke     ***************************************/
    /////////// ajax cập nhật database Thiet-Ke
    $('button[name = btn-update-tk]').click(function () {
        var update_id_tk_old = $(this).val().toUpperCase();
        var update_kieu_tk_new = $('#update_kieu_tk_' + update_id_tk_old).val();

        //kiểm tra nội dung trước khi cập nhật (chưa nhập nội dung sẽ báo lỗi)
        if (update_id_tk_old == "" || update_kieu_tk_new == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');

        }
        else {
            $.post("function/function_database_management.php", { send_update_kieu_tk_new: update_kieu_tk_new, send_update_id_tk_old: update_id_tk_old }, function (update_result) {
                if (update_result == "success") {

                    //neu cap nhat thanh cong thi doi id vs value cua input kieu_tk thanh gia tri moi
                    $('#update_kieu_tk_' + update_id_tk_old).attr("value", update_kieu_tk_new);

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Cập Nhật Thiết Kế Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Mã Hoặc Tên Thiết Kế");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })

        }

    })

    /////////// hiện modal chấp nhận xóa THIET KE
    $('button[name = btn-delete-tk]').click(function () {
        var id_tk = $(this).val();

        var button = '<button id="modal-btn-delete-tk" value="' + id_tk + '" class="btn btn-danger btn-sm">Xóa</button><button data-dismiss="modal" class="btn btn-secondary btn-sm w-50">Hủy</button>';

        $('#modal-content-delete').html(button);
        $('#modal-notification-delete').modal('show');

        //sau đó nếu nhấn nút xóa thì gửi qua php để xử lý
        $('#modal-btn-delete-tk').click(function () {
            //khi click xóa thì ẩn modal chấp nhận xóa đi
            $('#modal-notification-delete').modal('hide');

            var delete_id_tk = $('#modal-btn-delete-tk').val();

            $.post("function/function_database_management.php", { send_delete_id_tk: delete_id_tk }, function (delete_result) {
                if (delete_result == "success") {
                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Xóa Thiết Kế Thành Công");

                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Xóa Thiết Kế Thất Bại");

                    $('#modal-notification-fail').modal('show');
                }
            })
        })
    })

    //////////// ajax thêm database Thiet-Ke
    $('#btn-insert-tk').on('click', function () {
        var insert_kieu_tk = $('#insert_kieu_tk').val();

        //kiểm tra nội dung trước khi thêm database tk
        if (insert_kieu_tk == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_insert_kieu_tk: insert_kieu_tk }, function (insert_result) {
                if (insert_result == "success") {
                    //xóa text trong input lúc nhập
                    $('#insert_id_tk').val("");
                    $('#insert_kieu_tk').val("");

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Thêm Thiết Kế Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Tên Thiết Kế");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })
        }


    })


    /***************************************       Database Thuong-Hieu     ***************************************/
    /////////// ajax cập nhật database Thuong-Hieu
    $('button[name = btn-update-th]').click(function () {
        var update_id_th_old = $(this).val().toUpperCase();
        var update_ten_th_new = $('#update_ten_th_' + update_id_th_old).val();

        //kiểm tra nội dung trước khi cập nhật (chưa nhập nội dung sẽ báo lỗi)
        if (update_id_th_old == "" || update_ten_th_new == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');

        }
        else {
            $.post("function/function_database_management.php", { send_update_ten_th_new: update_ten_th_new, send_update_id_th_old: update_id_th_old }, function (update_result) {
                if (update_result == "success") {

                    //neu cap nhat thanh cong thi doi id vs value cua input ten_th thanh gia tri moi
                    $('#update_ten_th_' + update_id_th_old).attr("value", update_ten_th_new);

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Cập Nhật Thương Hiệu Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Mã Hoặc Tên Thương Hiệu");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })

        }

    })

    /////////// hiện modal chấp nhận xóa THUONG HIEU
    $('button[name = btn-delete-th]').click(function () {
        var id_th = $(this).val();

        var button = '<button id="modal-btn-delete-th" value="' + id_th + '" class="btn btn-danger btn-sm">Xóa</button><button data-dismiss="modal" class="btn btn-secondary btn-sm w-50">Hủy</button>';

        $('#modal-content-delete').html(button);
        $('#modal-notification-delete').modal('show');

        //sau đó nếu nhấn nút xóa thì gửi qua php để xử lý
        $('#modal-btn-delete-th').click(function () {
            //khi click xóa thì ẩn modal chấp nhận xóa đi
            $('#modal-notification-delete').modal('hide');

            var delete_id_th = $('#modal-btn-delete-th').val();

            $.post("function/function_database_management.php", { send_delete_id_th: delete_id_th }, function (delete_result) {
                if (delete_result == "success") {
                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Xóa Thương Hiệu Thành Công");

                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Xóa Thương Hiệu Thất Bại");

                    $('#modal-notification-fail').modal('show');
                }
            })
        })
    })

    //////////// ajax thêm database Thuong-Hieu
    $('#btn-insert-th').on('click', function () {
        var insert_ten_th = $('#insert_ten_th').val();

        //kiểm tra nội dung trước khi thêm database th
        if (insert_ten_th == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_insert_ten_th: insert_ten_th }, function (insert_result) {
                if (insert_result == "success") {
                    //xóa text trong input lúc nhập
                    $('#insert_ten_th').val("");

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Thêm Thương Hiệu Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Tên Thương Hiệu");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })
        }


    })


    /***************************************       Database Nuoc-San-Xuat     ***************************************/
    /////////// ajax cập nhật database Nuoc-San-Xuat
    $('button[name = btn-update-nsx]').click(function () {
        var update_id_nsx = $(this).val();
        var update_ten_nsx_new = $('#update_ten_nsx_' + update_id_nsx).val();

        //kiểm tra nội dung trước khi cập nhật (chưa nhập nội dung sẽ báo lỗi)
        if (update_id_nsx == "" || update_ten_nsx_new == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');

        }
        else if (isNaN(update_id_nsx)) {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Mã Nước Sản Xuất Phải Là Số");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_update_ten_nsx_new: update_ten_nsx_new, send_update_id_nsx: update_id_nsx }, function (update_result) {
                if (update_result == "success") {

                    //neu cap nhat thanh cong thi doi id vs value cua input ten_nsx thanh gia tri moi
                    $('#update_ten_nsx_' + update_id_nsx).attr("value", update_ten_nsx_new);

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Cập Nhật Nước Sản Xuất Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Mã Hoặc Tên Nước Sản Xuất");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })

        }

    })

    /////////// hiện modal chấp nhận xóa NUOC SAN XUAT
    $('button[name = btn-delete-nsx]').click(function () {
        var id_nsx = $(this).val();

        var button = '<button id="modal-btn-delete-nsx" value="' + id_nsx + '" class="btn btn-danger btn-sm">Xóa</button><button data-dismiss="modal" class="btn btn-secondary btn-sm w-50">Hủy</button>';

        $('#modal-content-delete').html(button);
        $('#modal-notification-delete').modal('show');

        //sau đó nếu nhấn nút xóa thì gửi qua php để xử lý
        $('#modal-btn-delete-nsx').click(function () {
            //khi click xóa thì ẩn modal chấp nhận xóa đi
            $('#modal-notification-delete').modal('hide');

            var delete_id_nsx = $('#modal-btn-delete-nsx').val();

            $.post("function/function_database_management.php", { send_delete_id_nsx: delete_id_nsx }, function (delete_result) {
                if (delete_result == "success") {
                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Xóa Nước Sản Xuất Thành Công");

                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Xóa Nước Sản Xuất Thất Bại");

                    $('#modal-notification-fail').modal('show');
                }
            })
        })
    })

    //////////// ajax thêm database Nuoc-San-Xuat
    $('#btn-insert-nsx').on('click', function () {
        var insert_ten_nsx = $('#insert_ten_nsx').val();

        //kiểm tra nội dung trước khi thêm database th
        if (insert_ten_nsx == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_insert_ten_nsx: insert_ten_nsx }, function (insert_result) {
                if (insert_result == "success") {
                    //xóa text trong input lúc nhập
                    $('#insert_id_nsx').val("");
                    $('#insert_ten_nsx').val("");

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Thêm Nước Sản Xuất Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Mã Hoặc Tên Nước Sản Xuất");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })
        }
    })



    /***************************************       Database LOAI KET NOI     ***************************************/
    /////////// ajax cập nhật database LOAI KET NOI
    $('button[name = btn-update-loaiketnoi]').click(function () {
        var update_id_lkn_old = $(this).val().toUpperCase();
        var update_ten_lkn_new = $('#update_ten_lkn_' + update_id_lkn_old).val();

        //kiểm tra nội dung trước khi cập nhật (chưa nhập nội dung sẽ báo lỗi)
        if (update_id_lkn_old == "" || update_ten_lkn_new == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');

        }
        else {
            $.post("function/function_database_management.php", { send_update_ten_lkn_new: update_ten_lkn_new, send_update_id_lkn_old: update_id_lkn_old }, function (update_result) {
                if (update_result == "success") {

                    //neu cap nhat thanh cong thi doi id vs value cua input ten_lkn thanh gia tri moi
                    $('#update_ten_lkn_' + update_id_lkn_old).attr("value", update_ten_lkn_new);

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Cập Nhật Loại Kết Nối Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Mã Hoặc Tên Loại Kết Nối");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })

        }

    })

    /////////// hiện modal chấp nhận xóa LOAI KET NOI
    $('button[name = btn-delete-lkn]').click(function () {
        var id_lkn = $(this).val();

        var button = '<button id="modal-btn-delete-lkn" value="' + id_lkn + '" class="btn btn-danger btn-sm">Xóa</button><button data-dismiss="modal" class="btn btn-secondary btn-sm w-50">Hủy</button>';

        $('#modal-content-delete').html(button);
        $('#modal-notification-delete').modal('show');

        //sau đó nếu nhấn nút xóa thì gửi qua php để xử lý
        $('#modal-btn-delete-lkn').click(function () {
            //khi click xóa thì ẩn modal chấp nhận xóa đi
            $('#modal-notification-delete').modal('hide');

            var delete_id_lkn = $('#modal-btn-delete-lkn').val();

            $.post("function/function_database_management.php", { send_delete_id_lkn: delete_id_lkn }, function (delete_result) {
                if (delete_result == "success") {
                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Xóa Loại Kết Nối Thành Công");

                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Xóa Loại Kết Nối Thất Bại");

                    $('#modal-notification-fail').modal('show');
                }
            })
        })
    })

    //////////// ajax thêm database LOAI KET NOI
    $('#btn-insert-loaiketnoi').on('click', function () {
        var insert_ten_lkn = $('#insert_ten_lkn').val();

        //kiểm tra nội dung trước khi thêm database loại kết nốis
        if (insert_ten_lkn == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_insert_ten_lkn: insert_ten_lkn }, function (insert_result) {
                if (insert_result == "success") {
                    //xóa text trong input lúc nhập
                    $('#insert_ten_lkn').val("");

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Thêm Loại Kết Nối Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Tên Loại Kết Nối");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })
        }
    })


    /***************************************       Database CHAT LIEU     ***************************************/
    /////////// ajax cập nhật database CHAT LIEU
    $('button[name = btn-update-chatlieu]').click(function () {
        var update_id_cl_old = $(this).val().toUpperCase();
        var update_ten_cl_new = $('#update_ten_cl_' + update_id_cl_old).val();

        //kiểm tra nội dung trước khi cập nhật (chưa nhập nội dung sẽ báo lỗi)
        if (update_id_cl_old == "" || update_ten_cl_new == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');

        }
        else {
            $.post("function/function_database_management.php", { send_update_ten_cl_new: update_ten_cl_new, send_update_id_cl_old: update_id_cl_old }, function (update_result) {
                if (update_result == "success") {

                    //neu cap nhat thanh cong thi doi id vs value cua input ten_cl thanh gia tri moi
                    $('#update_ten_cl_' + update_id_cl_old).attr("value", update_ten_cl_new);

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Cập Nhật Chất Liệu Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Mã Hoặc Tên Chất Liệu");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })

        }

    })

    /////////// hiện modal chấp nhận xóa CHAT LIEU
    $('button[name = btn-delete-cl]').click(function () {
        var id_cl = $(this).val();

        var button = '<button id="modal-btn-delete-cl" value="' + id_cl + '" class="btn btn-danger btn-sm">Xóa</button><button data-dismiss="modal" class="btn btn-secondary btn-sm w-50">Hủy</button>';

        $('#modal-content-delete').html(button);
        $('#modal-notification-delete').modal('show');

        //sau đó nếu nhấn nút xóa thì gửi qua php để xử lý
        $('#modal-btn-delete-cl').click(function () {
            //khi click xóa thì ẩn modal chấp nhận xóa đi
            $('#modal-notification-delete').modal('hide');

            var delete_id_cl = $('#modal-btn-delete-cl').val();

            $.post("function/function_database_management.php", { send_delete_id_cl: delete_id_cl }, function (delete_result) {
                if (delete_result == "success") {
                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Xóa Chất Liệu Thành Công");

                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Xóa Chất Liệu Thất Bại");

                    $('#modal-notification-fail').modal('show');
                }
            })
        })
    })

    //////////// ajax thêm database CHAT LIEU
    $('#btn-insert-chatlieu').on('click', function () {
        var insert_ten_cl = $('#insert_ten_cl').val();

        //kiểm tra nội dung trước khi thêm database chất liệu
        if (insert_ten_cl == "") {
            //in ra câu thông báo LỖI trong modal-notification
            $('#notification-content-fail').text("Lỗi!!! Bạn Chưa Nhập Dữ Liệu");

            //hiển thị thông báo LỖI khi chưa nhập dữ liệu
            $('#modal-notification-fail').modal('show');
        }
        else {
            $.post("function/function_database_management.php", { send_insert_ten_cl: insert_ten_cl }, function (insert_result) {
                if (insert_result == "success") {
                    //xóa text trong input lúc nhập
                    $('#insert_ten_cl').val("");

                    //in ra câu thông báo THÀNH CÔNG trong modal-notification
                    $('#notification-content-success').text("Thêm Chất Liệu Thành Công");

                    //sau khi cập nhật thành công thì hiển thị modal-notification thông báo cho biết là cập nhật thành công
                    $('#modal-notification-success').modal('show');

                    //khi click vao thông báo thành công sẽ load lại trang
                    $('#modal-notification-success').click(function () {
                        location.reload();
                    })
                }
                else {
                    //in ra câu thông báo LỖI trong modal-notification
                    $('#notification-content-fail').text("Lỗi!!! Có Thể Bạn Đã Nhập Trùng Tên Chất Liệu");

                    //hiển thị thông báo LỖI khi cập nhật KHÔNG thành công
                    $('#modal-notification-fail').modal('show');
                }
            })
        }
    })


})