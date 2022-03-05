<!-- hiển thị nhân viên -->
<div class="tab-pane fade show tab-pane-header" id="pills-staff" role="tabpanel" aria-labelledby="pills-staff-tab">
    <!-- nút thêm nhân viên -->
    <a href="insert_staff.php" class="btn btn-success mb-3">
        Thêm Nhân Viên
    </a>

    <!-- input tìm nhân viên -->
    <input class="form-control" id="input-staff-search" type="text" placeholder="Tìm Nhân Viên...">
    <br>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="align-middle" style="width: 70px;">Mã NV</th>
                <th class="align-middle">Họ Tên</th>
                <th class="align-middle" style="width: 120px;">Chức Vụ</th>
                <th class="align-middle">SDT</th>
                <th class="align-middle">Email</th>
                <th class="align-middle" style="width: 100px;">Trạng Thái Hoạt Động</th>
                <th class="align-middle" style="width: 140px;">Cập Nhật</th>
            </tr>
        </thead>
        <tbody id="table-staff">
            <?php
            $num_nhanvien = mysqli_num_rows($query_nhanvien);
            if ($num_nhanvien > 0) {
                while ($row_nhanvien = mysqli_fetch_array($query_nhanvien)) {
                    $chucvu = find_chucvu($row_nhanvien['id_cv']);
                    $row_chucvu = mysqli_fetch_array($chucvu);
                    $trangthaihoatdong = get_trangthaihoatdong($row_nhanvien['id_tthd']);
            ?>
                    <tr>
                        <td class="align-middle"><?php echo $row_nhanvien['id_nv']; ?></td>
                        <td class="align-middle"><?php echo $row_nhanvien['ten_nv']; ?></td>
                        <td class="align-middle"><?php echo $row_chucvu['ten_cv']; ?></td>
                        <td class="align-middle"><?php echo $row_nhanvien['sdt_nv']; ?></td>
                        <td class="align-middle"><?php echo $row_nhanvien['email_nv']; ?></td>
                        <td class="align-middle"><?php echo $trangthaihoatdong['ten_tthd']; ?></td>
                        <?php
                        if ($row_chucvu['id_cv'] != "AD") {
                        ?>
                            <td class="align-middle">
                                <a href="update_staff.php?id_staff=<?php echo $row_nhanvien['id_nv']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    Cập nhật
                                </a>
                            </td>
                        <?php
                        }else{
                            ?>
                            <td class="align-middle">Không Có Quyền</td>
                            <?php
                        }
                        ?>

                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>