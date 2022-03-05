$(function () {
    $(document).on('click', '#btn-login',function () {
        var login_email = $('#login-email').val();
        var login_password = $('#login-password').val();
        var login_remember = "";
        if($('#chkremember').prop("checked")){
            login_remember = $('#chkremember').val();
        }

        var current_page = $('#check_page').val();

        $.post("function/function_login.php", { send_login_email: login_email, send_login_password: login_password, send_login_remember: login_remember }, function (result_login) {
            if (result_login == "success"){
                if(current_page == "register"){
                    window.location = "index.php"; 
                }else{
                    location.reload();
                }           
            }
            else if(result_login == "password fail"){
                $('#login-password-error').html("Mật khẩu không chính xác");
            }
            else{
                $('#login-email-error').html("Email không tồn tại");
            }
        })
    })

    //xóa thông báo lỗi
    $('#login-email').on('keyup', function(){
        $('#login-email-error').html("");
    })
    //xóa thông báo lỗi
    $('#login-password').on('keyup', function(){
        $('#login-password-error').html("");
    })
})