<?php
include('head.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php
    include('header.php');
    ?>

    <!-- list  -->
    <?php
    if ($action == 'category-list') :
    ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ DANH MỤC</h1>
                        </div>
                        <div class="col-sm-6 action">
                            <div class="float-sm-right">
                                <a href="?act=category-create-form" class="btn btn-outline-info btn-flat">
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
                                    <h3 class="card-title">Danh sách danh mục</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên</th>
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
                                                        <?= $r['category_ID'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['name'] ?>
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
                                                            <a href="?act=category-edit-form&category_ID=<?= $r['category_ID'] ?>" class="btn btn-outline-dark btn-flat">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="?act=category-delete&category_ID=<?= $r['category_ID'] ?>" class="btn btn-outline-danger btn-flat">
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

    <!-- create form  -->
    <?php
    if ($action == 'category-create-form') :
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ DANH MỤC</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="?category">Danh sách danh mục</a></li>
                                <li class="breadcrumb-item active">Thêm danh mục</li>
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
                                    <h3 class="card-title">Thêm danh mục</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form action="?act=category-create" method="post">
                                        <div class="form-group ">
                                            <label for="name">Tên danh mục</label>
                                            <input type="text" class="form-control rounded-0" id="name" name="name" required>
                                            <p class="text-danger" id="name-error"></p>

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

                                        <button type="submit" class="btn btn-block btn-dark rounded-0" id="btn_create">LƯU</button>

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
    if ($action == 'category-edit-form') :
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ DANH MỤC</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="?category">Danh sách danh mục</a></li>
                                <li class="breadcrumb-item active">Sửa danh mục</li>
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
                                    <h3 class="card-title">Sửa danh mục</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form action="?act=category-edit" method="post">
                                        <div class="form-group ">
                                            <label for="category_ID">Mã danh mục</label>
                                            <input type="text" class="form-control rounded-0" id="category_ID" name="category_ID" value="<?= $r['category_ID'] ?>" readonly>
                                        </div>
                                        <div class="form-group ">
                                            <label for="name">Tên danh mục</label>
                                            <input type="text" class="form-control rounded-0" id="name" name="name" value="<?= $r['name'] ?>" required>
                                            <p class="text-danger" id="name-error"></p>

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

                                        <button type="submit" class="btn btn-block btn-dark rounded-0" id="btn_update">LƯU</button>

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


        // category name validation 
        var name_ = $("#name").val();

        $('#name').keyup(function() {
            var name = $("#name").val();
            $.ajax({
                url: '?act=category-name',
                type: 'POST',
                cache: false,
                data: {
                    name: name,
                },

                success: function(data) {
                    console.log(data);
                    if (data == 'success' || name == name_) {
                        $("#name-error").text('');
                        $("#name").css('border-color', '');
                        $('#btn_create').attr('disabled', false);
                        $('#btn_update').attr('disabled', false);

                    } else {
                        $("#name-error").text('Tên danh mục này đã tồn tại. Vui lòng nhập tên khác!');
                        $("#name").css('border-color', 'red');
                        $("#btn_create").attr("disabled", 'disabled');
                        $("#btn_update").attr("disabled", 'disabled');
                    }

                },
                error: function(jqXHR, textStatus, err) {
                    alert('text status ' + textStatus + ', err ' + err)
                }
            })

        });
        // end category name validation
    </script>

</body>

</html>