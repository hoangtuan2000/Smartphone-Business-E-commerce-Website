<?php
session_start();
$_SESSION['user'] = "";

include 'function_connect_db.php';

if (isset($_POST['send_login_email'])) {
    $email = $_POST['send_login_email'];
    $password = $_POST['send_login_password'];
    $remember = $_POST['send_login_remember'];

    $sql_login = "SELECT * FROM `khachhang` WHERE email_kh = '$email' AND password_kh = '$password'";
    $query_login = mysqli_query($con, $sql_login);
    $num_login = mysqli_num_rows($query_login);

    $sql_email = "SELECT * FROM `khachhang` WHERE email_kh = '$email'";
    $query_email = mysqli_query($con, $sql_email);
    $num_email = mysqli_num_rows($query_email);

    if ($num_login == true) {
        $user = mysqli_fetch_array($query_login);
        $_SESSION['user'] = $user;

        //lưu cookie để nhớ mật khẩu và tên đăng nhập
        if ($remember != "") {
            setcookie('email_kh', $user['email_kh'], time() + (86400 * 7), "/"); // 86400 = 1 day (*7 tồn tại trong 7 ngày)
            setcookie('password_kh', $user['password_kh'], time() + (86400 * 7), "/"); // 86400 = 1 day (*7 tồn tại trong 7 ngày)
        }
        else{
            setcookie("email_kh", NULL, -1, "/");
            setcookie("password_kh", NULL, -1, "/");
        }

        echo "success";
    } else if ($num_login == false) {
        if ($num_email == true) {
            echo "password fail";
        } else {
            echo "fail";
        }
    }
}
