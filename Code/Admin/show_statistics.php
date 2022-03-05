<?php
include 'function/function_connect_db.php';

function rand_color()
{
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

$sql = "SELECT * FROM `donhang`";
$query = mysqli_query($con, $sql);
$num = mysqli_num_rows($query);
//nếu có dữ liệu thì mới thống kê
if ($num > 0) {

    //lấy ngày tháng năm hệ thổng trừ đi 7 ngày để so sánh thống kê hóa đơn trong 7 ngày
    $date_he_thong = date('d-m-Y');
    $date_min = date('d-m-Y', strtotime($date_he_thong . '- 7 days'));

    /**************************************** thống kê số hóa đơn bán được trong 7 ngày ****************************************/
    // $sql_count_donhang_ngay = "SELECT COUNT(id_dh) as tong_don_hang, SUBSTRING(ngay_dat, 10) as ngay_dat FROM `donhang` GROUP BY SUBSTRING(ngay_dat, 10) ";
    $sql_count_donhang_ngay = "SELECT COUNT(id_dh) as tong_don_hang, ngay_dat FROM `donhang` GROUP BY SUBSTRING(ngay_dat, 10)";
    $query_count_donhang_ngay = mysqli_query($con, $sql_count_donhang_ngay);

    $y_tong_don_hang_ngay = [];
    $x_ngay_dat = [];
    while ($result_count_donhang_ngay = mysqli_fetch_array($query_count_donhang_ngay)) {
        $ngay_dat = substr($result_count_donhang_ngay['ngay_dat'], 9);
        if (strtotime($ngay_dat) >= strtotime($date_min)) {
            $y_tong_don_hang_ngay[] = $result_count_donhang_ngay['tong_don_hang'];
            $x_ngay_dat[] = $ngay_dat;
        }
    }

    for ($a = 0; $a < count($x_ngay_dat); $a++) {
        for ($b = $a + 1; $b < count($x_ngay_dat); $b++) {
            if (strtotime($x_ngay_dat[$a]) > strtotime($x_ngay_dat[$b])) {
                $temp_x = $x_ngay_dat[$a];
                $x_ngay_dat[$a] = $x_ngay_dat[$b];
                $x_ngay_dat[$b] = $temp_x;

                $temp_y = $y_tong_don_hang_ngay[$a];
                $y_tong_don_hang_ngay[$a] = $y_tong_don_hang_ngay[$b];
                $y_tong_don_hang_ngay[$b] = $temp_y;
            }
        }
    }


    /**************************************** thống kê số hóa đơn bán được trong 12 tháng ****************************************/
    $sql_count_donhang_thang = "SELECT ngay_dat, COUNT(id_dh) as tong_don_hang FROM `donhang` GROUP BY SUBSTRING(ngay_dat, 13)";
    $query_count_donhang_thang = mysqli_query($con, $sql_count_donhang_thang);

    $date_he_thong = date('d-m-Y');
    $date_min = date('d-m-Y', strtotime($date_he_thong . '- 12 months'));

    while ($result_count_donhang_thang = mysqli_fetch_array($query_count_donhang_thang)) {
        $ngay_dat = substr($result_count_donhang_thang['ngay_dat'], 9);
        if (strtotime($ngay_dat) >= strtotime($date_min)) {
            $index_sort[] = $ngay_dat; //lưu tạm ngày để sắp xếp ngày tăng dần
            $y_tong_don_hang_thang[] = $result_count_donhang_thang['tong_don_hang'];
            $x_thang_dat[] = substr($ngay_dat, 3);
        }
    }

    for ($a = 0; $a < count($index_sort); $a++) {
        for ($b = $a + 1; $b < count($index_sort); $b++) {
            if (strtotime($index_sort[$a]) > strtotime($index_sort[$b])) {
                $temp = $index_sort[$a];
                $index_sort[$a] = $index_sort[$b];
                $index_sort[$b] = $temp;

                $temp_x = $x_thang_dat[$a];
                $x_thang_dat[$a] = $x_thang_dat[$b];
                $x_thang_dat[$b] = $temp_x;

                $temp_y = $y_tong_don_hang_thang[$a];
                $y_tong_don_hang_thang[$a] = $y_tong_don_hang_thang[$b];
                $y_tong_don_hang_thang[$b] = $temp_y;
            }
        }
    }


    /**************************************** top 5 sản phẩm BÁN CHẠY ****************************************/
    $date_he_thong = date('d-m-Y');
    $date_min = date('d-m-Y', strtotime($date_he_thong . '- 29 days'));

    $sql_donhang = "SELECT SUBSTR(ngay_dat, 9) as ngay_dat, id_dh FROM `donhang`";
    $query_donhang = mysqli_query($con, $sql_donhang);

    $x_name_temp = [];
    $y_tong_so_temp = [];
    while ($result_donhang = mysqli_fetch_array($query_donhang)) {
        $ngay_dat = $result_donhang['ngay_dat'];
        if (strtotime($ngay_dat) >= strtotime($date_min)) {
            $query_chitietdonhang = get_chitietdonhang($result_donhang['id_dh']);
            while ($result_chitietdonhang = mysqli_fetch_array($query_chitietdonhang)) {
                $name_product = get_sanpham($result_chitietdonhang['id_sp']);
                $i = $result_chitietdonhang['id_sp'];
                if (array_key_exists($i, $x_name_temp) == true) {
                    $x_name_temp[$i] = $name_product['ten_sp'];
                    $y_tong_so_temp[$i] += $result_chitietdonhang['so_luong'];
                    $colors_temp[$i] = rand_color();
                } else {
                    $x_name_temp[$i] = $name_product['ten_sp'];
                    $y_tong_so_temp[$i] = $result_chitietdonhang['so_luong'];
                    $colors_temp[$i] = rand_color();
                }
            }
        }
    }

    //gán lại giá trị mảng từ 0 (do biểu đồ nhận mảng bắt đầu bằng 0 => vì biểu đồ ko nhận mảng bị bỏ trống Keys)
    $i = 0;
    foreach ($x_name_temp as $value) {
        $x_name_product[$i] = $value;
        $i++;
    }
    $i = 0;
    foreach ($y_tong_so_temp as $value) {
        $y_tong_so_product[$i] = (int)$value;
        $i++;
    }
    $i = 0;
    foreach ($colors_temp as $value) {
        $colors[$i] = $value;
        $i++;
    }

    //sắp xếp giá trị mảng giảm dần
    for ($a = 0; $a < count($y_tong_so_product); $a++) {
        for ($b = $a + 1; $b < count($y_tong_so_product); $b++) {
            if ($y_tong_so_product[$a] < $y_tong_so_product[$b]) {
                $temp_y = $y_tong_so_product[$a];
                $y_tong_so_product[$a] = $y_tong_so_product[$b];
                $y_tong_so_product[$b] = $temp_y;

                $temp_x = $x_name_product[$a];
                $x_name_product[$a] = $x_name_product[$b];
                $x_name_product[$b] = $temp_x;
            }
        }
    }

    //cắt bỏ mảng chỉ lấy 3 phần tử có số sản phẩm bán chạy nhất (măng sắp theo giảm dần)
    $x_name_product_limit = array_slice($x_name_product, 0, 5);
    $y_tong_so_product_limit = array_slice($y_tong_so_product, 0, 5);
    $colors_limit = array_slice($colors, 0, 5);



    /**************************************** thống kế loại sản phẩm bán nhiều nhất theo tuần ****************************************/
    $date_he_thong = date('d-m-Y');
    $date_min = date('d-m-Y', strtotime($date_he_thong . '- 7 days'));

    $sql_donhang = "SELECT SUBSTR(ngay_dat, 9) as ngay_dat, id_dh FROM `donhang`";
    $query_donhang = mysqli_query($con, $sql_donhang);

    $count_dienthoai = 0;
    $count_tainghe = 0;
    $count_oplung = 0;

    while ($result_donhang = mysqli_fetch_array($query_donhang)) {
        $ngay_dat = $result_donhang['ngay_dat'];
        if (strtotime($ngay_dat) >= strtotime($date_min)) {
            $query_chitietdonhang = get_chitietdonhang($result_donhang['id_dh']);
            while ($result_chitietdonhang = mysqli_fetch_array($query_chitietdonhang)) {
                $sanpham = get_sanpham($result_chitietdonhang['id_sp']);
                switch ($sanpham['id_lsp']) {
                    case "DT":
                        $count_dienthoai += $result_chitietdonhang['so_luong'];
                        break;
                    case "TN":
                        $count_tainghe += $result_chitietdonhang['so_luong'];
                        break;
                    case "OL":
                        $count_oplung += $result_chitietdonhang['so_luong'];
                        break;
                }
            }
        }
    }
}


?>

<!-- hiển thị thống kê -->
<div class="tab-pane fade show tab-pane-header mb-5" id="pills-statistics" role="tabpanel" aria-labelledby="pills-statistics-tab">
    <div class="row mx-auto">
        <!-- thông tin tổng hợp -->
        <div class="col-12 p-2 text-center">
            <div class="bg-white pt-3 pb-3" style="border-radius: 10px;">
                <div class="row ml-1 mr-1">
                    <!-- tổng số điện thoại -->
                    <div class="col-4">
                        <div style="border-radius: 6px; background-color: #c7c7c7;">
                            <?php
                            $sql = "SELECT COUNT(id_sp) as tong_dt FROM `dienthoai`";
                            $query = mysqli_query($con, $sql);
                            $result = mysqli_fetch_array($query);
                            ?>
                            <p class="mb-0" style="font-size: 16px; color: blue; font-weight: bold;">Tổng Số Điện Thoại</p>
                            <p class="mt-0" style="font-size: 20px; color: red; font-weight: bold;">
                                <?php echo money_format($result['tong_dt']) ?>
                            </p>
                        </div>
                    </div>
                    <!-- tổng số tai nghe -->
                    <div class="col-4">
                        <div style="border-radius: 6px; background-color: #c7c7c7;">
                            <?php
                            $sql = "SELECT COUNT(id_sp) as tong_tn FROM `tainghe`";
                            $query = mysqli_query($con, $sql);
                            $result = mysqli_fetch_array($query);
                            ?>
                            <p class="mb-0" style="font-size: 16px; color: blue; font-weight: bold;">Tổng Số Tai Nghe</p>
                            <p class="mt-0" style="font-size: 20px; color: red; font-weight: bold;">
                                <?php echo money_format($result['tong_tn']) ?>
                            </p>
                        </div>
                    </div>
                    <!-- tổng số ốp lưng -->
                    <div class="col-4">
                        <div style="border-radius: 6px; background-color: #c7c7c7;">
                            <?php
                            $sql = "SELECT COUNT(id_sp) as tong_ol FROM `oplung`";
                            $query = mysqli_query($con, $sql);
                            $result = mysqli_fetch_array($query);
                            ?>
                            <p class="mb-0" style="font-size: 16px; color: blue; font-weight: bold;">Tổng Số Ốp Lưng</p>
                            <p class="mt-0" style="font-size: 20px; color: red; font-weight: bold;">
                                <?php echo money_format($result['tong_ol']) ?>
                            </p>
                        </div>
                    </div>
                    <!-- doanh thu hôm qua -->
                    <div class="col-6">
                        <div style="border-radius: 6px; background-color: #c7c7c7;">
                            <?php
                            $date_he_thong = date('d-m-Y');
                            $date = date('d-m-Y', strtotime($date_he_thong. '-1 days'));
                            $tong_tien = 0;
                            $sql = "SELECT * FROM `donhang`";
                            $query = mysqli_query($con, $sql);
                            while($result = mysqli_fetch_array($query)){
                                $id_dh = $result['id_dh'];
                                $ngay_dat = substr($result['ngay_dat'], 9);
                                if(strtotime($ngay_dat) == strtotime($date)){
                                    $sql_chitietdonhang = "SELECT * FROM `chitietdonhang` WHERE id_dh = '$id_dh'";
                                    $query_chitietdonhang = mysqli_query($con, $sql_chitietdonhang);
                                    $result_chitietdonhang = mysqli_fetch_array($query_chitietdonhang);
                                    $khuyenmai = $result_chitietdonhang['khuyen_mai'];
                                    $gia = $result_chitietdonhang['gia'];
                                    $soluong = $result_chitietdonhang['so_luong'];
                                    $thanh_tien = price_after_promotion($gia, $khuyenmai) * $soluong;
                                    $tong_tien += $thanh_tien;
                                }
                            }
                            ?>
                            <p class="mb-0" style="font-size: 16px; color: blue; font-weight: bold;">Doanh Thu Hôm Qua</p>
                            <p class="mt-0" style="font-size: 20px; color: red; font-weight: bold;">
                                <?php
                                if($tong_tien == 0){
                                    echo "Chưa có doanh thu";
                                }else{
                                    echo money_format($tong_tien) . " VNĐ";
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                    <!-- doanh thu hôm nay -->
                    <div class="col-6">
                        <div style="border-radius: 6px; background-color: #c7c7c7;">
                            <?php
                            $date = date('d-m-Y');
                            $tong_tien = 0;
                            $sql = "SELECT * FROM `donhang`";
                            $query = mysqli_query($con, $sql);
                            while($result = mysqli_fetch_array($query)){
                                $id_dh = $result['id_dh'];
                                $ngay_dat = substr($result['ngay_dat'], 9);
                                if(strtotime($ngay_dat) == strtotime($date)){
                                    $sql_chitietdonhang = "SELECT * FROM `chitietdonhang` WHERE id_dh = '$id_dh'";
                                    $query_chitietdonhang = mysqli_query($con, $sql_chitietdonhang);
                                    $result_chitietdonhang = mysqli_fetch_array($query_chitietdonhang);
                                    $khuyenmai = $result_chitietdonhang['khuyen_mai'];
                                    $gia = $result_chitietdonhang['gia'];
                                    $soluong = $result_chitietdonhang['so_luong'];
                                    $thanh_tien = price_after_promotion($gia, $khuyenmai) * $soluong;
                                    $tong_tien += $thanh_tien;
                                }
                            }
                            ?>
                            <p class="mb-0" style="font-size: 16px; color: blue; font-weight: bold;">Doanh Thu Hôm Nay</p>
                            <p class="mt-0" style="font-size: 20px; color: red; font-weight: bold;">
                                <?php
                                if($tong_tien == 0){
                                    echo "Chưa có doanh thu";
                                }else{
                                    echo money_format($tong_tien) . " VNĐ";
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- thống kê tổng đơn hàng trong 7 ngày -->
        <div class="col-6 p-2 text-center">
            <div class="bg-white pt-3 pb-3" style="border-radius: 10px;">
                <p style="font-size: 18px; color: blue; font-weight: bold;">
                    Thống Kê Tổng Số Hóa Đơn Trong Tuần
                    <?php
                    $date = date('d-m-Y');
                    $date_min = date('d-m-Y', strtotime($date . '- 7 days'));
                    echo "( " . $date_min . " đến " . $date . " )";
                    ?>
                </p>
                <canvas class="pl-3 pr-3" id="chart_hoadon_ngay" style="width:100%;"></canvas>
            </div>
        </div>

        <!-- thống kê đơn hàng theo tháng (trong vòng 12 tháng) -->
        <div class="col-6 p-2 text-center">
            <div class="bg-white pt-3 pb-3" style="border-radius: 10px;">
                <p style="font-size: 18px; color: blue; font-weight: bold;">
                    Thống Kê Tổng Số Hóa Đơn 12 tháng (
                    <?php
                    $date = date('d-m-Y');
                    $date_min = date('d-m-Y', strtotime($date . '- 12 months'));
                    echo $date_min . " đến " . $date;
                    ?>
                    )
                </p>
                <canvas class="pl-3 pr-3" id="chart_hoadon_thang" style="width:100%;"></canvas>
            </div>
        </div>

        <!-- thống kê loại sản phẩm bán chạy nhất trong một tuần -->
        <div class="col-4 p-2 text-center">
            <div class="bg-white pt-3 pb-3" style="border-radius: 10px;">
                <p style="font-size: 18px; color: blue; font-weight: bold;">
                    Loại Sản Phẩm Được Mua Nhiều Nhất Trong Tuần <br>
                    <?php
                    $date = date('d-m-Y');
                    $date_min = date('d-m-Y', strtotime($date . '- 7 days'));
                    echo "( " . $date_min . " đến " . $date . " )";
                    ?>
                </p>
                <div id="chart_loai_san_pham" style="width:100%; height: 335px;"> </div>
            </div>
        </div>

        <!-- thống kê 5 sản phẩm bán chạy nhất trong 30 ngày -->
        <div class="col-8 p-2 text-center mx-auto">
            <div class="bg-white pt-3 pb-3" style="border-radius: 10px;">
                <p style="font-size: 18px; color: blue; font-weight: bold;">
                    5 Sản Phẩm Bán Chạy Nhất Trong 30 Ngày(
                    <?php
                    $date = date('d-m-Y');
                    $date_min = date('d-m-Y', strtotime($date . '- 29 days'));
                    echo $date_min . " đến " . $date;
                    ?>
                    )
                </p>
                <canvas class="pl-3 pr-3" id="chart_top_product" style="width:100%;"></canvas>
            </div>
        </div>

    </div>
</div>

<script>
    $(function() {
        // biểu đồ thống kê tổng đơn hàng trong 7 ngày
        var x_ngay_dat = <?php echo json_encode($x_ngay_dat) ?>;
        var y_tong_don_hang_ngay = <?php echo json_encode($y_tong_don_hang_ngay) ?>;
        new Chart("chart_hoadon_ngay", {
            type: "line",
            data: {
                labels: x_ngay_dat,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: y_tong_don_hang_ngay
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0
                        }
                    }],
                }
            }
        });

        // biểu đồ thống kê tổng đơn hàng trong 12 tháng
        var x_thang_dat = <?php echo json_encode($x_thang_dat) ?>;
        var y_tong_don_hang_thang = <?php echo json_encode($y_tong_don_hang_thang) ?>;
        new Chart("chart_hoadon_thang", {
            type: "line",
            data: {
                labels: x_thang_dat,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: y_tong_don_hang_thang
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0
                        }
                    }],
                }
            }
        });

        //biểu đồ thống kê 5 sản phẩm bán chạy nhất
        var x_name_product = <?php echo json_encode($x_name_product_limit) ?>;
        var y_tong_so_product = <?php echo json_encode($y_tong_so_product_limit) ?>;
        var barColors = <?php echo json_encode($colors_limit) ?>;
        new Chart("chart_top_product", {
            type: "bar",
            data: {
                labels: x_name_product,
                datasets: [{
                    backgroundColor: barColors,
                    data: y_tong_so_product
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0
                        }
                    }],
                }
            }
        });



        //biểu đồ thống kê loại sản phẩm bán theo ngày
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        var count_dienthoai = <?php echo json_encode($count_dienthoai) ?>;
        var count_tainghe = <?php echo json_encode($count_tainghe) ?>;
        var count_oplung = <?php echo json_encode($count_oplung) ?>;

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Contry', 'Mhl'],
                ['Điện Thoại', count_dienthoai],
                ['Tai Nghe', count_tainghe],
                ['Ốp Lưng', count_oplung]
            ]);

            var options = {
                title: ""
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_loai_san_pham'));
            chart.draw(data, options);
        }
    })
</script>