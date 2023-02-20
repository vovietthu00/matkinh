<?php
include('head.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php
    include('header.php');
    ?>

    <!-- list  -->
    <?php
    if ($action == 'admin-list') :
    ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ QUẢN TRỊ</h1>
                        </div>
                        <div class="col-sm-6 action">
                            <div class="float-sm-right">
                                <a href="?act=admin-create-form" class="btn btn-outline-info btn-flat">
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
                                                <th>Password</th>                                               
                                                
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($results as $r) :
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?= $r['admin_ID'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['username'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['password'] ?>
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
                                                            <a href="?act=admin-edit-form&admin_ID=<?= $r['admin_ID'] ?>" class="btn btn-outline-dark btn-flat">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="?act=admin-delete&admin_ID=<?= $r['admin_ID'] ?>" class="btn btn-outline-danger btn-flat">
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
    if ($action == 'admin-create-form') :
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ QUẢN TRỊ</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="?admin">Danh sách khách hàng</a></li>
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
                                <form action="?act=admin-create" method="post" enctype="multipart/form-data">
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
    if ($action == 'admin-edit-form') :
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
                                <li class="breadcrumb-item"><a href="?admin">Danh sách khách hàng</a></li>
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
                                    <form action="?act=admin-edit" method="post">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="admin_ID">Mã khách hàng</label>
                                                <input type="text" class="form-control rounded-0" id="admin_ID" name="admin_ID" value="<?= $r['admin_ID'] ?>" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control rounded-0" id="username" name="username" value="<?= $r['username'] ?>" readonly>
                                            </div>
                                        </div>
                                        
                                            <div class="col-sm-6">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control rounded-0" id="password" name="password" value="<?= $r['password'] ?>">
                                            </div>
                                            
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