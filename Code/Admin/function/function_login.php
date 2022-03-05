<?php
session_start();
$_SESSION['email'] = "";
$_SESSION['password'] = "";
$_SESSION['loi'] = "";

function login()
{
    require_once 'function_connect_db.php';
    $login_error = "";

    if (isset($_POST['btn-login']) && !empty($_POST['login-email'])) {
        $email = $_POST['login-email'];
        $password = $_POST['login-password'];

        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        if (empty($_POST['login-password'])) {
            $login_error = "Bạn Chưa Nhập Mật Khẩu!!!";
            $_SESSION['loi'] = $login_error;
        } else {
            $sql = "SELECT * FROM `nhanvien` WHERE email_nv = '$email' AND password = '$password' AND id_tthd = 'C'";
            $query = mysqli_query($con, $sql);
            $num = mysqli_num_rows($query);

            $sql_tthd = "SELECT * FROM `nhanvien` WHERE email_nv = '$email' AND password = '$password' AND id_tthd = 'K'";
            $query_tthd = mysqli_query($con, $sql_tthd);
            $num_tthd = mysqli_num_rows($query_tthd);

            $sql_email = " SELECT * FROM `nhanvien` WHERE email_nv = '$email' AND id_tthd = 'C'";          
            $query_email = mysqli_query($con, $sql_email);
            $num_email = mysqli_num_rows($query_email);

            if($num_tthd > 0){
                $login_error = "Tài khoản của bạn đã bị thu hồi";
                $_SESSION['loi'] = $login_error;

            }
            else if ($num == 0 && $num_email > 0) {
                $login_error = "Mật khẩu không chính xác";
                $_SESSION['loi'] = $login_error;

            } else if ($num > 0) {
                $user = mysqli_fetch_assoc($query);
                $_SESSION['current_user'] = $user;
                header('location: manage.php');
                
            } else {
                $login_error = "Tài khoản không tồn tại";
                $_SESSION['loi'] = $login_error;
            }
        }
    }
}
