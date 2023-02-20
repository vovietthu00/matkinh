<?php
include('head.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php
    include('header.php');
    ?>

    <!-- list  -->
    <?php
    if ($action == 'product-list') :
    ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ SẢN PHẨM</h1>
                        </div>
                        <div class="col-sm-6 action">
                            <div class="float-sm-right">
                                <a href="?act=product-create-form" class="btn btn-outline-info btn-flat">
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
                                    <h3 class="card-title">Danh sách sản phẩm</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Hình</th>
                                                <th>Giá (VND)</th>
                                                <th>Loại sản phẩm</th>
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
                                                        <?= $r['product_ID'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['name'] ?>
                                                    </td>
                                                    <td>
                                                        <img src="../uploads/products/<?= $r['image'] ?>" alt="" width="100px">
                                                    </td>
                                                    <td>
                                                        <?= number_format($r['price']) ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['category_name'] ?>
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
                                                            <a href="?act=product-edit-form&product_ID=<?= $r['product_ID'] ?>" class="btn btn-outline-dark btn-flat">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="?act=product-delete&product_ID=<?= $r['product_ID'] ?>" class="btn btn-outline-danger btn-flat">
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
    if ($action == 'product-create-form') :
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ SẢN PHẨM</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="?product">Danh sách sản phẩm</a></li>
                                <li class="breadcrumb-item active">Thêm sản phẩm</li>
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
                                    <h3 class="card-title">Thêm sản phẩm</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form action="?act=product-create" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="name">Tên sản phẩm</label>
                                                <input type="text" class="form-control rounded-0" id="name" name="name" required>
                                                <p class="text-danger" id="name-error"></p>

                                            </div>
                                            <div class="col-md-6">
                                                <label for="price">Giá (VND)</label>
                                                <input type="number" class="form-control rounded-0" id="price" name="price" min="0" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Hình ảnh sản phẩm</label>
                                            <input type="file" class="form-control rounded-0" id="image" name="image" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="short_des">Mô tả ngắn</label>
                                            <textarea name="short_des" id="short_des" rows="3" class="form-control rounded-0"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="des_content_title">Tựa đề mô tả</label>
                                            <input type="text" class="form-control rounded-0" id="des_content_title" name="des_content_title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="des_content">Mô tả chi tiết</label>
                                            <textarea name="des_content" id="des_content" rows="3" class="form-control rounded-0"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="category_ID">Loại sản phẩm</label>
                                            <select name="category_ID" id="category_ID" class="form-control rounded-0" required>
                                                <option value="" selected disabled>Chọn..</option>
                                                <?php
                                                foreach ($results as $r) :
                                                ?>
                                                    <option value="<?=$r['category_ID']?>"><?=$r['name']?></option>
                                                <?php
                                                endforeach;
                                                ?>
                                            </select>
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
    if ($action == 'product-edit-form') :
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ SẢN PHẨM</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="?product">Danh sách sản phẩm</a></li>
                                <li class="breadcrumb-item active">Sửa sản phẩm</li>
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
                                    <h3 class="card-title">Sửa sản phẩm</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form action="?act=product-edit" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-2 offset-sm-5">
                                                <img src="../uploads/products/<?= $r['image'] ?>" alt="" width="100%">
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="form-group ">
                                            <label for="product_ID">Mã sản phẩm</label>
                                            <input type="text" class="form-control rounded-0" id="product_ID" name="product_ID" value="<?= $r['product_ID'] ?>" readonly>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="name">Tên sản phẩm</label>
                                                <input type="text" class="form-control rounded-0" id="name" name="name" value="<?= $r['name'] ?>" required>
                                                <p class="text-danger" id="name-error"></p>

                                            </div>
                                            <div class="col-md-6">
                                                <label for="price">Giá (VND)</label>
                                                <input type="number" class="form-control rounded-0" id="price" name="price" min="0" value="<?= $r['price'] ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Hình ảnh sản phẩm</label>
                                            <input type="file" class="form-control rounded-0" id="image" name="image">
                                            <input type="hidden" class="form-control rounded-0" name="image_old" value="<?= $r['image'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="short_des">Mô tả ngắn</label>
                                            <textarea name="short_des" id="short_des" rows="3" class="form-control rounded-0"><?= $r['short_des'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="des_content_title">Tựa đề mô tả</label>
                                            <input type="text" class="form-control rounded-0" id="des_content_title" name="des_content_title" value="<?= $r['des_content_title'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="des_content">Mô tả chi tiết</label>
                                            <textarea name="des_content" id="des_content" rows="3" class="form-control rounded-0"><?= $r['des_content'] ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="category_ID">Loại sản phẩm</label>
                                            <select name="category_ID" id="category_ID" class="form-control rounded-0" required>
                                                <option value="" selected disabled>Chọn..</option>
                                                <?php
                                                foreach ($categories as $c) :
                                                ?>
                                                    <option value="<?= $c['category_ID'] ?>" <?php
                                                                                                echo ($r['category_ID'] == $c['category_ID']) ? 'selected' : '';
                                                                                                ?>><?= $c['name'] ?></option>

                                                <?php
                                                endforeach;
                                                ?>
                                            </select>
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

        // product name validation 
        var name_ = $("#name").val();

        $('#name').keyup(function() {
            var name = $("#name").val();
            $.ajax({
                url: '?act=product-name',
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
                        $("#name-error").text('Tên sản phẩm này đã tồn tại. Vui lòng nhập tên khác!');
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
        // end product name validation
    </script>

</body>

</html>