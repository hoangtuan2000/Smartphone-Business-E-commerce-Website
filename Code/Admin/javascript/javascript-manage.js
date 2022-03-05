$(function () {

    /************************** Xóa sessionstorge khi nhấn nút đăng xuất **************************/
    $(function () {
        $('#btn-logout').click(function () {
            sessionStorage.clear(); //xóa lưu vị trí hiện tại của tab đang mở
        })
    })


    /******************************************** code tìm kiếm mặt định của bootstap **************************************************/
    //  Nút Tìm điện thoại (quản lý sản phẩm)
    $("#input-smartphone-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#table-smartphone tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    //  Nút Tìm tai nghe (quản lý sản phẩm)
    $("#input-headphone-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#table-headphone tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    //  Nút Tìm ốp lưng (quản lý sản phẩm) 
    $("#input-phonecase-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#table-phonecase tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    /********************************************* code tìm kiếm mặt định của bootstap ***************************************************/
    //   Nút Tìm Nhân Viên (quản lý nhân viên) 
    $("#input-staff-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#table-staff tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    /************************************************* code tìm kiếm mặt định của bootstap ***********************************************/
    //Nút Tìm Tất Cả Đơn Hàng (quản lý đơn hàng)
    $("#input-order-all-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#table-order-all tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    //Nút Tìm Đơn Hàng Chưa Xử Lý (quản lý đơn hàng)
    $("#input-order-chuaxuly-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#table-order-chuaxuly tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Nút Tìm Đơn Hàng Đã Xử lý (quản lý đơn hàng) 
    $("#input-order-daxuly-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#table-order-daxuly tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Nút Tìm Đơn Hàng Đang Vận Chuyển (quản lý đơn hàng) 
    $("#input-order-dangvanchuyen-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#table-order-dangvanchuyen tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Nút Tìm Đơn Hàng Đang Giao Hàng (quản lý đơn hàng)
    $("#input-order-danggiaohang-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#table-order-danggiaohang tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
    // Nút Tìm Đơn Hàng Giao Hàng Thành Công (quản lý đơn hàng) 
    $("#input-order-giaothanhcong-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#table-order-giaothanhcong tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    
    /************************************  Lưu Lại Tab Header (quản lý sản phẩm / quản lý database )  ***********************************/
    //tạo sessionstorge lưu tab header được click ( quản lý sản phẩm / quản lý database / quản lý nhân viên )
    function create_sessionstorge_tab_header_active() {
        //nếu nút quản lý sản phẩm hoặc quản lý database được click thì sẽ lưu lại để load trang vẫn giữ nguyên vị trí
        $('#tab-header a.pills-header').click(function () {
            //lấy id của thẻ a được click
            var id_tab_header = $(this).attr('id');
            sessionStorage.setItem('id-tab-header-current', id_tab_header);

            //lấy data-tab của thẻ a được click (data-tab lưu id của div hiển thị dữ liệu)
            var div_show_tab_header = $(this).data('tab');
            sessionStorage.setItem('div-show-tab-header-current', div_show_tab_header);
        })
    }

    //thêm class show và active cho tab header được click
    function active_tab_header() {
        var id_tab_header = sessionStorage.getItem('id-tab-header-current'); //getItem return Chuỗi, đại diện cho giá trị của khóa được chỉ định
        $('#' + id_tab_header).addClass(['show', 'active']);
    }

    //thêm class show và active cho div hiển thị của tab header được click
    function active_div_show_tab_header() {
        var id_div_show_tab_header = sessionStorage.getItem('div-show-tab-header-current'); //getItem return Chuỗi, đại diện cho giá trị của khóa được chỉ định
        $('#' + id_div_show_tab_header).addClass(['show', 'active']);
    }

    //hàm khi load lại trang web vấn giữ nguyên tab header được chọn
    function load_tab_header() {
        //nếu tồn tại sessionStorge chứa id của tab header được click thì hiển thị nó lên
        if (sessionStorage.getItem('id-tab-header-current')) { //getItem return Chuỗi, đại diện cho giá trị của khóa được chỉ định
            //xóa class show và active mặc định của thẻ a (tab header) khi vừa load trang web 
            $('a.pills-header').removeClass(['show', 'active']);

            //xóa class show và active mặc định của div hiển thị dũ liệu khi vừa load trang web
            $('.tab-pane-header').removeClass(['show', 'active']);

            //gán lại class show và active cho thẻ a được click
            active_tab_header();
            //gán lại class show và active cho div hiển thị được chọn
            active_div_show_tab_header();
        }
    }

    //(Gọi Hàm) lưu lại tab header (quản lý sản phẩm hoặc quản lý database) xem cái được chọn thì khi load lại vẫn ở tab header đó
    create_sessionstorge_tab_header_active();
    load_tab_header();


    /************************************  Lưu Lại Tab Item Database (Bộ Nhớ, Màn Hình,...... )  ***********************************/
    function create_sessionstorge_tab_item_database_active() {
        //nếu nút bộ nhớ, màn hình,...(trong quản lý database) được click thì sẽ lưu lại để load trang vẫn giữ nguyên vị trí
        $('#v-pills-tab-database a.tab-item-database').click(function () {
            var id_tab_item_database = $(this).attr('id');
            sessionStorage.setItem('id-tab-item-database-current', id_tab_item_database);

            var div_show_tab_item_database = $(this).data('tab');
            sessionStorage.setItem('div-show-tab-item-database-current', div_show_tab_item_database);
        })
    }

    function active_tab_item_database() {
        var id_tab_item_database = sessionStorage.getItem('id-tab-item-database-current');
        $('#' + id_tab_item_database).addClass(['show', 'active']);
    }

    function active_div_show_tab_item_database() {
        var id_div_show_tab_item_database = sessionStorage.getItem('div-show-tab-item-database-current');
        $('#' + id_div_show_tab_item_database).addClass(['show', 'active']);
    }

    function load_tab_item_database() {
        //nếu tồn tại sessionStorge chứa id của tab item database được click thì hiển thị nó lên
        if (sessionStorage.getItem('id-tab-item-database-current')) {
            $('a.tab-item-database').removeClass(['show', 'active']);

            $('.tab-pane-item-database').removeClass(['show', 'active']);

            active_tab_item_database();
            active_div_show_tab_item_database();
        }
    }

    //(Gọi Hàm) lưu lại tab item database (bộ nhớ, ram,...(trong quản lý database)) xem cái được chọn thì khi load lại vẫn ở tab header đó
    create_sessionstorge_tab_item_database_active();
    load_tab_item_database();


    /************************************  Lưu Lại Tab Item Product (Điện Thoại, Tai Nghe,...... )  ***********************************/
    function create_sessionstorge_tab_item_product_active() {
        //nếu nút điện thoại, tai nghe,...(trong quản lý sản phẩm) được click thì sẽ lưu lại để load trang vẫn giữ nguyên vị trí
        $('#v-pills-tab-product a.tab-item-product').click(function () {
            var id_tab_item_product = $(this).attr('id');
            sessionStorage.setItem('id-tab-item-product-current', id_tab_item_product);

            var div_show_tab_item_product = $(this).data('tab');
            sessionStorage.setItem('div-show-tab-item-product-current', div_show_tab_item_product);
        })
    }

    function active_tab_item_product() {
        var id_tab_item_product = sessionStorage.getItem('id-tab-item-product-current');
        $('#' + id_tab_item_product).addClass(['show', 'active']);
    }

    function active_div_show_tab_item_product() {
        var id_div_show_tab_item_product = sessionStorage.getItem('div-show-tab-item-product-current');
        $('#' + id_div_show_tab_item_product).addClass(['show', 'active']);
    }

    function load_tab_item_product() {
        //nếu tồn tại sessionStorge chứa id của tab item product được click thì hiển thị nó lên
        if (sessionStorage.getItem('id-tab-item-product-current')) {
            $('a.tab-item-product').removeClass(['show', 'active']);

            $('.tab-pane-item-product').removeClass(['show', 'active']);

            active_tab_item_product();
            active_div_show_tab_item_product();
        }
    }

    //(Gọi Hàm) lưu lại tab item product (điện thoại, tai nghe...(trong quản lý product)) xem cái được chọn thì khi load lại vẫn ở tab header đó
    create_sessionstorge_tab_item_product_active();
    load_tab_item_product();



    /************************************  Lưu Lại Tab Item ORDER Hóa Đơn  ***********************************/
    function create_sessionstorge_tab_item_order_active() {
        //nếu nút tất cả đơn hàng,...(trong quản lý đơn hàng) được click thì sẽ lưu lại để load trang vẫn giữ nguyên vị trí
        $('#pills-tab-order a.tab-item-order').click(function () {
            var id_tab_item_order = $(this).attr('id');
            sessionStorage.setItem('id-tab-item-order-current', id_tab_item_order);

            var div_show_tab_item_order = $(this).data('tab');
            sessionStorage.setItem('div-show-tab-item-order-current', div_show_tab_item_order);
        })
    }

    function active_tab_item_order() {
        var id_tab_item_order = sessionStorage.getItem('id-tab-item-order-current');
        $('#' + id_tab_item_order).addClass(['show', 'active']);
    }

    function active_div_show_tab_item_order() {
        var id_div_show_tab_item_order = sessionStorage.getItem('div-show-tab-item-order-current');
        $('#' + id_div_show_tab_item_order).addClass(['show', 'active']);
    }

    function load_tab_item_order() {
        //nếu tồn tại sessionStorge chứa id của tab item order được click thì hiển thị nó lên
        if (sessionStorage.getItem('id-tab-item-order-current')) {
            $('a.tab-item-order').removeClass(['show', 'active']);

            $('.tab-pane-item-order').removeClass(['show', 'active']);

            active_tab_item_order();
            active_div_show_tab_item_order();
        }
    }

    //(Gọi Hàm) lưu lại tab item order (trong quản lý hóa đơn) xem cái được chọn thì khi load lại vẫn ở tab header đó
    create_sessionstorge_tab_item_order_active();
    load_tab_item_order();


})
