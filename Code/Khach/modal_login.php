<?php
if (!isset($user['email_kh']) && empty($user['email_kh'])) {
?>
    <!-- modal đăng nhập -->
    <div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title ml-auto text-header-modal" id="exampleModalLongTitle">
                        Đăng Nhập
                    </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group mb-5">
                            <label for="login-email" class="col-form-label text-content-modal">
                                Địa Chỉ Email:
                            </label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend input-login">
                                    <label for="login-email" class="input-group-text bg-secondary">
                                        <i class="fa fa-envelope-o icon-form" aria-hidden="true"></i>
                                    </label>
                                </div>
                                <?php
                                if (isset($email_kh)) {
                                ?>
                                    <input id="login-email" value="<?php echo $email_kh ?>" type="text" class="form-control input-login" aria-label="Small">
                                <?php
                                } else {
                                ?>
                                    <input id="login-email" type="text" class="form-control input-login" aria-label="Small">
                                <?php
                                }
                                ?>
                            </div>
                            <small id="login-email-error" class="form-text text-error"></small>

                            <label for="login-password" class="col-form-label text-content-modal">
                                Mật Khẩu:
                            </label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend input-login">
                                    <label for="login-password" class="input-group-text bg-secondary">
                                        <i class="fa fa-key icon-form" aria-hidden="true"></i>
                                    </label>
                                </div>
                                <?php
                                if (isset($password_kh)) {
                                ?>
                                    <input id="login-password" value="<?php echo $password_kh ?>" type="password" class="form-control input-login" aria-label="Small">
                                <?php
                                } else {
                                ?>
                                    <input id="login-password" type="password" class="form-control input-login" aria-label="Small">
                                <?php
                                }
                                ?>
                            </div>
                            <small id="login-password-error" class="form-text text-error mb-3"></small>

                            <?php
                            if (isset($email_kh)) {
                            ?>
                                <input type="checkbox" name="chkremember" id="chkremember" value="remember login" checked>
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" name="chkremember" id="chkremember" value="remember login">
                            <?php
                            }
                            ?>
                            <label for="chkremember" class="text-content-modal">
                                &nbsp;Nhớ Tên Đăng Nhập
                            </label>
                        </div>

                        <div class="text-center mb-3">
                            <button id="btn-login" type="button" class="btn btn-primary w-75 p-1 text-button-modal">
                                Đăng Nhập
                            </button>
                        </div>

                        <a href="register.php?register" class="text-content-modal">
                            Chưa Có Tài Khoản?
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>