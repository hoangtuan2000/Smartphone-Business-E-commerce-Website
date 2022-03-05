$(function () {
    /********************** UPDATE INSERT Xã-Huyện-Tỉnh theo ID **********************/

    //lay quan huyen
    $('#sl_tinhthanhpho').change(function () {
        var id_tinhthanhpho = $(this).val();
        
        if (id_tinhthanhpho != "") {
            $.post("function/function_choose_address.php", { send_id_tinhthanhpho: id_tinhthanhpho }, function (result_quanhuyen) {
                $('#sl_quanhuyen').html(result_quanhuyen);
                $('#sl_quanhuyen').removeAttr("disabled");
            })
        }
    })
    //lay quan xa 
    $('#sl_quanhuyen').change(function () {
        var id_quanhuyen = $(this).val();

        if (id_quanhuyen != "") {
            $.post("function/function_choose_address.php", { send_id_quanhuyen: id_quanhuyen }, function (result_quanhuyen) {
                $('#sl_xaphuong').html(result_quanhuyen);
                $('#sl_xaphuong').removeAttr("disabled");
            })
        }
    })

    


})