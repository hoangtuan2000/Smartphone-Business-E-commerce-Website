<?php
include 'function_connect_db.php';
include 'function_money_format.php';
include 'function_find_database.php';

//hiển trị trong modal show đơn hàng
if (isset($_POST['send_show_donhang_id'])) {
    $id_dh =  $_POST['send_show_donhang_id'];

    $result_donhang = get_donhang($id_dh);
    $trangthaidonhang = get_trangthaidonhang($result_donhang['id_ttdh']);
?>
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th style="width: 10px;">ID</th>
                <th></th>
                <th>Tên Sản Phẩm</th>
                <th style="width: 100px;">Loại</th>
                <th style="width: 100px;">Số Lượng</th>
                <th>Giá</th>
                <th>Thành Tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query_chitietgiohang = get_chitietdonhang($result_donhang['id_dh']);
            $tong_tien_donhang = 0;
            while ($result_chitietdonhang = mysqli_fetch_array($query_chitietgiohang)) {
                $product = get_sanpham($result_chitietdonhang['id_sp']);
                $loaisanpham = get_loaisanpham($product['id_lsp']);
                $loaisanpham = $loaisanpham['ten_lsp'];
                $khuyen_mai = $result_chitietdonhang['khuyen_mai'];
                $gia = $result_chitietdonhang['gia'];
                $so_luong = $result_chitietdonhang['so_luong'];
                $thanh_tien = $gia * $so_luong;
                $tong_tien_donhang += $thanh_tien;
            ?>
                <tr>
                    <td class="align-middle"><?php echo $product['id_sp'] ?></td>
                    <td class="align-middle" style="width: 80px;">
                        <img src="<?php echo $product['anh_sp']; ?>" alt="" class="img-thumbnail" style="width: 70px; height: 75px;">
                    </td>
                    <td class="align-middle"><?php echo $product['ten_sp'] ?></td>
                    <td class="align-middle"><?php echo $loaisanpham ?></td>
                    <td class="align-middle"><?php echo $result_chitietdonhang['so_luong'] ?></td>
                    <td class="align-middle"><?php echo money_format($gia) ?> VNĐ</td>
                    <td class="align-middle text-right"><?php echo money_format($thanh_tien) ?> VNĐ</td>
                </tr>
            <?php
            }
            $tong_tien_donhang = money_format($tong_tien_donhang);
            ?>
            <tr>
                <td colspan="7" class="text-right"><b style="color: red;">Tổng Tiền: </b><?php echo $tong_tien_donhang ?> VNĐ</td>
            </tr>
        </tbody>
    </table>
    <?php
    ?>
    <form>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-2">
                    <label>Mã Đơn Hàng:</label>
                    <input value="<?php echo $result_donhang['id_dh'] ?>" readonly type="text" class="form-control">
                </div>
                <div class="form-group col-2">
                    <label>Ngày Đặt</label>
                    <input value="<?php echo $result_donhang['ngay_dat'] ?>" readonly type="text" class="form-control">
                </div>
                <div class="form-group col-4">
                    <label>Người Nhận</label>
                    <input value="<?php echo $result_donhang['nguoi_nhan'] ?>" readonly type="text" class="form-control">
                </div>
                <div class="form-group col-4">
                    <label>Số Điện Thoại</label>
                    <input value="<?php echo $result_donhang['so_dien_thoai'] ?>" readonly type="text" class="form-control">
                </div>
            </div>

            <label>Địa Chỉ Giao Hàng</label>
            <input value="<?php echo $result_donhang['dia_chi_giao'] ?>" readonly type="text" class="form-control">
            <label>Ghi Chú</label>
            <textarea value="<?php echo $result_donhang['ghi_chu'] ?>" readonly type="text" class="form-control"></textarea>
            <label>Thành Tiền</label>
            <input value="<?php echo $tong_tien_donhang ?> VNĐ" readonly type="text" class="form-control">

            <div class="form-row">
                <div class="form-group col-4">
                    <label>ID Khách Hàng</label>
                    <input value="<?php echo $result_donhang['id_kh'] ?>" readonly type="text" class="form-control">
                </div>
                <div class="form-group col-4">
                    <label>ID Nhân Viên Cập Nhật Lần Cuối</label>
                    <?php
                    if ($result_donhang['id_nv'] == null) {
                    ?>
                        <input value="Chưa Có Nhân Viên Nào Cập Nhật" readonly type="text" class="form-control">
                    <?php
                    } else {
                    ?>
                        <input value="<?php echo $result_donhang['id_nv'] ?>" readonly type="text" class="form-control">
                    <?php
                    }
                    ?>

                </div>
                <div class="form-group col-4">
                    <label>Trạng Thái Đơn Hàng</label>
                    <input value="<?php echo $trangthaidonhang['ten_ttdh'] ?>" readonly type="text" class="form-control">
                </div>
            </div>
        </div>
    </form>
<?php
}


//cập nhật trạng thái sản phẩm
if (isset($_POST['send_update_donhang_id'])) {
    $id_dh = $_POST['send_update_donhang_id'];
    $id_ttdh = $_POST['send_update_donhang_id_ttdh'];
    $id_nv = $_POST['send_update_donhang_id_nv'];

    $sql_update_donhang = "UPDATE `donhang` SET `id_ttdh`='$id_ttdh', `id_nv`='$id_nv' WHERE id_dh = '$id_dh'";
    $query_update_donhang = mysqli_query($con, $sql_update_donhang);
    if ($query_update_donhang == true) {
        echo "success";
    } else {
        echo "fail";
    }
}
