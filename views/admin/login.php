<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/admin/vendors/fontawesome-free/css/all.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../assets/admin/vendors/toastr/toastr.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/admin/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <a href="../"><b>MEO STORE</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">ĐĂNG NHẬP</p>

                <form action="?act=login" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control rounded-0" placeholder="Username">
                        <div class="input-group-append ">
                            <div class="input-group-text rounded-0">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control rounded-0" placeholder="Password">
                        <div class="input-group-append ">
                            <div class="input-group-text rounded-0">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-block btn-dark btn-flat">ĐĂNG NHẬP</button>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../assets/admin/vendors/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/admin/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/admin/js/adminlte.min.js"></script>

    <!-- Toastr -->
    <script src="../assets/admin/vendors/toastr/toastr.min.js"></script>

    <?php
    if (isset($_SESSION['success'])) :
    ?>
        <script>
            $(document).ready(function() {
                toastr.success("<?= $_SESSION['success'] ?>");
            });
        </script>

    <?php
    endif;
    unset($_SESSION['success']);
    ?>

    <?php
    if (isset($_SESSION['error'])) :
    ?>
        <script>
            $(document).ready(function() {
                toastr.error("<?= $_SESSION['error'] ?>");
            });
        </script>

    <?php
    endif;
    unset($_SESSION['error']);
    ?>

</body>

</html>