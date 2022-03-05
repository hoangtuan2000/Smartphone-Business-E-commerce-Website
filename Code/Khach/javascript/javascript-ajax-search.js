$(function () {

    $(document).on('keyup', 'input[name = search]', function () {
        var name_product = $(this).val();

        if (name_product != "" || name_product.length > 1) {
            $.post("function/function_search.php", { send_search_product: name_product }, function (result_search) {
                $('#show_suggestions').removeAttr('hidden');
                $('#show_suggestions').html(result_search);
            })
        } else {
            $('#show_suggestions').attr('hidden', 'true');
        }
    })

    // ẩn gợi ý tìm kiếm khi lăn chuột
    var last_scrollTop = 0;
    $(window).scroll(function (event) {
        var vitri = $(this).scrollTop();
        //lấy chuổi tìm kiếm
        var input_search = $('input[name = search]').val();

        // nếu lăn chuột xuống thì ẩn gợi ý tìm kiếm
        if (vitri > last_scrollTop) {
            $('#show_suggestions').attr('hidden', 'true');
        }
        // nếu lăn chuột lên tới trên cùng thì hiện gợi ý tìm kiếm 
        else if (vitri == 0) {
            //nếu có nhập tìm kiếm mới hiện
            if (input_search != "" || input_search.length > 1){
                $('#show_suggestions').removeAttr('hidden');
            }                
        }
        last_scrollTop = vitri;
    })

})