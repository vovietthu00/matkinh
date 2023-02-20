<div id="register-form" class="form-modal">
    <form class="form-modal-content form-modal-animate" onsubmit="return checkRegister();" action="?act=register" method="post">
        <span onclick="document.getElementById('register-form').style.display='none'" class="form-modal-close">&times;</span>
        <h1 class="text-center">
            ĐĂNG KÝ
        </h1>
        <div class="form-group">
            <label for="username_register">Tên đăng nhập</label>
            <input class="form-control rounded-0" type="text" name="username" id="username_register" required>
        </div>
        <div class="form-group">
            <label for="email_register">Email</label>
            <input class="form-control rounded-0" type="email" name="email" id="email_register" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input class="form-control rounded-0" type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <label for="re_password">Nhập lại mật khẩu</label>
            <input class="form-control rounded-0" type="password" name="re_password" id="re_password" required>
            <p id="password_error" style="color: red"></p>
        </div>
        <input type="hidden" name="status" id="" value="1">
        <button type="submit" class="btn btn-block" name="register">ĐĂNG KÝ</button>
        <div id="gSignInWrapper">
            <button type="button" class="btn btn-block customGPlusSignIn " id="register-with-google">
                <i class="fa fa-google mr-2" aria-hidden="true"></i> ĐĂNG NHẬP VỚI GOOGLE
            </button>

        </div>
    </form>
</div>