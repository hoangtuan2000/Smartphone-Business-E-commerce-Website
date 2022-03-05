<?php
include 'function_connect_db.php';
include 'function_find_database.php';
include 'function_money_format.php';

//sắp xếp sản phẩm giá tăng dần or giảm dần
if (isset($_POST['send_filter'])) {
    //$filter xem sắp xếp theo tăng hay giảm
    $filter = $_POST['send_filter'];
    //$product xem loại sản phẩm nào cần sắp xếp
    $product = $_POST['send_product'];

    if ($filter == "filter_asc") {
        switch ($product) {
            case "smartphone":
                $sql = "SELECT * FROM (SELECT sp.*, (sp.gia_sp-sp.gia_sp*(km.giam_km/100)) as tinhgia FROM `sanpham` sp, `khuyenmai` km 
                WHERE id_lsp = 'DT' AND id_ttsp != 'NKD' AND sp.id_km = km.id_km) as a ORDER BY a.tinhgia ASC";
                $query = mysqli_query($con, $sql);
                break;
            case "headphone":
                $sql = "SELECT * FROM (SELECT sp.*, (sp.gia_sp-sp.gia_sp*(km.giam_km/100)) as tinhgia FROM `sanpham` sp, `khuyenmai` km 
                WHERE id_lsp = 'TN' AND id_ttsp != 'NKD' AND sp.id_km = km.id_km) as a ORDER BY a.tinhgia ASC";
                $query = mysqli_query($con, $sql);
                break;
            case "phonecase":
                $sql = "SELECT * FROM (SELECT sp.*, (sp.gia_sp-sp.gia_sp*(km.giam_km/100)) as tinhgia FROM `sanpham` sp, `khuyenmai` km 
                WHERE id_lsp = 'OL' AND id_ttsp != 'NKD' AND sp.id_km = km.id_km) as a ORDER BY a.tinhgia ASC";
                $query = mysqli_query($con, $sql);
                break;
        }
    } else if ($filter == "filter_desc") {
        switch ($product) {
            case "smartphone":
                $sql = "SELECT * FROM (SELECT sp.*, (sp.gia_sp-sp.gia_sp*(km.giam_km/100)) as tinhgia FROM `sanpham` sp, `khuyenmai` km 
                WHERE id_lsp = 'DT' AND id_ttsp != 'NKD' AND sp.id_km = km.id_km) as a ORDER BY a.tinhgia DESC";
                $query = mysqli_query($con, $sql);
                break;
            case "headphone":
                $sql = "SELECT * FROM (SELECT sp.*, (sp.gia_sp-sp.gia_sp*(km.giam_km/100)) as tinhgia FROM `sanpham` sp, `khuyenmai` km 
                WHERE id_lsp = 'TN' AND id_ttsp != 'NKD' AND sp.id_km = km.id_km) as a ORDER BY a.tinhgia DESC";
                $query = mysqli_query($con, $sql);
                break;
            case "phonecase":
                $sql = "SELECT * FROM (SELECT sp.*, (sp.gia_sp-sp.gia_sp*(km.giam_km/100)) as tinhgia FROM `sanpham` sp, `khuyenmai` km 
                WHERE id_lsp = 'OL' AND id_ttsp != 'NKD' AND sp.id_km = km.id_km) as a ORDER BY a.tinhgia DESC";
                $query = mysqli_query($con, $sql);
                break;
        }
    }


    while ($result = mysqli_fetch_array($query)) {
        $khuyenmai = get_khuyenmai($result['id_km']);
        $gia_old = $result['gia_sp'];
        $gia_new = price_after_promotion($gia_old, $khuyenmai['giam_km']);
        $gia_old = money_format($gia_old);
        $gia_new = money_format($gia_new);
?>
        <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
            <div class="card float-left bg-white hover-product div-product magin-1">
                <a href="product_detail.php?id_product=<?php echo $result['id_sp'] ?>" class="a-top-product">
                    <img src="<?php echo $result['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                    <div class="p-1">
                        <div class="div-discount">
                            <?php
                            if ($khuyenmai['giam_km'] == 0) {
                            ?>
                                <span>&nbsp;</span>
                            <?php
                            } else {
                            ?>
                                <i class="fa fa-gift" aria-hidden="true"></i>
                                <span>
                                    <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                </span>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="text-center">
                            <p class="text-name-product"><?php echo $result['ten_sp'] ?></p>

                            <?php
                            if ($khuyenmai['giam_km'] == 0) {
                                echo '<span>&nbsp;<span/>';
                            } else {
                                echo '<p class="text-price-old">' . $gia_old . '</p>';
                            }
                            ?>

                            <p class="text-price-new"><?php echo $gia_new ?></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php
    }
}



