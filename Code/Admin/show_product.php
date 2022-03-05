<!-- hiển thị sản phẩm -->
<div class="tab-pane fade show active tab-pane-header" id="pills-product" role="tabpanel" aria-labelledby="pills-product-tab">

    <div class="row">
        <div class="col-2">
            <div class="nav flex-column nav-pills bg-secondary rounded" id="v-pills-tab-product" role="tablist" aria-orientation="vertical">
                <a class="tab-item-product text-white nav-link active" data-tab="v-pills-smartphone" id="v-pills-smartphone-tab" data-toggle="pill" href="#v-pills-smartphone" role="tab" aria-controls="v-pills-smartphone" aria-selected="true">Điện Thoại</a>
                <a class="tab-item-product text-white nav-link" data-tab="v-pills-headphone" id="v-pills-headphone-tab" data-toggle="pill" href="#v-pills-headphone" role="tab" aria-controls="v-pills-headphone" aria-selected="false">Tai Nghe</a>
                <a class="tab-item-product text-white nav-link" data-tab="v-pills-phonecase" id="v-pills-phonecase-tab" data-toggle="pill" href="#v-pills-phonecase" role="tab" aria-controls="v-pills-phonecase" aria-selected="false">Ốp Lưng</a>
            </div>
        </div>
        <div class="col-10">
            <div class="tab-content" id="v-pills-tabContent">
                <!-- khung hien thi ĐIỆN THOẠI -->
                <div class="tab-pane-item-product tab-pane fade show active" id="v-pills-smartphone" role="tabpanel" aria-labelledby="v-pills-smartphone-tab">
                    <!-- nút thêm điện thoại -->
                    <a href="insert_product.php?insert_product=smartphone" class="btn btn-success mb-3">
                        Thêm Điện Thoại
                    </a>

                    <!-- input tìm điện thoại -->
                    <input class="form-control" id="input-smartphone-search" type="text" placeholder="Tìm Điện Thoại...">
                    <br>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 60px;">STT</th>
                                <th>Ảnh</th>
                                <th>Tên Điện Thoại</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th style="width: 175px;">Cập Nhật</th>
                            </tr>
                        </thead>
                        <tbody id="table-smartphone">
                            <?php
                            $num_sanpham_dienthoai = mysqli_num_rows($query_sanpham_dienthoai);
                            if ($num_sanpham_dienthoai > 0) {
                                $stt = 1;
                                while ($result_sanpham_dienthoai = mysqli_fetch_array($query_sanpham_dienthoai)) {
                                    $gia = money_format($result_sanpham_dienthoai['gia_sp']);
                                    $so_luong = money_format($result_sanpham_dienthoai['so_luong_sp']);
                            ?>
                                    <tr>
                                        <td class="align-middle"><?php echo $stt; ?></td>
                                        <td class="align-middle">
                                            <img src="<?php echo $result_sanpham_dienthoai['anh_sp']; ?>" alt="" class="table-image-product">
                                        </td>
                                        <td class="align-middle"><?php echo $result_sanpham_dienthoai['ten_sp']; ?></td>
                                        <td class="align-middle"><?php echo $gia; ?></td>
                                        <td class="align-middle"><?php echo $so_luong; ?></td>
                                        <td class="align-middle">
                                            <a href="update_product.php?update_product=smartphone&&id_sp=<?php echo $result_sanpham_dienthoai['id_sp']; ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                Cập Nhật
                                            </a>
                                            <!-- hiện modal chấp nhận xóa bên file javascript-ajax-delete-product.js -->
                                            <!-- <button type="button" name="delete_smartphone" class="btn btn-danger btn-sm" value="<?php echo $result_sanpham_dienthoai['id_sp']; ?>">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                Xóa
                                            </button> -->
                                        </td>
                                    </tr>
                                <?php
                                    $stt++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">
                                        <h3>Chưa Có Dữ Liệu</h3>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- khung hien thi TAI NGHE -->
                <div class="tab-pane-item-product tab-pane fade" id="v-pills-headphone" role="tabpanel" aria-labelledby="v-pills-headphone-tab">
                    <!-- nút thêm tai nghe -->
                    <a href="insert_product.php?insert_product=headphone" class="btn btn-success mb-3">
                        Thêm Tai Nghe
                    </a>

                    <!-- input tìm tai nghe -->
                    <input class="form-control" id="input-headphone-search" type="text" placeholder="Tìm Tai Nghe...">
                    <br>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 60px;">STT</th>
                                <th>Ảnh</th>
                                <th>Tên Tai Nghe</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th style="width: 175px;">Cập Nhật</th>
                            </tr>
                        </thead>
                        <tbody id="table-headphone">
                            <?php
                            $num_sanpham_tainghe = mysqli_num_rows($query_sanpham_tainghe);
                            if ($num_sanpham_tainghe > 0) {
                                $stt = 1;
                                while ($result_sanpham_tainghe = mysqli_fetch_array($query_sanpham_tainghe)) {
                                    $gia = money_format($result_sanpham_tainghe['gia_sp']);
                                    $so_luong = money_format($result_sanpham_tainghe['so_luong_sp']);
                            ?>
                                    <tr>
                                        <td class="align-middle"><?php echo $stt; ?></td>
                                        <td class="align-middle">
                                            <img src="<?php echo $result_sanpham_tainghe['anh_sp']; ?>" alt="" class="table-image-product">
                                        </td>
                                        <td class="align-middle"><?php echo $result_sanpham_tainghe['ten_sp']; ?></td>
                                        <td class="align-middle"><?php echo $gia; ?></td>
                                        <td class="align-middle"><?php echo $so_luong; ?></td>
                                        <td class="align-middle">
                                            <a href="update_product.php?update_product=headphone&&id_sp=<?php echo $result_sanpham_tainghe['id_sp']; ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                Cập Nhật
                                            </a>
                                            <!-- hiện modal chấp nhận xóa bên file javascript-ajax-delete-product.js -->
                                            <!-- <button type="button" name="delete_headphone" class="btn btn-danger btn-sm" value="<?php echo $result_sanpham_tainghe['id_sp']; ?>">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                Xóa
                                            </button> -->
                                        </td>
                                    </tr>
                                <?php
                                    $stt++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">
                                        <h3>Chưa Có Dữ Liệu</h3>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- hien thi ỐP LƯNG -->
                <div class="tab-pane-item-product tab-pane fade" id="v-pills-phonecase" role="tabpanel" aria-labelledby="v-pills-phonecase-tab">
                    <!-- nút thêm Ốp Lưng -->
                    <a href="insert_product.php?insert_product=phonecase" class="btn btn-success mb-3">
                        Thêm Ốp Lưng
                    </a>

                    <!-- input tìm Ốp Lưng -->
                    <input class="form-control" id="input-phonecase-search" type="text" placeholder="Tìm Ốp Lưng...">
                    <br>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 60px;">STT</th>
                                <th>Ảnh</th>
                                <th>Tên Ốp Lưng</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th style="width: 175px;">Cập Nhật</th>
                            </tr>
                        </thead>
                        <tbody id="table-phonecase">
                            <?php
                            $stt = 1;
                            $num_sanpham_oplung = mysqli_num_rows($query_sanpham_oplung);
                            if ($num_sanpham_oplung > 0) {
                                while ($result_sanpham_oplung = mysqli_fetch_array($query_sanpham_oplung)) {
                                    $gia = money_format($result_sanpham_oplung['gia_sp']);
                                    $so_luong = money_format($result_sanpham_oplung['so_luong_sp']);
                            ?>
                                    <tr>
                                        <td class="align-middle"><?php echo $stt; ?></td>
                                        <td class="align-middle">
                                            <img src="<?php echo $result_sanpham_oplung['anh_sp']; ?>" alt="" class="table-image-product">
                                        </td>
                                        <td class="align-middle"><?php echo $result_sanpham_oplung['ten_sp']; ?></td>
                                        <td class="align-middle"><?php echo $gia; ?></td>
                                        <td class="align-middle"><?php echo $so_luong; ?></td>
                                        <td class="align-middle">
                                            <a href="update_product.php?update_product=phonecase&&id_sp=<?php echo $result_sanpham_oplung['id_sp']; ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                Cập Nhật
                                            </a>
                                            <!-- hiện modal chấp nhận xóa bên file javascript-ajax-delete-product.js -->
                                            <!-- <button type="button" name="delete_phonecase" class="btn btn-danger btn-sm" value="<?php echo $result_sanpham_oplung['id_sp']; ?>">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                Xóa
                                            </button> -->
                                        </td>
                                    </tr>
                                <?php
                                    $stt++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">
                                        <h3>Chưa Có Dữ Liệu</h3>
                                    </td>
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

</div>