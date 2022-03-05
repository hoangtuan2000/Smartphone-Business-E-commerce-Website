$(function () {

    /************************************************* nút sắp xếp sản phẩm theo giá tăng dần *************************************************/
    $('#btn-filter-asc').on('click', function () {
        //hiển thị cho ngta biết đang sắp xếp theo tăng hay giảm
        $(".sap-xep").html("Giá tăng dần");
        //lấy tên loại sản phẩm cần sắp xếp
        var product_asc = $(this).val();
        var filter_asc = "filter_asc";
        $.post("function/function_filter.php", { send_product: product_asc, send_filter: filter_asc }, function (result_filter) {
            $('#show_product').html(result_filter);
        })
    })
    /************************************************* nút sắp xếp sản phẩm theo giá giảm dần *************************************************/
    $('#btn-filter-desc').on('click', function () {
        //hiển thị cho ngta biết đang sắp xếp theo tăng hay giảm
        $(".sap-xep").html("Giá giảm dần");
        //lấy tên loại sản phẩm cần sắp xếp
        var product_desc = $(this).val();
        var filter_desc = "filter_desc";
        $.post("function/function_filter.php", { send_product: product_desc, send_filter: filter_desc }, function (result_filter) {
            $('#show_product').html(result_filter);
        })
    })

    /************************************************* nút hiển thị tất cả sản phẩm khuyến mãi trong trang khuyến mãi *************************************************/
    $('#filter_all_product_khuyenmai').click(function () {
        location.reload();
    })

    /************************************************* nút hiển thị tất cả DIEN THOAI khuyến mãi trong trang khuyến mãi *************************************************/
    $('#filter_dienthoai_khuyenmai').click(function () {
        //hiển thị trên header
        $('#show_name_filter').html("Điện Thoại Khuyến Mãi");
        //hiển thị cho ngta biết đang sắp xếp theo loại sản phẩm nào
        $(".sap-xep").html("Điện thoại");
        var filter_khuyenmai = $(this).val();
        $.post("function/function_filter.php", { send_filter_khuyenmai: filter_khuyenmai }, function (result_filter) {
            $('#show_product').html(result_filter);
        })
    })

    /************************************************* nút hiển thị tất cả TAI NGHE khuyến mãi trong trang khuyến mãi *************************************************/
    $('#filter_tainghe_khuyenmai').click(function () {
        //hiển thị trên header
        $('#show_name_filter').html("Tai Nghe Khuyến Mãi");
        //hiển thị cho ngta biết đang sắp xếp theo loại sản phẩm nào
        $(".sap-xep").html("Tai nghe");
        var filter_khuyenmai = $(this).val();
        $.post("function/function_filter.php", { send_filter_khuyenmai: filter_khuyenmai }, function (result_filter) {
            $('#show_product').html(result_filter);
        })
    })

    /************************************************* nút hiển thị tất cả OP LUNG khuyến mãi trong trang khuyến mãi *************************************************/
    $('#filter_oplung_khuyenmai').click(function () {
        //hiển thị trên header
        $('#show_name_filter').html("Ốp Lưng Khuyến Mãi");
        //hiển thị cho ngta biết đang sắp xếp theo loại sản phẩm nào
        $(".sap-xep").html("Ốp Lưng");
        var filter_khuyenmai = $(this).val();
        $.post("function/function_filter.php", { send_filter_khuyenmai: filter_khuyenmai }, function (result_filter) {
            $('#show_product').html(result_filter);
        })
    })

})