<!-- modal thông báo cập nhật database khi cập nhật thành công -->
<div class="modal fade" id="modal-notification-success" tabindex="-1" aria-hidden="true" style="z-index:  99999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto">Thông Báo</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="notification-content-success" class="alert alert-success text-center" role="alert">
                    <!-- trong này chứa nội dung thông báo gửi từ javascript-ajax-update-database -->
                </div>
            </div>
            <div class="modal-footer">
                <!-- hiển thị nút trở về trang manage.php -->
            </div>
        </div>
    </div>
</div>

<!-- modal thông báo lỗi khi cập nhật database -->
<div class="modal fade" id="modal-notification-fail" tabindex="-1" aria-hidden="true" style="z-index:  99999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto text-danger">Cảnh Báo Lỗi</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="notification-content-fail" class="alert alert-danger text-center" role="alert">
                    <!-- trong này chứa nội dung thông báo gửi từ javascript-ajax-update-database -->
                </div>
            </div>
            <div class="modal-footer">
                <!-- hiển thị nút trở về trang manage.php -->
            </div>
        </div>
    </div>
</div>

<!-- modal thông báo chấp nhận xóa database -->
<div class="modal fade" id="modal-notification-delete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto text-danger">Cảnh Báo !!!</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center" role="alert">
                    Chắc chắc bạn muốn xóa???
                </div>
            </div>
            <div class="modal-footer" id="modal-content-delete">
                <!-- hiển thị nút xóa và hủy -->
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_SESSION['user'])) {
?>
    <!-- modal cập nhật địa chỉ -->
    <div class="modal fade" id="modal_update_diachi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto">Cập Nhật Địa Chỉ</h5>
                    <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_content_update_diachi">
                    <!-- hiển thị tỉnh huyện xã -->
                </div>
                <div class="modal-footer">
                    <!-- hiển thị nút xóa và hủy -->
                </div>
            </div>
        </div>
    </div>

    <!-- modal xem tất cả đơn hàng -->
    <div class="modal fade" id="modal_donhang" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <?php
                    $query_donhang = get_all_donhang($_SESSION['user']['id_kh']);
                    $num = mysqli_num_rows($query_donhang);
                    ?>
                    <h5 class="modal-title mx-auto">Tất Cả Đơn Hàng (<?php echo $num ?>)</h5>
                    <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="modal_content_donhang">

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 100px;">Đơn Hàng</th>
                                <th class="text-center">Tên Sản Phẩm</th>
                                <th class="text-center" style="width: 160px;">Ngày Đặt</th>
                                <th class="text-center">Tổng Tiền</th>
                                <th class="text-center" style="width: 100px;">Chi Tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query_donhang = get_all_donhang($_SESSION['user']['id_kh']);
                            $num = mysqli_num_rows($query_donhang);
                            if ($num > 0) {
                                while ($result_donhang = mysqli_fetch_array($query_donhang)) {
                                    $id_dh = $result_donhang['id_dh'];
                                    $query_chitietdonhang = get_chitietdonhang($id_dh);
                                    $tong_tien = 0;
                            ?>
                                    <tr>
                                        <td class="align-middle text-center"><?php echo $result_donhang['id_dh'] ?></td>
                                        <td class="align-middle">
                                            <ul class="pl-3 mb-0">
                                                <?php
                                                while ($result_chitietdonhang = mysqli_fetch_array($query_chitietdonhang)) {
                                                    $so_luong = $result_chitietdonhang['so_luong'];
                                                    $gia_old = $result_chitietdonhang['gia'];
                                                    $khuyenmai = $result_chitietdonhang['khuyen_mai'];
                                                    $gia_new = price_after_promotion($gia_old, $khuyenmai);
                                                    $tong_tien += $gia_new * $so_luong;
                                                    $id_sp = $result_chitietdonhang['id_sp'];
                                                    $product = get_sanpham($id_sp);
                                                ?>
                                                    <li><?php echo $product['ten_sp'] ?></li>
                                                <?php
                                                }
                                                $tong_tien = money_format($tong_tien);
                                                ?>
                                            </ul>
                                        </td>
                                        <td class="align-middle"><?php echo $result_donhang['ngay_dat'] ?></td>
                                        <td class="text-right align-middle"><?php echo $tong_tien ?> VND</td>
                                        <td class="align-middle">
                                            <a href="order_detail.php?id_dh=<?php echo $result_donhang['id_dh'] ?>" class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                xem
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            <?php
                            } else {
                            ?>
                                <tr>
                                    <td colspan="3"><b>Bạn Chưa Có Đơn Hàng Nào</b></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- modal đổi mật khẩu -->
    <div class="modal fade" id="modal_matkhau" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto">Thay Đổi Mật Khẩu</h5>
                    <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pl-5 pr-5" id="modal_content_matkhau">
                    <!-- hiển thị thông báo lỗi -->
                    <div id="show_error"> </div>


                    <div class="form-group">
                        <label for="update_password_matkhau_cu">Mật Khẩu Cũ:</label>
                        <input id="update_password_matkhau_cu" type="password" class="form-control form-control-sm" placeholder="Nhập mật khẩu cũ">

                        <label for="update_password_matkhau_moi">Mật Khẩu Mới:</label>
                        <input id="update_password_matkhau_moi" type="password" class="form-control form-control-sm" placeholder="Nhập mật khẩu mới">
                        <small id="update_password_matkhau_moi_help" class="form-text text-danger"></small>

                        <div class="col-12 mt-3 text-center">
                            <button id="btn-update-password" class="btn btn-warning btn-sm w-25">
                                Xác Nhận
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>