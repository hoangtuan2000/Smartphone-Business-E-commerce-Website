<div class="tab-pane fade show tab-pane-header" id="pills-order" role="tabpanel" aria-labelledby="pills-order-tab">
    <div class="row">
        <div class="col-12">
            <div class="nav nav-pills bg-secondary rounded mb-2" id="pills-tab-order" role="tablist">
                <a class="tab-item-order nav-link active text-white" data-tab="pills-all-order" id="pills-all-order-tab" data-toggle="pill" href="#pills-all-order" role="tab" aria-controls="pills-all-order" aria-selected="true">Tất Cả Đơn Hàng</a>
                <a class="tab-item-order nav-link text-white" data-tab="pills-order-chuaxuly" id="pills-order-chuaxuly-tab" data-toggle="pill" href="#pills-order-chuaxuly" role="tab" aria-controls="pills-order-chuaxuly" aria-selected="false">Chưa Xử Lý</a>
                <a class="tab-item-order nav-link text-white" data-tab="pills-order-daxuly" id="pills-order-daxuly-tab" data-toggle="pill" href="#pills-order-daxuly" role="tab" aria-controls="pills-order-daxuly" aria-selected="false">Đã Xử Lý</a>
                <a class="tab-item-order nav-link text-white" data-tab="pills-order-dangvanchuyen" id="pills-order-dangvanchuyen-tab" data-toggle="pill" href="#pills-order-dangvanchuyen" role="tab" aria-controls="pills-order-dangvanchuyen" aria-selected="false">Đang Vận Chuyển</a>
                <a class="tab-item-order nav-link text-white" data-tab="pills-order-danggiaohang" id="pills-order-danggiaohang-tab" data-toggle="pill" href="#pills-order-danggiaohang" role="tab" aria-controls="pills-order-danggiaohang" aria-selected="false">Đang Giao Hàng</a>
                <a class="tab-item-order nav-link text-white" data-tab="pills-order-giaothanhcong" id="pills-order-giaothanhcong-tab" data-toggle="pill" href="#pills-order-giaothanhcong" role="tab" aria-controls="pills-order-giaothanhcong" aria-selected="false">Giao Hàng Thành Công</a>
            </div>
        </div>
        <div class="col-12">
            <div class="tab-content rounded">
                <!-- lưu id Nhân Viên -->
                <input id="id_nv" value="<?php echo $_SESSION['current_user']['id_nv'] ?>" type="text" hidden>

                <!-- hiện tất cả hóa đơn -->
                <div class="tab-pane-item-order tab-pane fade show active" id="pills-all-order" role="tabpanel" aria-labelledby="pills-all-order-tab">
                    <!-- input tìm nhân viên -->
                    <input class="form-control" id="input-order-all-search" type="text" placeholder="Tìm Đơn Hàng...">
                    <br>

                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 15px;">ID</th>
                                <th>Nguời Nhận</th>
                                <th style="width: 160px;">Ngày Đặt</th>
                                <th>Tổng Tiền</th>
                                <th>Trạng Thái Đơn Hàng</th>
                                <th style="width: 90px;">Chi Tiết</th>
                            </tr>
                        </thead>
                        <tbody id="table-order-all">
                            <?php
                            $num = mysqli_num_rows($query_donhang);
                            if ($num > 0) {
                                while ($result_donhang = mysqli_fetch_array($query_donhang)) {
                                    $query_chitietgiohang = get_chitietdonhang($result_donhang['id_dh']);
                                    $tong_tien = 0;
                                    while ($result_chitietdonhang = mysqli_fetch_array($query_chitietgiohang)) {
                                        $khuyen_mai = $result_chitietdonhang['khuyen_mai'];
                                        $gia = $result_chitietdonhang['gia'];
                                        $so_luong = $result_chitietdonhang['so_luong'];
                                        $thanh_tien = $gia * $so_luong;
                                        $tong_tien += $thanh_tien;
                                    }
                                    $tong_tien = money_format($tong_tien);
                            ?>
                                    <tr>
                                        <td><?php echo $result_donhang['id_dh'] ?></td>
                                        <td><?php echo $result_donhang['nguoi_nhan'] ?></td>
                                        <td><?php echo $result_donhang['ngay_dat'] ?></td>
                                        <td><?php echo $tong_tien ?> VNĐ</td>
                                        <td style="width: 300px;">
                                            <select name="update_donhang_all_<?php echo $result_donhang['id_dh'] ?>" class="rounded">
                                                <?php
                                                //hien thi database table TRANG THAI ĐƠN HÀNG
                                                $sql_trangthaidonhang = "SELECT * FROM `trangthaidonhang` ORDER BY id_ttdh ASC";
                                                $query_trangthaidonhang = mysqli_query($con, $sql_trangthaidonhang);
                                                while ($result_ttdh = mysqli_fetch_array($query_trangthaidonhang)) {
                                                    if ($result_ttdh['id_ttdh'] == $result_donhang['id_ttdh']) {
                                                ?>
                                                        <option selected value="<?php echo $result_ttdh['id_ttdh'] ?>"><?php echo $result_ttdh['ten_ttdh'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $result_ttdh['id_ttdh'] ?>"><?php echo $result_ttdh['ten_ttdh'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <button name="update_donhang_all" value="<?php echo $result_donhang['id_dh'] ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                cập nhật
                                            </button>
                                        </td>
                                        <td>
                                            <button name="btn-modal-show-donhang" class="btn btn-success btn-sm" value="<?php echo $result_donhang['id_dh'] ?>">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                Xem
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">
                                        <h4>Chưa Có Đơn Hàng Nào</h4>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- hiện hóa đơn CHƯA XỬ LÝ -->
                <div class="tab-pane-item-order tab-pane fade" id="pills-order-chuaxuly" role="tabpanel" aria-labelledby="pills-order-chuaxuly-tab">
                    <!-- input tìm đơn hàng -->
                    <input class="form-control" id="input-order-chuaxuly-search" type="text" placeholder="Tìm Đơn Hàng Chưa Xử Lý...">
                    <br>

                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nguời Nhận</th>
                                <th>Ngày Đặt</th>
                                <th>Tổng Tiền</th>
                                <th>Trạng Thái Đơn Hàng</th>
                                <th>Cập Nhật</th>
                            </tr>
                        </thead>
                        <tbody id="table-order-chuaxuly">
                            <?php
                            $num = mysqli_num_rows($query_donhang_chuaxuly);
                            if ($num > 0) {
                                while ($result_donhang_chuaxuly = mysqli_fetch_array($query_donhang_chuaxuly)) {
                                    $query_chitietgiohang = get_chitietdonhang($result_donhang_chuaxuly['id_dh']);
                                    $tong_tien = 0;
                                    while ($result_chitietdonhang = mysqli_fetch_array($query_chitietgiohang)) {
                                        $khuyen_mai = $result_chitietdonhang['khuyen_mai'];
                                        $gia = $result_chitietdonhang['gia'];
                                        $so_luong = $result_chitietdonhang['so_luong'];
                                        $thanh_tien = $gia * $so_luong;
                                        $tong_tien += $thanh_tien;
                                    }
                                    $tong_tien = money_format($tong_tien);
                            ?>
                                    <tr>
                                        <td><?php echo $result_donhang_chuaxuly['id_dh'] ?></td>
                                        <td><?php echo $result_donhang_chuaxuly['nguoi_nhan'] ?></td>
                                        <td><?php echo $result_donhang_chuaxuly['ngay_dat'] ?></td>
                                        <td><?php echo $tong_tien ?> VNĐ</td>
                                        <td style="width: 300px;">
                                            <select name="update_donhang_chuaxuly_<?php echo $result_donhang_chuaxuly['id_dh'] ?>" class="rounded">
                                                <?php
                                                //hien thi database table TRANG THAI ĐƠN HÀNG
                                                $sql_trangthaidonhang = "SELECT * FROM `trangthaidonhang` ORDER BY id_ttdh ASC";
                                                $query_trangthaidonhang = mysqli_query($con, $sql_trangthaidonhang);
                                                while ($result_ttdh = mysqli_fetch_array($query_trangthaidonhang)) {
                                                    if ($result_ttdh['id_ttdh'] == $result_donhang_chuaxuly['id_ttdh']) {
                                                ?>
                                                        <option selected value="<?php echo $result_ttdh['id_ttdh'] ?>"><?php echo $result_ttdh['ten_ttdh'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $result_ttdh['id_ttdh'] ?>"><?php echo $result_ttdh['ten_ttdh'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <button name="update_donhang_chuaxuly" value="<?php echo $result_donhang_chuaxuly['id_dh'] ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                cập nhật
                                            </button>
                                        </td>
                                        <td style="width: 100px;">
                                            <button name="btn-modal-show-donhang" class="btn btn-success btn-sm" value="<?php echo $result_donhang_chuaxuly['id_dh'] ?>">
                                                Xem
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">
                                        <h4>Chưa Có Đơn Hàng Nào</h4>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- hiện hóa đơn ĐÃ XỬ LÝ -->
                <div class="tab-pane-item-order tab-pane fade" id="pills-order-daxuly" role="tabpanel" aria-labelledby="pills-order-daxuly-tab">
                    <!-- input tìm đơn hàng -->
                    <input class="form-control" id="input-order-daxuly-search" type="text" placeholder="Tìm Đơn Hàng Đã Xử Lý...">
                    <br>

                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nguời Nhận</th>
                                <th>Ngày Đặt</th>
                                <th>Tổng Tiền</th>
                                <th>Trạng Thái Đơn Hàng</th>
                                <th>Cập Nhật</th>
                            </tr>
                        </thead>
                        <tbody id="table-order-daxuly">
                            <?php
                            $num = mysqli_num_rows($query_donhang_daxuly);
                            if ($num > 0) {
                                while ($result_donhang_daxuly = mysqli_fetch_array($query_donhang_daxuly)) {
                                    $query_chitietgiohang = get_chitietdonhang($result_donhang_daxuly['id_dh']);
                                    $tong_tien = 0;
                                    while ($result_chitietdonhang = mysqli_fetch_array($query_chitietgiohang)) {
                                        $khuyen_mai = $result_chitietdonhang['khuyen_mai'];
                                        $gia = $result_chitietdonhang['gia'];
                                        $so_luong = $result_chitietdonhang['so_luong'];
                                        $thanh_tien = $gia * $so_luong;
                                        $tong_tien += $thanh_tien;
                                    }
                                    $tong_tien = money_format($tong_tien);
                            ?>
                                    <tr>
                                        <td><?php echo $result_donhang_daxuly['id_dh'] ?></td>
                                        <td><?php echo $result_donhang_daxuly['nguoi_nhan'] ?></td>
                                        <td><?php echo $result_donhang_daxuly['ngay_dat'] ?></td>
                                        <td><?php echo $tong_tien ?> VNĐ</td>
                                        <td style="width: 300px;">
                                            <select name="update_donhang_daxuly_<?php echo $result_donhang_daxuly['id_dh'] ?>" class="rounded">
                                                <?php
                                                //hien thi database table TRANG THAI ĐƠN HÀNG
                                                $sql_trangthaidonhang = "SELECT * FROM `trangthaidonhang` ORDER BY id_ttdh ASC";
                                                $query_trangthaidonhang = mysqli_query($con, $sql_trangthaidonhang);
                                                while ($result_ttdh = mysqli_fetch_array($query_trangthaidonhang)) {
                                                    if ($result_ttdh['id_ttdh'] == $result_donhang_daxuly['id_ttdh']) {
                                                ?>
                                                        <option selected value="<?php echo $result_ttdh['id_ttdh'] ?>"><?php echo $result_ttdh['ten_ttdh'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $result_ttdh['id_ttdh'] ?>"><?php echo $result_ttdh['ten_ttdh'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <button name="update_donhang_daxuly" value="<?php echo $result_donhang_daxuly['id_dh'] ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                cập nhật
                                            </button>
                                        </td>
                                        <td style="width: 100px;">
                                            <button name="btn-modal-show-donhang" class="btn btn-success btn-sm" value="<?php echo $result_donhang_daxuly['id_dh'] ?>">
                                                Xem
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">
                                        <h4>Chưa Có Đơn Hàng Nào</h4>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- hiện hóa đơn ĐANG VẬN CHUYỂN -->
                <div class="tab-pane-item-order tab-pane fade" id="pills-order-dangvanchuyen" role="tabpanel" aria-labelledby="pills-order-dangvanchuyen-tab">
                    <!-- input tìm đơn hàng -->
                    <input class="form-control" id="input-order-dangvanchuyen-search" type="text" placeholder="Tìm Đơn Hàng Đang Vận Chuyển...">
                    <br>

                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nguời Nhận</th>
                                <th>Ngày Đặt</th>
                                <th>Tổng Tiền</th>
                                <th>Trạng Thái Đơn Hàng</th>
                                <th>Cập Nhật</th>
                            </tr>
                        </thead>
                        <tbody id="table-order-dangvanchuyen">
                            <?php
                            $num = mysqli_num_rows($query_donhang_dangvanchuyen);
                            if ($num > 0) {
                                while ($result_donhang_dangvanchuyen = mysqli_fetch_array($query_donhang_dangvanchuyen)) {
                                    $query_chitietgiohang = get_chitietdonhang($result_donhang_dangvanchuyen['id_dh']);
                                    $tong_tien = 0;
                                    while ($result_chitietdonhang = mysqli_fetch_array($query_chitietgiohang)) {
                                        $khuyen_mai = $result_chitietdonhang['khuyen_mai'];
                                        $gia = $result_chitietdonhang['gia'];
                                        $so_luong = $result_chitietdonhang['so_luong'];
                                        $thanh_tien = $gia * $so_luong;
                                        $tong_tien += $thanh_tien;
                                    }
                                    $tong_tien = money_format($tong_tien);
                            ?>
                                    <tr>
                                        <td><?php echo $result_donhang_dangvanchuyen['id_dh'] ?></td>
                                        <td><?php echo $result_donhang_dangvanchuyen['nguoi_nhan'] ?></td>
                                        <td><?php echo $result_donhang_dangvanchuyen['ngay_dat'] ?></td>
                                        <td><?php echo $tong_tien ?> VNĐ</td>
                                        <td style="width: 300px;">
                                            <select name="update_donhang_dangvanchuyen_<?php echo $result_donhang_dangvanchuyen['id_dh'] ?>" class="rounded">
                                                <?php
                                                //hien thi database table TRANG THAI ĐƠN HÀNG
                                                $sql_trangthaidonhang = "SELECT * FROM `trangthaidonhang` ORDER BY id_ttdh ASC";
                                                $query_trangthaidonhang = mysqli_query($con, $sql_trangthaidonhang);
                                                while ($result_ttdh = mysqli_fetch_array($query_trangthaidonhang)) {
                                                    if ($result_ttdh['id_ttdh'] == $result_donhang_dangvanchuyen['id_ttdh']) {
                                                ?>
                                                        <option selected value="<?php echo $result_ttdh['id_ttdh'] ?>"><?php echo $result_ttdh['ten_ttdh'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $result_ttdh['id_ttdh'] ?>"><?php echo $result_ttdh['ten_ttdh'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <button name="update_donhang_dangvanchuyen" value="<?php echo $result_donhang_dangvanchuyen['id_dh'] ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                cập nhật
                                            </button>
                                        </td>
                                        <td style="width: 100px;">
                                            <button name="btn-modal-show-donhang" class="btn btn-success btn-sm" value="<?php echo $result_donhang_dangvanchuyen['id_dh'] ?>">
                                                Xem
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">
                                        <h4>Chưa Có Đơn Hàng Nào</h4>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- hiện hóa đơn ĐANG GIAO HÀNG -->
                <div class="tab-pane-item-order tab-pane fade" id="pills-order-danggiaohang" role="tabpanel" aria-labelledby="pills-order-danggiaohang-tab">
                    <!-- input tìm đơn hàng -->
                    <input class="form-control" id="input-order-danggiaohang-search" type="text" placeholder="Tìm Đơn Hàng Đang Giao Hàng...">
                    <br>

                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nguời Nhận</th>
                                <th>Ngày Đặt</th>
                                <th>Tổng Tiền</th>
                                <th>Trạng Thái Đơn Hàng</th>
                                <th>Cập Nhật</th>
                            </tr>
                        </thead>
                        <tbody id="table-order-danggiaohang">
                            <?php
                            $num = mysqli_num_rows($query_donhang_danggiaohang);
                            if ($num > 0) {
                                while ($result_donhang_danggiaohang = mysqli_fetch_array($query_donhang_danggiaohang)) {
                                    $query_chitietgiohang = get_chitietdonhang($result_donhang_danggiaohang['id_dh']);
                                    $tong_tien = 0;
                                    while ($result_chitietdonhang = mysqli_fetch_array($query_chitietgiohang)) {
                                        $khuyen_mai = $result_chitietdonhang['khuyen_mai'];
                                        $gia = $result_chitietdonhang['gia'];
                                        $so_luong = $result_chitietdonhang['so_luong'];
                                        $thanh_tien = $gia * $so_luong;
                                        $tong_tien += $thanh_tien;
                                    }
                                    $tong_tien = money_format($tong_tien);
                            ?>
                                    <tr>
                                        <td><?php echo $result_donhang_danggiaohang['id_dh'] ?></td>
                                        <td><?php echo $result_donhang_danggiaohang['nguoi_nhan'] ?></td>
                                        <td><?php echo $result_donhang_danggiaohang['ngay_dat'] ?></td>
                                        <td><?php echo $tong_tien ?> VNĐ</td>
                                        <td style="width: 300px;">
                                            <select name="update_donhang_danggiaohang_<?php echo $result_donhang_danggiaohang['id_dh'] ?>" class="rounded">
                                                <?php
                                                //hien thi database table TRANG THAI ĐƠN HÀNG
                                                $sql_trangthaidonhang = "SELECT * FROM `trangthaidonhang` ORDER BY id_ttdh ASC";
                                                $query_trangthaidonhang = mysqli_query($con, $sql_trangthaidonhang);
                                                while ($result_ttdh = mysqli_fetch_array($query_trangthaidonhang)) {
                                                    if ($result_ttdh['id_ttdh'] == $result_donhang_danggiaohang['id_ttdh']) {
                                                ?>
                                                        <option selected value="<?php echo $result_ttdh['id_ttdh'] ?>"><?php echo $result_ttdh['ten_ttdh'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $result_ttdh['id_ttdh'] ?>"><?php echo $result_ttdh['ten_ttdh'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <button name="update_donhang_danggiaohang" value="<?php echo $result_donhang_danggiaohang['id_dh'] ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                cập nhật
                                            </button>
                                        </td>
                                        <td style="width: 100px;">
                                            <button name="btn-modal-show-donhang" class="btn btn-success btn-sm" value="<?php echo $result_donhang_danggiaohang['id_dh'] ?>">
                                                Xem
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">
                                        <h4>Chưa Có Đơn Hàng Nào</h4>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- hiện hóa đơn GIAO HÀNG THÀNH CÔNG -->
                <div class="tab-pane-item-order tab-pane fade" id="pills-order-giaothanhcong" role="tabpanel" aria-labelledby="pills-order-giaothanhcong-tab">
                    <!-- input tìm đơn hàng -->
                    <input class="form-control" id="input-order-giaothanhcong-search" type="text" placeholder="Tìm Đơn Hàng Giao Thành Công...">
                    <br>

                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nguời Nhận</th>
                                <th>Ngày Đặt</th>
                                <th>Tổng Tiền</th>
                                <th>Trạng Thái Đơn Hàng</th>
                                <th>Cập Nhật</th>
                            </tr>
                        </thead>
                        <tbody id="table-order-giaothanhcong">
                            <?php
                            $num = mysqli_num_rows($query_donhang_giaothanhcong);
                            if ($num > 0) {
                                while ($result_donhang_giaothanhcong = mysqli_fetch_array($query_donhang_giaothanhcong)) {
                                    $query_chitietgiohang = get_chitietdonhang($result_donhang_giaothanhcong['id_dh']);
                                    $tong_tien = 0;
                                    while ($result_chitietdonhang = mysqli_fetch_array($query_chitietgiohang)) {
                                        $khuyen_mai = $result_chitietdonhang['khuyen_mai'];
                                        $gia = $result_chitietdonhang['gia'];
                                        $so_luong = $result_chitietdonhang['so_luong'];
                                        $thanh_tien = $gia * $so_luong;
                                        $tong_tien += $thanh_tien;
                                    }
                                    $tong_tien = money_format($tong_tien);
                            ?>
                                    <tr>
                                        <td><?php echo $result_donhang_giaothanhcong['id_dh'] ?></td>
                                        <td><?php echo $result_donhang_giaothanhcong['nguoi_nhan'] ?></td>
                                        <td><?php echo $result_donhang_giaothanhcong['ngay_dat'] ?></td>
                                        <td><?php echo $tong_tien ?> VNĐ</td>
                                        <td style="width: 300px;">
                                            <select name="update_donhang_giaothanhcong_<?php echo $result_donhang_giaothanhcong['id_dh'] ?>" class="rounded">
                                                <?php
                                                //hien thi database table TRANG THAI ĐƠN HÀNG
                                                $sql_trangthaidonhang = "SELECT * FROM `trangthaidonhang` ORDER BY id_ttdh ASC";
                                                $query_trangthaidonhang = mysqli_query($con, $sql_trangthaidonhang);
                                                while ($result_ttdh = mysqli_fetch_array($query_trangthaidonhang)) {
                                                    if ($result_ttdh['id_ttdh'] == $result_donhang_giaothanhcong['id_ttdh']) {
                                                ?>
                                                        <option selected value="<?php echo $result_ttdh['id_ttdh'] ?>"><?php echo $result_ttdh['ten_ttdh'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $result_ttdh['id_ttdh'] ?>"><?php echo $result_ttdh['ten_ttdh'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <button name="update_donhang_giaothanhcong" value="<?php echo $result_donhang_giaothanhcong['id_dh'] ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                cập nhật
                                            </button>
                                        </td>
                                        <td style="width: 100px;">
                                            <button name="btn-modal-show-donhang" class="btn btn-success btn-sm" value="<?php echo $result_donhang_giaothanhcong['id_dh'] ?>">
                                                Xem
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">
                                        <h4>Chưa Có Đơn Hàng Nào</h4>
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