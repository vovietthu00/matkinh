<?php
include('head.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php
    include('header.php');
    ?>

    <!-- list  -->
    <?php
    if ($action == 'customer-list') :
    ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ KHÁCH HÀNG</h1>
                        </div>
                        <div class="col-sm-6 action">
                            <div class="float-sm-right">
                                <a href="?act=customer-create-form" class="btn btn-outline-info btn-flat">
                                    <i class="fas fa-plus"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Danh sách khách hàng</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Họ</th>
                                                <th>Tên</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Trạng thái</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($results as $r) :
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?= $r['customer_ID'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['username'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['last_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['first_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['email'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['phone_number'] ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($r['status'] == 0) {
                                                            echo 'Vô hiệu hóa';
                                                        } else {
                                                            echo 'Kích hoạt';
                                                        }
                                                        ?>
                                                    </td>

                                                    <td class="text-right">
                                                        <div class="btn-group">
                                                            <a href="?act=customer-edit-form&customer_ID=<?= $r['customer_ID'] ?>" class="btn btn-outline-dark btn-flat">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="?act=customer-delete&customer_ID=<?= $r['customer_ID'] ?>" class="btn btn-outline-danger btn-flat">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach;
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


    <?php
    endif;
    ?>
    <!-- end list  -->
    <!-- create form -->
    <?php
    if ($action == 'customer-create-form') :
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ KHÁCH HÀNG</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="?customer">Danh sách khách hàng</a></li>
                                <li class="breadcrumb-item active">Thêm khách hàng</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Thêm khách hàng</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                <form action="?act=customer-create" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            
                                            <div class="col-sm-6">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control rounded-0" id="username" name="username"  >
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="password">Password</label>
                                                <input type="text" class="form-control rounded-0" id="password" name="password"  >
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="last_name">Họ</label>
                                                <input type="text" class="form-control rounded-0" id="last_name" name="last_name" >
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="first_name">Tên</label>
                                                <input type="text" class="form-control rounded-0" id="first_name" name="first_name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control rounded-0" id="email" name="email"  >
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="phone_number">Số điện thoại</label>
                                                <input type="number" class="form-control rounded-0" id="phone_number" name="phone_number" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <textarea name="address" id="address" rows="3" class="form-control rounded-0"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Trạng thái</label>
                                            <select name="status" id="status" class="form-control rounded-0" required>
                                                <option value="" selected disabled>Chọn..</option>
                                                <option value="0">Vô hiệu hóa</option>
                                                <option value="1">Kích hoạt</option>
                                            </select>
                                        </div>

                                        <br><br>

                                        <button type="submit" class="btn btn-block btn-dark rounded-0" id="btn_create">THÊM</button>

                                    </form>


                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                </div>
            </section>
        </div>

    <?php
    endif;
    ?>
    <!-- end create form  -->


    <!-- edit form  -->
    <?php
    if ($action == 'customer-edit-form') :
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ KHÁCH HÀNG</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="?customer">Danh sách khách hàng</a></li>
                                <li class="breadcrumb-item active">Sửa khách hàng</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Sửa khách hàng</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form action="?act=customer-edit" method="post">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="customer_ID">Mã khách hàng</label>
                                                <input type="text" class="form-control rounded-0" id="customer_ID" name="customer_ID" value="<?= $r['customer_ID'] ?>" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control rounded-0" id="username" name="username" value="<?= $r['username'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="last_name">Họ</label>
                                                <input type="text" class="form-control rounded-0" id="last_name" name="last_name" value="<?= $r['last_name'] ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="first_name">Tên</label>
                                                <input type="text" class="form-control rounded-0" id="first_name" name="first_name" value="<?= $r['first_name'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control rounded-0" id="password" name="password" value="<?= $r['password'] ?>">
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control rounded-0" id="email" name="email" value="<?= $r['email'] ?>" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="phone_number">Số điện thoại</label>
                                                <input type="number" class="form-control rounded-0" id="phone_number" name="phone_number" value="<?= $r['phone_number'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <textarea name="address" id="address" rows="3" class="form-control rounded-0"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Trạng thái</label>
                                            <select name="status" id="status" class="form-control rounded-0" required>
                                                <option value="" selected disabled>Chọn..</option>
                                                <option value="0" <?php
                                                                    echo ($r['status'] == 0) ? 'selected' : '';
                                                                    ?>>Vô hiệu hóa</option>
                                                <option value="1" <?php
                                                                    echo ($r['status'] == 1) ? 'selected' : '';
                                                                    ?>>Kích hoạt</option>
                                            </select>
                                        </div>

                                        <br><br>

                                        <button type="submit" class="btn btn-block btn-dark rounded-0">LƯU</button>

                                    </form>


                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                </div>
            </section>
        </div>

    <?php
    endif;
    ?>
    <!-- end edit form  -->

    <?php

    include 'footer.php';

    ?>

    <script>
        $(function() {
            $("#table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');

        });
    </script>

</body>

</html>