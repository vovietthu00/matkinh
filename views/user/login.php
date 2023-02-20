<div id="login-form" class="form-modal">
    <form class="form-modal-content form-modal-animate" action="?act=login" method="post">
        <span onclick="document.getElementById('login-form').style.display='none'" class="form-modal-close">&times;</span>
        <h1 class="text-center">
            ĐĂNG NHẬP
        </h1>
        <div class="form-group">
            <label for="username_login">Tên đăng nhập</label>
            <input class="form-control rounded-0" type="text" name="username" id="username_login" required>
        </div>
        <div class="form-group">
            <label for="password_login">Mật khẩu</label>
            <input class="form-control rounded-0" type="password" name="password" id="password_login" required>
        </div>
        <button type="submit" class="btn btn-block">ĐĂNG NHẬP</button>
        <div id="gSignInWrapper">
            <button type="button" class="btn btn-block customGPlusSignIn " id="login-with-google">
                <i class="fa fa-google mr-2 " aria-hidden="true"></i> ĐĂNG NHẬP VỚI GOOGLE
            </button>
        </div>
    </form>
</div>