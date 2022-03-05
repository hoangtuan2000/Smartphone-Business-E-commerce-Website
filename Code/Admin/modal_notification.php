<!-- modal thông báo cập nhật database khi cập nhật thành công -->
<div class="modal fade" id="modal-notification-success" tabindex="-1" aria-hidden="true">
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
<div class="modal fade" id="modal-notification-fail" tabindex="-1" aria-hidden="true">
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

<!-- modal hiển thị thông tin đơn hàng -->
<div class="modal fade" id="modal-show-donhang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto">Chi Tiết Đơn Hàng</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-content-donhang">
                
            </div>
        </div>
    </div>
</div>