//hiển thị sản phẩm khuyến mãi
if (isset($_POST['send_filter_khuyenmai'])) {
    //$filter xem sắp xếp theo tăng hay giảm
    $filter = $_POST['send_filter_khuyenmai'];

    switch ($filter) {
        case "smartphone":
            $sql = "SELECT * FROM `sanpham` WHERE id_lsp = 'DT' AND id_km NOT IN (SELECT id_km FROM khuyenmai WHERE giam_km = '0') AND id_ttsp != 'NKD'";
            $query = mysqli_query($con, $sql);
            break;
        case "headphone":
            $sql = "SELECT * FROM `sanpham` WHERE id_lsp = 'TN' AND id_km NOT IN (SELECT id_km FROM khuyenmai WHERE giam_km = '0') AND id_ttsp != 'NKD'";
            $query = mysqli_query($con, $sql);
            break;
        case "phonecase":
            $sql = "SELECT * FROM `sanpham` WHERE id_lsp = 'OL' AND id_km NOT IN (SELECT id_km FROM khuyenmai WHERE giam_km = '0') AND id_ttsp != 'NKD'";
            $query = mysqli_query($con, $sql);
            break;
    }


    while ($result = mysqli_fetch_array($query)) {
        $khuyenmai = get_khuyenmai($result['id_km']);
        $gia_old = $result['gia_sp'];
        $gia_new = price_after_promotion($gia_old, $khuyenmai['giam_km']);
        $gia_old = money_format($gia_old);
        $gia_new = money_format($gia_new);
    ?>
        <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" data-aos-offset="10" data-aos-easing="linear">
            <div class="card float-left bg-white hover-product div-product magin-1">
                <a href="product_detail.php?id_product=<?php echo $result['id_sp'] ?>" class="a-top-product">
                    <img src="<?php echo $result['anh_sp'] ?>" class="card-img-top d-block width-90 mx-auto image-top-product object-fit-contain" alt="Card image cap">
                    <div class="p-1">
                        <div class="div-discount">
                            <?php
                            if ($khuyenmai['giam_km'] == 0) {
                            ?>
                                <span>&nbsp;</span>
                            <?php
                            } else {
                            ?>
                                <i class="fa fa-gift" aria-hidden="true"></i>
                                <span>
                                    <?php echo "Giảm " . $khuyenmai['giam_km'] . "%" ?>
                                </span>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="text-center">
                            <p class="text-name-product"><?php echo $result['ten_sp'] ?></p>

                            <?php
                            if ($khuyenmai['giam_km'] == 0) {
                                echo '<span>&nbsp;<span/>';
                            } else {
                                echo '<p class="text-price-old">' . $gia_old . '</p>';
                            }
                            ?>

                            <p class="text-price-new"><?php echo $gia_new ?></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
<?php
    }
}

//trả kết quả số sản phẩm lọc điện thoại theo cấu hình
if (isset($_POST['send_filter_detail_smartphone'])) {

    $dieukien = "";
    $dieukien_gia = "";

    if (!empty($_POST['send_filter_detail'])) {
        $dieukien = $_POST['send_filter_detail'];
    }

    if (!empty($_POST['send_filter_detail_gia'])) {
        $dieukien_gia = $_POST['send_filter_detail_gia'];
    }

    // cắt chữ AND dư thừa cuối cùng
    $dieukien = substr($dieukien, 0, (strlen($dieukien) - 5));
    $dieukien_gia = substr($dieukien_gia, 0, (strlen($dieukien_gia) - 4));

    if (!empty($_POST['send_filter_detail_gia']) && !empty($_POST['send_filter_detail'])) {
        $sql_filter_detail = "SELECT * FROM `sanpham` as sp, `dienthoai` as dt WHERE id_lsp = 'DT' AND sp.id_sp = dt.id_sp AND $dieukien AND ($dieukien_gia)";

    } else if (!empty($_POST['send_filter_detail_gia']) && empty($_POST['send_filter_detail'])) {
        $sql_filter_detail = "SELECT * FROM `sanpham` as sp, `dienthoai` as dt WHERE id_lsp = 'DT' AND sp.id_sp = dt.id_sp AND ($dieukien_gia)";

    } else if (empty($_POST['send_filter_detail_gia']) && !empty($_POST['send_filter_detail'])) {
        $sql_filter_detail = "SELECT * FROM `sanpham` as sp, `dienthoai` as dt WHERE id_lsp = 'DT' AND sp.id_sp = dt.id_sp AND $dieukien";
    }

    $query_filter_detail = mysqli_query($con, $sql_filter_detail);
    $num = mysqli_num_rows($query_filter_detail);

    echo $num."|".$sql_filter_detail;
}

//trả kết quả số sản phẩm lọc tai nghe theo cấu hình
if (isset($_POST['send_filter_detail_headphone'])) {

    $dieukien = "";
    $dieukien_gia = "";

    if (!empty($_POST['send_filter_detail'])) {
        $dieukien = $_POST['send_filter_detail'];
    }

    if (!empty($_POST['send_filter_detail_gia'])) {
        $dieukien_gia = $_POST['send_filter_detail_gia'];
    }

    // cắt chữ AND dư thừa cuối cùng
    $dieukien = substr($dieukien, 0, (strlen($dieukien) - 5));
    $dieukien_gia = substr($dieukien_gia, 0, (strlen($dieukien_gia) - 4));

    if (!empty($_POST['send_filter_detail_gia']) && !empty($_POST['send_filter_detail'])) {
        $sql_filter_detail = "SELECT * FROM `sanpham` as sp, `tainghe` as tn WHERE id_lsp = 'TN' AND sp.id_sp = tn.id_sp AND $dieukien AND ($dieukien_gia)";
    } else if (!empty($_POST['send_filter_detail_gia']) && empty($_POST['send_filter_detail'])) {
        $sql_filter_detail = "SELECT * FROM `sanpham` as sp, `tainghe` as tn WHERE id_lsp = 'TN' AND sp.id_sp = tn.id_sp AND ($dieukien_gia)";
    } else if (empty($_POST['send_filter_detail_gia']) && !empty($_POST['send_filter_detail'])) {
        $sql_filter_detail = "SELECT * FROM `sanpham` as sp, `tainghe` as tn WHERE id_lsp = 'TN' AND sp.id_sp = tn.id_sp AND $dieukien";
    }

    $query_filter_detail = mysqli_query($con, $sql_filter_detail);
    $num = mysqli_num_rows($query_filter_detail);

    echo $num."|".$sql_filter_detail;
}

//trả kết quả số sản phẩm lọc ốp lưng theo cấu hình
if (isset($_POST['send_filter_detail_phonecase'])) {

    $dieukien = "";
    $dieukien_gia = "";

    if (!empty($_POST['send_filter_detail'])) {
        $dieukien = $_POST['send_filter_detail'];
    }

    if (!empty($_POST['send_filter_detail_gia'])) {
        $dieukien_gia = $_POST['send_filter_detail_gia'];
    }

    // cắt chữ AND dư thừa cuối cùng
    $dieukien = substr($dieukien, 0, (strlen($dieukien) - 5));
    $dieukien_gia = substr($dieukien_gia, 0, (strlen($dieukien_gia) - 4));

    if (!empty($_POST['send_filter_detail_gia']) && !empty($_POST['send_filter_detail'])) {
        $sql_filter_detail = "SELECT * FROM `sanpham` as sp, `oplung` as ol WHERE id_lsp = 'OL' AND sp.id_sp = ol.id_sp AND $dieukien AND ($dieukien_gia)";
    } else if (!empty($_POST['send_filter_detail_gia']) && empty($_POST['send_filter_detail'])) {
        $sql_filter_detail = "SELECT * FROM `sanpham` as sp, `oplung` as ol WHERE id_lsp = 'OL' AND sp.id_sp = ol.id_sp AND ($dieukien_gia)";
    } else if (empty($_POST['send_filter_detail_gia']) && !empty($_POST['send_filter_detail'])) {
        $sql_filter_detail = "SELECT * FROM `sanpham` as sp, `oplung` as ol WHERE id_lsp = 'OL' AND sp.id_sp = ol.id_sp AND $dieukien";
    }

    $query_filter_detail = mysqli_query($con, $sql_filter_detail);
    $num = mysqli_num_rows($query_filter_detail);

    echo $num."|".$sql_filter_detail;
}