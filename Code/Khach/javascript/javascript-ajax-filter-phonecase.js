$(function () {


    /************************************************* lọc điện thoại theo cấu hinh *************************************************/
    var dieu_kien = "";
    $(document).on('click', 'button[name = filter_detail]', function () {
        var filter = $(this).val();
        filter = filter + " AND ";

        var exist_dieu_kien = dieu_kien.search(filter);
        if (exist_dieu_kien < 0) {
            dieu_kien += filter;
        } else {
            dieu_kien = dieu_kien.replace(filter, "");
        }
        // alert(dieu_kien);
        $.post("function/function_filter.php", { send_filter_detail_phonecase: "oplung", send_filter_detail: dieu_kien, send_filter_detail_gia: dieu_kien_gia }, function (result_filter) {
            var tach_number_and_sql = result_filter.split("|");

            var ketqua = tach_number_and_sql[0];
            ketqua = parseInt(ketqua);
            if (ketqua == 0) {
                $('#ket_qua_filter').html(ketqua + " Kết Quả");
                //nếu không có kết quả thì tắt link ko cho bấm
                $('#ket_qua_filter').attr('style', 'pointer-events: none');

            } else {
                $('#ket_qua_filter').html(ketqua + " Kết Quả");
                $('#ket_qua_filter').removeAttr('style', 'pointer-events: none');
                $('#ket_qua_filter').attr('href', 'search_results.php?sql=' + tach_number_and_sql[1]);
            }
        })
    })

    var dieu_kien_gia = "";
    $(document).on('click', 'button[name = filter_detail_gia]', function () {
        var filter = $(this).val();
        filter = filter + " OR ";

        var exist_dieu_kien = dieu_kien_gia.search(filter);
        if (exist_dieu_kien < 0) {
            dieu_kien_gia += filter;
        } else {
            dieu_kien_gia = dieu_kien_gia.replace(filter, "");
        }
        // alert(dieu_kien_gia);
        $.post("function/function_filter.php", { send_filter_detail_phonecase: "oplung", send_filter_detail: dieu_kien, send_filter_detail_gia: dieu_kien_gia }, function (result_filter) {
            var tach_number_and_sql = result_filter.split("|");
            var ketqua = tach_number_and_sql[0];
            ketqua = parseInt(ketqua);
            if (ketqua == 0) {
                $('#ket_qua_filter').html(ketqua + " Kết Quả");
                //nếu không có kết quả thì tắt link ko cho bấm
                $('#ket_qua_filter').attr('style', 'pointer-events: none');

            } else {
                $('#ket_qua_filter').html(ketqua + " Kết Quả");
                $('#ket_qua_filter').removeAttr('style', 'pointer-events: none');
                $('#ket_qua_filter').attr('href', 'search_results.php?sql=' + tach_number_and_sql[1]);
            }
        })
    })

    /************************************************* Hiện css khi nhấn nút lọc *************************************************/
    var count = 0;
    $(document).on('click', 'button[name = filter_detail]', function () {
        var bam = $(this).attr('data-tab');

        if (bam == 'chua bam') {
            $(this).css("border-color", "red");
            $(this).css("color", "red");
            $('#btn-filter-results').removeAttr("hidden");
            $(this).attr('data-tab', 'da bam');
            count++;
        } else {
            $(this).css("border-color", "#347fd6");
            $(this).css("color", "#347fd6");
            $(this).attr('data-tab', 'chua bam');
            count--;
            if (count == 0) {
                $('#btn-filter-results').attr("hidden", true);
            }
        }
    })
    $(document).on('click', 'button[name = filter_detail_gia]', function () {
        var bam = $(this).attr('data-tab');

        if (bam == 'chua bam') {
            $(this).css("border-color", "red");
            $(this).css("color", "red");
            $('#btn-filter-results').removeAttr("hidden");
            $(this).attr('data-tab', 'da bam');
            count++;
        } else {
            $(this).css("border-color", "#347fd6");
            $(this).css("color", "#347fd6");
            $(this).attr('data-tab', 'chua bam');
            count--;
            if (count == 0) {
                $('#btn-filter-results').attr("hidden", true);
            }
        }
    })

    /************************************************* Xóa css khi nhấn nút bỏ lọc *************************************************/
    $('#btn-remove-filter').on('click', function () {
        dieu_kien = "";
        dieu_kien_gia = "";

        $('button[name = filter_detail]').attr('data-tab', 'chua bam');
        $('button[name = filter_detail_gia]').attr('data-tab', 'chua bam');

        $('#div-filter button').css("border-color", "#347fd6");
        $('#btn-filter-results').attr("hidden", true);
        $('#div-filter button').css("color", "#347fd6");
    })

})