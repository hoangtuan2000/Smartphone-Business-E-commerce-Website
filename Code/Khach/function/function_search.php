<?php
include 'function_connect_db.php';
include 'function_find_database.php';
include 'function_money_format.php';

// trả kết quả cho div gợi ý tìm kiếm
if (isset($_POST['send_search_product'])) {
    $name_product = $_POST['send_search_product'];

    $sql = "SELECT * FROM `sanpham` WHERE ten_sp LIKE '%$name_product%'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num > 0) {
        while ($result = mysqli_fetch_array($query)) {
            $khuyenmai = get_khuyenmai($result['id_km']);
            $gia_old = $result['gia_sp'];
            $gia_new = price_after_promotion($gia_old, $khuyenmai['giam_km']);
?>
            <a href="product_detail.php?id_product=<?php echo $result['id_sp'] ?>">
                <div class="row">
                    <div class="col-3 pr-0 text-center">
                        <img src="<?php echo $result['anh_sp'] ?>" alt="" class="img-thumbnail m-1" style="width: 80px; height: 80px;">
                    </div>
                    <div class="col-9 pl-0">
                        <p class="mb-0 mt-3">
                        <?php echo $result['ten_sp']; ?>
                        </p>
                        <p class="mb-0 text-danger">
                            <?php echo money_format($gia_new)." VNĐ (Giảm ".$khuyenmai['giam_km']."%)" ?>
                        </p>
                    </div>
                </div>
            </a>
            <hr class="m-0">

<?php
        }
    } else {
        echo "Chưa Tìm Thấy Gợi Ý Phù Hợp";
    }
}
