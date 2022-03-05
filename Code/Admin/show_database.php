<!-- hiển thị database -->
<div class="tab-pane fade show tab-pane-header" id="pills-database" role="tabpanel" aria-labelledby="pills-database-tab">
    <div class="row">
        <div class="col-2">
            <div class="nav flex-column nav-pills bg-secondary rounded" id="v-pills-tab-database" role="tablist" aria-orientation="vertical">
                <a class="tab-item-database nav-link active text-white" data-tab="v-pills-bonho" id="v-pills-bonho-tab" data-toggle="pill" href="#v-pills-bonho" role="tab" aria-controls="v-pills-bonho" aria-selected="true">Bộ Nhớ</a>
                <a class="tab-item-database nav-link text-white" data-tab="v-pills-chip" id="v-pills-chip-tab" data-toggle="pill" href="#v-pills-chip" role="tab" aria-controls="v-pills-chip" aria-selected="false">Chip Xử Lý</a>
                <a class="tab-item-database nav-link text-white" data-tab="v-pills-khuyenmai" id="v-pills-khuyenmai-tab" data-toggle="pill" href="#v-pills-khuyenmai" role="tab" aria-controls="v-pills-khuyenmai" aria-selected="false">Khuyến Mãi</a>
                <a class="tab-item-database nav-link text-white" data-tab="v-pills-hedieuhanh" id="v-pills-hedieuhanh-tab" data-toggle="pill" href="#v-pills-hedieuhanh" role="tab" aria-controls="v-pills-hedieuhanh" aria-selected="false">Hệ Điều Hành</a>
                <a class="tab-item-database nav-link text-white" data-tab="v-pills-manhinh" id="v-pills-manhinh-tab" data-toggle="pill" href="#v-pills-manhinh" role="tab" aria-controls="v-pills-manhinh" aria-selected="false">Kích Thước Màn Hình</a>
                <a class="tab-item-database nav-link text-white" data-tab="v-pills-ram" id="v-pills-ram-tab" data-toggle="pill" href="#v-pills-ram" role="tab" aria-controls="v-pills-ram" aria-selected="false">Ram</a>
                <a class="tab-item-database nav-link text-white" data-tab="v-pills-thietke" id="v-pills-thietke-tab" data-toggle="pill" href="#v-pills-thietke" role="tab" aria-controls="v-pills-thietke" aria-selected="false">Kiểu Thiết Kế</a>
                <a class="tab-item-database nav-link text-white" data-tab="v-pills-thuonghieu" id="v-pills-thuonghieu-tab" data-toggle="pill" href="#v-pills-thuonghieu" role="tab" aria-controls="v-pills-thuonghieu" aria-selected="false">Thương Hiệu</a>
                <a class="tab-item-database nav-link text-white" data-tab="v-pills-xuatxu" id="v-pills-xuatxu-tab" data-toggle="pill" href="#v-pills-xuatxu" role="tab" aria-controls="v-pills-xuatxu" aria-selected="false">Nước Sản Xuất</a>
                <a class="tab-item-database nav-link text-white" data-tab="v-pills-loaiketnoi" id="v-pills-loaiketnoi-tab" data-toggle="pill" href="#v-pills-loaiketnoi" role="tab" aria-controls="v-pills-loaiketnoi" aria-selected="false">Loại Kết Nối</a>
                <a class="tab-item-database nav-link text-white" data-tab="v-pills-chatlieu" id="v-pills-chatlieu-tab" data-toggle="pill" href="#v-pills-chatlieu" role="tab" aria-controls="v-pills-chatlieu" aria-selected="false">Chất Liệu</a>
            </div>
        </div>
        <div class="col-10">
            <div class="tab-content rounded" id="v-pills-tabContent">
                <!-- show database BỘ NHỚ -->
                <div class="tab-pane-item-database tab-pane fade show active" id="v-pills-bonho" role="tabpanel" aria-labelledby="v-pills-bonho-tab">
                    <div class="row">
                        <!-- khung cap nhat bo nho -->
                        <div class="col-7">
                            <table id="table_show_bonho" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Mã Bộ Nhớ</th>
                                        <th scope="col">Dung Lượng Bộ Nhớ</th>
                                        <th scope="col">Cập Nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num_bonho = mysqli_num_rows($query_bonho);
                                    if ($num_bonho > 0) {
                                        while ($row = mysqli_fetch_array($query_bonho)) {
                                    ?>
                                            <tr>
                                                <th scope="row">
                                                    <input type="text" id="update_id_bn_<?php echo $row['id_bn'] ?>" value="<?php echo $row['id_bn'] ?>">
                                                </th>
                                                <td>
                                                    <input type="text" id="update_dung_luong_bn_<?php echo $row['id_bn'] ?>" value="<?php echo $row['dung_luong_bn'] ?>">
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($row['id_bn'] != 1) {
                                                    ?>
                                                        <!-- dùng ajax để cập nhật -->
                                                        <button name="btn-update-bonho" class="btn btn-warning btn-sm text-14 width-102" value="<?php echo $row['id_bn'] ?>">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            Cập Nhật
                                                        </button>
                                                        <button name="btn-delete-bonho" class="btn btn-danger btn-sm text-14" value="<?php echo $row['id_bn'] ?>">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            Xóa
                                                        </button>
                                                    <?php
                                                    } else {
                                                        echo "Không được phép";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="3">
                                                <h4>Chưa Có Dữ Liệu</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                        <!-- khung them bo nho -->
                        <div class="col-5">
                            <form class="bg-secondary p-4 rounded text-white">
                                <div class="form-group input-group-sm mb-4">
                                    <label for="insert_id_bonho">Mã Bộ Nhớ:</label>
                                    <input id="insert_id_bonho" type="text" class="form-control mb-3">

                                    <label for="insert_dung_luong_bonho">Dung Lượng Bộ Nhớ:</label>
                                    <input id="insert_dung_luong_bonho" type="text" class="form-control">
                                </div>
                                <div class="text-center">
                                    <!-- dùng ajax để thêm -->
                                    <button id="btn-insert-bonho" type="button" class="btn btn-primary w-75 text-16">Thêm Bộ Nhớ</button>
                                    <button type="reset" class="btn btn-danger text-16">Làm Mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- show database CHIP -->
                <div class="tab-pane-item-database tab-pane fade" id="v-pills-chip" role="tabpanel" aria-labelledby="v-pills-chip-tab">
                    <div class="row">
                        <!-- khung cap nhat chip xử lý -->
                        <div class="col-7">
                            <table id="table_show_chip" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Tên Chip Xử Lý</th>
                                        <th scope="col">Cập Nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num_chip = mysqli_num_rows($query_chip);
                                    if ($num_chip > 0) {
                                        while ($row = mysqli_fetch_array($query_chip)) {
                                    ?>
                                            <tr>

                                                <td class="text-center">
                                                    <input type="text" id="update_ten_chip_<?php echo $row['id_chip'] ?>" value="<?php echo $row['ten_chip'] ?>">
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['id_chip'] != 1) {
                                                    ?>
                                                        <!-- dùng ajax để cập nhật -->
                                                        <button name="btn-update-chip" class="btn btn-warning btn-sm text-14 width-102" value="<?php echo $row['id_chip'] ?>">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            Cập Nhật
                                                        </button>
                                                        <button name="btn-delete-chip" class="btn btn-danger btn-sm text-14" value="<?php echo $row['id_chip'] ?>">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            Xóa
                                                        </button>
                                                    <?php
                                                    } else {
                                                        echo "Không được phép";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="2">
                                                <h4>Chưa Có Dữ Liệu</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- khung them chip xử lý -->
                        <div class="col-5">
                            <form class="bg-secondary p-4 rounded text-white">
                                <div class="form-group input-group-sm mb-4">
                                    <label for="insert_ten_chip">Tên Chip Xử Lý:</label>
                                    <input id="insert_ten_chip" type="text" class="form-control">
                                </div>
                                <div class="text-center">
                                    <!-- dùng ajax để thêm -->
                                    <button id="btn-insert-chip" type="button" class="btn btn-primary w-75 text-16">Thêm Chip Xử Lý</button>
                                    <button type="reset" class="btn btn-danger text-16">Làm Mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- show database KHUYEN MAI -->
                <div class="tab-pane-item-database tab-pane fade" id="v-pills-khuyenmai" role="tabpanel" aria-labelledby="v-pills-khuyenmai-tab">
                    <div class="row">
                        <!-- khung cap nhat khuyến mãi -->
                        <div class="col-7">
                            <table id="table_show_km" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Giảm %</th>
                                        <th scope="col">Cập Nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num_khuyenmai = mysqli_num_rows($query_khuyenmai);
                                    if ($num_khuyenmai > 0) {
                                        while ($row = mysqli_fetch_array($query_khuyenmai)) {
                                            if ($row['giam_km'] == 0) {
                                    ?>
                                                <tr>

                                                    <td class="text-center">
                                                        <input type="text" id="update_giam_km_<?php echo $row['id_km'] ?>" value="<?php echo $row['giam_km'] ?>">
                                                    </td>
                                                    <td class="text-center">
                                                        Bạn Không Được Phép Cập Nhật & Xóa
                                                    </td>
                                                </tr>
                                            <?php
                                            } else {
                                            ?>
                                                <tr>

                                                    <td class="text-center">
                                                        <input type="text" id="update_giam_km_<?php echo $row['id_km'] ?>" value="<?php echo $row['giam_km'] ?>">
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- dùng ajax để cập nhật -->
                                                        <button name="btn-update-km" class="btn btn-warning btn-sm text-14 width-102" value="<?php echo $row['id_km'] ?>">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            Cập Nhật
                                                        </button>
                                                        <button name="btn-delete-km" class="btn btn-danger btn-sm text-14" value="<?php echo $row['id_km'] ?>">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            Xóa
                                                        </button>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="2">
                                                <h4>Chưa Có Dữ Liệu</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- khung them khuyến mãi -->
                        <div class="col-5">
                            <form class="bg-secondary p-4 rounded text-white">
                                <div class="form-group input-group-sm mb-4">
                                    <label for="insert_giam_km">Khuyến Mãi ( Giảm % ):</label>
                                    <input id="insert_giam_km" type="text" class="form-control">
                                </div>
                                <div class="text-center">
                                    <!-- dùng ajax để thêm -->
                                    <button id="btn-insert-km" type="button" class="btn btn-primary w-75 text-16">Thêm Khuyến Mãi</button>
                                    <button type="reset" class="btn btn-danger text-16">Làm Mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- show database hedieuhanh -->
                <div class="tab-pane-item-database tab-pane fade" id="v-pills-hedieuhanh" role="tabpanel" aria-labelledby="v-pills-hedieuhanh-tab">
                    <div class="row">
                        <!-- khung cap nhat Hệ Điều Hành -->
                        <div class="col-7">
                            <table id="table_show_hdh" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Tên Hệ Điều Hành</th>
                                        <th scope="col">Cập Nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num_hedieuhanh = mysqli_num_rows($query_hedieuhanh);
                                    if ($num_hedieuhanh > 0) {
                                        while ($row = mysqli_fetch_array($query_hedieuhanh)) {
                                    ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text" id="update_ten_hdh_<?php echo $row['id_hdh'] ?>" value="<?php echo $row['ten_hdh'] ?>">
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['id_hdh'] != 1) {
                                                    ?>
                                                        <!-- dùng ajax để cập nhật -->
                                                        <button name="btn-update-hdh" class="btn btn-warning btn-sm text-14 width-102" value="<?php echo $row['id_hdh'] ?>">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            Cập Nhật
                                                        </button>
                                                        <button name="btn-delete-hdh" class="btn btn-danger btn-sm text-14" value="<?php echo $row['id_hdh'] ?>">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            Xóa
                                                        </button>
                                                    <?php
                                                    } else {
                                                        echo "Không được phép";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="2">
                                                <h4>Chưa Có Dữ Liệu</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- khung thêm Hệ Điều Hành -->
                        <div class="col-5">
                            <form class="bg-secondary p-4 rounded text-white">
                                <div class="form-group input-group-sm mb-4">
                                    <label for="insert_ten_hdh">Tên Hệ Điều Hành:</label>
                                    <input id="insert_ten_hdh" type="text" class="form-control mb-3">
                                </div>
                                <div class="text-center">
                                    <!-- dùng ajax để thêm -->
                                    <button id="btn-insert-hdh" type="button" class="btn btn-primary w-75 text-16">Thêm Hệ Điều Hành</button>
                                    <button type="reset" class="btn btn-danger text-16">Làm Mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- show database manhinh -->
                <div class="tab-pane-item-database tab-pane fade" id="v-pills-manhinh" role="tabpanel" aria-labelledby="v-pills-manhinh-tab">
                    <div class="row">
                        <!-- khung cap nhat Kích Thước Màn Hình -->
                        <div class="col-6">
                            <table id="table_show_mh" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Kích Thước Màn Hình</th>
                                        <th scope="col">Cập Nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num_manhinh = mysqli_num_rows($query_manhinh);
                                    if ($num_manhinh > 0) {
                                        while ($row = mysqli_fetch_array($query_manhinh)) {
                                    ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text" id="update_kich_thuoc_mh_<?php echo $row['id_mh'] ?>" value="<?php echo $row['kich_thuoc_mh'] ?>">
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['id_mh'] != 1) {
                                                    ?>
                                                        <!-- dùng ajax để cập nhật -->
                                                        <button name="btn-update-mh" class="btn btn-warning btn-sm text-14 width-102" value="<?php echo $row['id_mh'] ?>">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            Cập Nhật
                                                        </button>
                                                        <button name="btn-delete-mh" class="btn btn-danger btn-sm text-14" value="<?php echo $row['id_mh'] ?>">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            Xóa
                                                        </button>
                                                    <?php
                                                    } else {
                                                        echo "Không được phép";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="2">
                                                <h4>Chưa Có Dữ Liệu</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- khung thêm Kích Thước Màn Hình -->
                        <div class="col-6">
                            <form class="bg-secondary p-4 rounded text-white">
                                <div class="form-group input-group-sm mb-4">
                                    <label for="insert_kich_thuoc_mh">Kích Thước Màn Hình:</label>
                                    <input id="insert_kich_thuoc_mh" type="text" class="form-control mb-3">
                                </div>
                                <div class="text-center">
                                    <!-- dùng ajax để thêm -->
                                    <button id="btn-insert-mh" type="button" class="btn btn-primary w-75 text-16">Thêm Kích Thước Màn Hình</button>
                                    <button type="reset" class="btn btn-danger text-16">Làm Mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- show database ram -->
                <div class="tab-pane-item-database tab-pane fade" id="v-pills-ram" role="tabpanel" aria-labelledby="v-pills-ram-tab">
                    <div class="row">
                        <!-- khung cap nhat RAM -->
                        <div class="col-6">
                            <table id="table_show_ram" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Dung Lượng RAM</th>
                                        <th scope="col">Cập Nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num_ram = mysqli_num_rows($query_ram);
                                    if ($num_ram > 0) {
                                        while ($row = mysqli_fetch_array($query_ram)) {
                                    ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text" id="update_dung_luong_ram_<?php echo $row['id_ram'] ?>" value="<?php echo $row['dung_luong_ram'] ?>">
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['id_ram'] != 1) {
                                                    ?>
                                                        <!-- dùng ajax để cập nhật -->
                                                        <button name="btn-update-ram" class="btn btn-warning btn-sm text-14 width-102" value="<?php echo $row['id_ram'] ?>">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            Cập Nhật
                                                        </button>
                                                        <button name="btn-delete-ram" class="btn btn-danger btn-sm text-14" value="<?php echo $row['id_ram'] ?>">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            Xóa
                                                        </button>
                                                    <?php
                                                    } else {
                                                        echo "Không được phép";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="2">
                                                <h4>Chưa Có Dữ Liệu</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- khung thêm RAM -->
                        <div class="col-6">
                            <form class="bg-secondary p-4 rounded text-white">
                                <div class="form-group input-group-sm mb-4">
                                    <label for="insert_dung_luong_ram">Dung Lượng RAM:</label>
                                    <input id="insert_dung_luong_ram" type="text" class="form-control mb-3">
                                </div>
                                <div class="text-center">
                                    <!-- dùng ajax để thêm -->
                                    <button id="btn-insert-ram" type="button" class="btn btn-primary w-75 text-16">Thêm RAM</button>
                                    <button type="reset" class="btn btn-danger text-16">Làm Mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- show database thietke -->
                <div class="tab-pane-item-database tab-pane fade" id="v-pills-thietke" role="tabpanel" aria-labelledby="v-pills-thietke-tab">
                    <div class="row">
                        <!-- khung cap nhat Thiết Kế -->
                        <div class="col-7">
                            <table id="table_show_tk" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Kiểu Thiết Kế</th>
                                        <th scope="col">Cập Nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num_thietke = mysqli_num_rows($query_thietke);
                                    if ($num_thietke > 0) {
                                        while ($row = mysqli_fetch_array($query_thietke)) {
                                    ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text" id="update_kieu_tk_<?php echo $row['id_tk'] ?>" value="<?php echo $row['kieu_tk'] ?>">
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['id_tk'] != 1) {
                                                    ?>
                                                        <!-- dùng ajax để cập nhật -->
                                                        <button name="btn-update-tk" class="btn btn-warning btn-sm text-14 width-102" value="<?php echo $row['id_tk'] ?>">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            Cập Nhật
                                                        </button>
                                                        <button name="btn-delete-tk" class="btn btn-danger btn-sm text-14" value="<?php echo $row['id_tk'] ?>">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            Xóa
                                                        </button>
                                                    <?php
                                                    } else {
                                                        echo "Không được phép";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="2">
                                                <h4>Chưa Có Dữ Liệu</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- khung thêm Thiết Kế -->
                        <div class="col-5">
                            <form class="bg-secondary p-4 rounded text-white">
                                <div class="form-group input-group-sm mb-4">
                                    <label for="insert_kieu_tk">Kiểu Thiết Kế:</label>
                                    <input id="insert_kieu_tk" type="text" class="form-control mb-3">
                                </div>
                                <div class="text-center">
                                    <!-- dùng ajax để thêm -->
                                    <button id="btn-insert-tk" type="button" class="btn btn-primary w-75 text-16">Thêm Kiểu Thiết Kế</button>
                                    <button type="reset" class="btn btn-danger text-16">Làm Mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- show database thuonghieu -->
                <div class="tab-pane-item-database tab-pane fade" id="v-pills-thuonghieu" role="tabpanel" aria-labelledby="v-pills-thuonghieu-tab">
                    <div class="row">
                        <!-- khung cap nhat Thương Hiệu -->
                        <div class="col-7">
                            <table id="table_show_th" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Tên Thương Hiệu</th>
                                        <th scope="col">Cập Nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num_thuonghieu = mysqli_num_rows($query_thuonghieu);
                                    if ($num_thuonghieu > 0) {
                                        while ($row = mysqli_fetch_array($query_thuonghieu)) {
                                    ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text" id="update_ten_th_<?php echo $row['id_th'] ?>" value="<?php echo $row['ten_th'] ?>">
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['id_th'] != 1) {
                                                    ?>
                                                        <!-- dùng ajax để cập nhật -->
                                                        <button name="btn-update-th" class="btn btn-warning btn-sm text-14 width-102" value="<?php echo $row['id_th'] ?>">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            Cập Nhật
                                                        </button>
                                                        <button name="btn-delete-th" class="btn btn-danger btn-sm text-14" value="<?php echo $row['id_th'] ?>">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            Xóa
                                                        </button>
                                                    <?php
                                                    } else {
                                                        echo "Không được phép";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="2">
                                                <h4>Chưa Có Dữ Liệu</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- khung thêm Thương Hiệu -->
                        <div class="col-5">
                            <form class="bg-secondary p-4 rounded text-white">
                                <div class="form-group input-group-sm mb-4">
                                    <label for="insert_ten_th">Tên Thương Hiệu:</label>
                                    <input id="insert_ten_th" type="text" class="form-control mb-3">
                                </div>
                                <div class="text-center">
                                    <!-- dùng ajax để thêm -->
                                    <button id="btn-insert-th" type="button" class="btn btn-primary w-75 text-16">Thêm Thương Hiệu</button>
                                    <button type="reset" class="btn btn-danger text-16">Làm Mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- show database Nước Sản Xuất -->
                <div class="tab-pane-item-database tab-pane fade" id="v-pills-xuatxu" role="tabpanel" aria-labelledby="v-pills-xuatxu-tab">
                    <div class="row">
                        <!-- khung cap nhat Nước Sản Xuất -->
                        <div class="col-7">
                            <table id="table_show_nsx" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Tên Nước Sản Xuất</th>
                                        <th scope="col">Cập Nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num_nuocsanxuat = mysqli_num_rows($query_nuocsanxuat);
                                    if ($num_nuocsanxuat > 0) {
                                        while ($row = mysqli_fetch_array($query_nuocsanxuat)) {
                                    ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text" id="update_ten_nsx_<?php echo $row['id_nsx'] ?>" value="<?php echo $row['ten_nsx'] ?>">
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['id_nsx'] != 1) {
                                                    ?>
                                                        <!-- dùng ajax để cập nhật -->
                                                        <button name="btn-update-nsx" class="btn btn-warning btn-sm text-14 width-102" value="<?php echo $row['id_nsx'] ?>">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            Cập Nhật
                                                        </button>
                                                        <button name="btn-delete-nsx" class="btn btn-danger btn-sm text-14" value="<?php echo $row['id_nsx'] ?>">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            Xóa
                                                        </button>
                                                    <?php
                                                    } else {
                                                        echo "Không được phép";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="2">
                                                <h4>Chưa Có Dữ Liệu</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- khung thêm Nước Sản Xuất -->
                        <div class="col-5">
                            <form class="bg-secondary p-4 rounded text-white">
                                <div class="form-group input-group-sm mb-4">
                                    <label for="insert_ten_nsx">Tên Nước Sản Xuất:</label>
                                    <input id="insert_ten_nsx" type="text" class="form-control mb-3">
                                </div>
                                <div class="text-center">
                                    <!-- dùng ajax để thêm -->
                                    <button id="btn-insert-nsx" type="button" class="btn btn-primary w-75 text-16">Thêm Nước Sản Xuất</button>
                                    <button type="reset" class="btn btn-danger text-16">Làm Mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- show database LOAI KET NOI -->
                <div class="tab-pane-item-database tab-pane fade" id="v-pills-loaiketnoi" role="tabpanel" aria-labelledby="v-pills-loaiketnoi-tab">
                    <div class="row">
                        <!-- khung cap nhat Loại Kết Nôi -->
                        <div class="col-7">
                            <table id="table_show_loaiketnoi" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Tên Loại Kết Nối</th>
                                        <th scope="col">Cập Nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num_loaiketnoi = mysqli_num_rows($query_loaiketnoi);
                                    if ($num_loaiketnoi > 0) {
                                        while ($row = mysqli_fetch_array($query_loaiketnoi)) {
                                    ?>
                                            <tr>

                                                <td class="text-center">
                                                    <input type="text" id="update_ten_lkn_<?php echo $row['id_lkn'] ?>" value="<?php echo $row['ten_lkn'] ?>">
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['id_lkn'] != 1) {
                                                    ?>
                                                        <!-- dùng ajax để cập nhật -->
                                                        <button name="btn-update-loaiketnoi" class="btn btn-warning btn-sm text-14 width-102" value="<?php echo $row['id_lkn'] ?>">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            Cập Nhật
                                                        </button>
                                                        <button name="btn-delete-lkn" class="btn btn-danger btn-sm text-14" value="<?php echo $row['id_lkn'] ?>">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            Xóa
                                                        </button>
                                                    <?php
                                                    } else {
                                                        echo "Không được phép";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="2">
                                                <h4>Chưa Có Dữ Liệu</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- khung them Loại Kết Nôi -->
                        <div class="col-5">
                            <form class="bg-secondary p-4 rounded text-white">
                                <div class="form-group input-group-sm mb-4">
                                    <label for="insert_ten_lkn">Tên Loại Kết Nối:</label>
                                    <input id="insert_ten_lkn" type="text" class="form-control">
                                </div>
                                <div class="text-center">
                                    <!-- dùng ajax để thêm -->
                                    <button id="btn-insert-loaiketnoi" type="button" class="btn btn-primary w-75 text-16">Thêm Loại Kết Nối</button>
                                    <button type="reset" class="btn btn-danger text-16">Làm Mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- show database CHẤT LIỆU -->
                <div class="tab-pane-item-database tab-pane fade" id="v-pills-chatlieu" role="tabpanel" aria-labelledby="v-pills-chatlieu-tab">
                    <div class="row">
                        <!-- khung cap nhat Chất Liệu -->
                        <div class="col-7">
                            <table id="table_show_chatlieu" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Tên Chất Liệu</th>
                                        <th scope="col">Cập Nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $num_chatlieu = mysqli_num_rows($query_chatlieu);
                                    if ($num_chatlieu > 0) {
                                        while ($row = mysqli_fetch_array($query_chatlieu)) {
                                    ?>
                                            <tr>

                                                <td class="text-center">
                                                    <input type="text" id="update_ten_cl_<?php echo $row['id_cl'] ?>" value="<?php echo $row['ten_cl'] ?>">
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['id_cl'] != 1) {
                                                    ?>
                                                        <!-- dùng ajax để cập nhật -->
                                                        <button name="btn-update-chatlieu" class="btn btn-warning btn-sm text-14 width-102" value="<?php echo $row['id_cl'] ?>">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            Cập Nhật
                                                        </button>
                                                        <button name="btn-delete-cl" class="btn btn-danger btn-sm text-14" value="<?php echo $row['id_cl'] ?>">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            Xóa
                                                        </button>
                                                    <?php
                                                    } else {
                                                        echo "Không được phép";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="2">
                                                <h4>Chưa Có Dữ Liệu</h4>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- khung them Chất Liệu -->
                        <div class="col-5">
                            <form class="bg-secondary p-4 rounded text-white">
                                <div class="form-group input-group-sm mb-4">
                                    <label for="insert_ten_cl">Tên Chất Liệu:</label>
                                    <input id="insert_ten_cl" type="text" class="form-control">
                                </div>
                                <div class="text-center">
                                    <!-- dùng ajax để thêm -->
                                    <button id="btn-insert-chatlieu" type="button" class="btn btn-primary w-75 text-16">Thêm Chất Liệu</button>
                                    <button type="reset" class="btn btn-danger text-16">Làm Mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>