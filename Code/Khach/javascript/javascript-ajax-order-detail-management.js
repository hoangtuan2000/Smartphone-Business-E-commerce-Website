$(function () {
    //tô màu cho icon theo trạng thái đơn hàng
    var ten_ttdh = $('#input_ten_ttdh').val();
    ten_ttdh = ten_ttdh.toLowerCase();
    if (ten_ttdh == "chưa xử lý") {
        $('div[name = icon_chuaxuly]').css("color", "blue");
        $('div[name = icon_chuaxuly]').css("opacity", "1");

    } else if (ten_ttdh == "đã xử lý") {
        $('div[name = icon_chuaxuly]').css("color", "blue");
        $('div[name = icon_daxuly]').css("color", "blue");

        $('div[name = icon_chuaxuly]').css("opacity", "1");
        $('div[name = icon_daxuly]').css("opacity", "1");

    } else if (ten_ttdh == "đang vận chuyển") {
        $('div[name = icon_chuaxuly]').css("color", "blue");
        $('div[name = icon_daxuly]').css("color", "blue");
        $('div[name = icon_dangvanchuyen]').css("color", "blue");

        $('div[name = icon_chuaxuly]').css("opacity", "1");
        $('div[name = icon_daxuly]').css("opacity", "1");
        $('div[name = icon_dangvanchuyen]').css("opacity", "1");

    } else if (ten_ttdh == "đang giao hàng") {
        $('div[name = icon_chuaxuly]').css("color", "blue");
        $('div[name = icon_daxuly]').css("color", "blue");
        $('div[name = icon_dangvanchuyen]').css("color", "blue");
        $('div[name = icon_danggiaohang]').css("color", "blue");
        
        $('div[name = icon_chuaxuly]').css("opacity", "1");
        $('div[name = icon_daxuly]').css("opacity", "1");
        $('div[name = icon_dangvanchuyen]').css("opacity", "1");
        $('div[name = icon_danggiaohang]').css("opacity", "1");

    } else if (ten_ttdh == "giao hàng thành công") {
        $('div[name = icon_chuaxuly]').css("color", "blue");
        $('div[name = icon_daxuly]').css("color", "blue");
        $('div[name = icon_dangvanchuyen]').css("color", "blue");
        $('div[name = icon_danggiaohang]').css("color", "blue");
        $('div[name = icon_giaohangthanhcong]').css("color", "blue");
        
        $('div[name = icon_chuaxuly]').css("opacity", "1");
        $('div[name = icon_daxuly]').css("opacity", "1");
        $('div[name = icon_dangvanchuyen]').css("opacity", "1");
        $('div[name = icon_danggiaohang]').css("opacity", "1");
        $('div[name = icon_giaohangthanhcong]').css("opacity", "1");

    }
})