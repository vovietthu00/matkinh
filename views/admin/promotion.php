<?php
include('head.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php
    include('header.php');
    ?>

    <!-- list  -->
    <?php
    if ($action == 'promotion-list') :
    ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ KHUYẾN MÃI</h1>
                        </div>
                        <div class="col-sm-6 action">
                            <div class="float-sm-right">
                                <a href="?act=promotion-create-form" class="btn btn-outline-info btn-flat">
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
                                    <h3 class="card-title">Danh sách khuyến mãi</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Bắt đầu</th>
                                                <th>Kết thúc</th>
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
                                                        <?= $r['promotion_ID'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['start_date'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $r['end_date'] ?>
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
                                                            <a href="?act=promotion-edit-form&promotion_ID=<?= $r['promotion_ID'] ?>" class="btn btn-outline-dark btn-flat">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="?act=promotion-delete&promotion_ID=<?= $r['promotion_ID'] ?>" class="btn btn-outline-danger btn-flat">
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
    if ($action == 'promotion-create-form') :
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ KHUYẾN MÃI</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="?promotion">Danh sách khuyến mãi</a></li>
                                <li class="breadcrumb-item active">Thêm khuyến mãi</li>
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
                                    <h3 class="card-title">Thêm khuyến mãi</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <form action="?act=promotion-create" method="post">
                                        <div class="form-group ">
                                            <label for="name">Tên khuyến mãi</label>
                                            <input type="text" class="form-control rounded-0" id="name" name="name" required>
                                            <p class="text-danger" id="name-error"></p>

                                        </div>
                                        <div class="form-group">
                                            <label for="promotion_type">Loại khuyến mãi</label>
                                            <select name="promotion_type" id="promotion_type" class="form-control rounded-0" required>
                                                <option value="" selected disabled>Chọn..</option>
                                                <option value="percent">Theo phần trăm</option>
                                                <option value="price">Theo giá tiền</option>
                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="discount">Giảm</label>
                                                <input type="number" name="discount" id="discount" class="form-control rounded-0" min="0" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="condition_discount">Điều kiện</label>
                                                <input type="number" name="condition_discount" id="condition_discount" class="form-control rounded-0" min="0" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="start_date">Bắt đầu</label>
                                                <input type="date" name="start_date" id="start_date" class="form-control rounded-0" required>
                                                <p class="text-danger" id="start_date-error"></p>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="end_date">Kết thúc</label>
                                                <input type="date" name="end_date" id="end_date" class="form-control rounded-0" required>
                                                <p class="text-danger" id="end_date-error"></p>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="detail">Chi tiết</label>
                                            <textarea name="detail" id="detail" rows="3" class="form-control rounded-0"></textarea>
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
    if ($action == 'promotion-edit-form') :
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>QUẢN LÝ KHUYẾN MÃI</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="?promotion">Danh sách khuyến mãi</a></li>
                                <li class="breadcrumb-item active">Sửa khuyến mãi</li>
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
                                    <h3 class="card-title">Sửa khuyến mãi</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- <form action="?act=promotion-name" method="post">
                                        <div class="form-group ">
                                            <label for="name">Tên khuyến mãi</label>
                                            <input type="text" class="form-control rounded-0" id="name" name="name" value="<?= $r['name'] ?>" required>
                                            <p class="text-danger" id="name-error"></p>
                                            <button type="submit">ok</button>
                                        </div>
                                    </form> -->
                                    <form action="?act=promotion-edit" method="post">
                                        <div class="form-group ">
                                            <label for="promotion_ID">Mã khuyến mãi</label>
                                            <input type="text" class="form-control rounded-0" id="promotion_ID" name="promotion_ID" value="<?= $r['promotion_ID'] ?>" readonly>
                                        </div>
                                        <div class="form-group ">
                                            <label for="name">Tên khuyến mãi</label>
                                            <input type="text" class="form-control rounded-0" id="name" name="name" value="<?= $r['name'] ?>" required>
                                            <p class="text-danger" id="name-error"></p>

                                        </div>
                                        <div class="form-group">
                                            <label for="promotion_type">Loại khuyến mãi</label>
                                            <select name="promotion_type" id="promotion_type" class="form-control rounded-0" required>
                                                <option value="" selected disabled>Chọn..</option>
                                                <option value="percent" <?php
                                                                        echo ($r['promotion_type'] == 'percent') ? 'selected' : '';
                                                                        ?>>Theo phần trăm</option>
                                                <option value="price" <?php
                                                                        echo ($r['promotion_type'] == 'price') ? 'selected' : '';
                                                                        ?>>Theo giá tiền</option>
                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="discount">Giảm</label>
                                                <input type="number" name="discount" id="discount" value="<?= $r['discount'] ?>" class="form-control rounded-0" min="0" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="condition_discount">Điều kiện</label>
                                                <input type="number" name="condition_discount" id="condition_discount" value="<?= $r['condition_discount'] ?>" class="form-control rounded-0" min="0" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="start_date">Bắt đầu</label>
                                                <input type="date" name="start_date" id="start_date" value="<?= $r['start_date'] ?>" class="form-control rounded-0" required>
                                                <p class="text-danger" id="start_date-error"></p>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="end_date">Kết thúc</label>
                                                <input type="date" name="end_date" id="end_date" value="<?= $r['end_date'] ?>" class="form-control rounded-0" required>
                                                <p class="text-danger" id="end_date-error"></p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="detail">Chi tiết</label>
                                            <textarea name="detail" id="detail" rows="3" class="form-control rounded-0"><?= $r['detail'] ?></textarea>
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
    </script>

    <script>
        // promotion name validation 
        var name_ = $("#name").val();

        $('#name').keyup(function() {
            var name = $("#name").val();
            $.ajax({
                url: '?act=promotion-name',
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
                        $("#name-error").text('Mã khuyến mãi này đã tồn tại. Vui lòng nhập mã khác!');
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
        // end promotion name validation 

        // promotion type validation 
        $('#promotion_type').change(function() {
            var promotion_type = $('#promotion_type').val();
            if (promotion_type == 'percent') {
                $('#discount').attr('max', 100);
            } else {
                $('#discount').attr('max', '');
            }
        });
        // end promotion type validation 

        // start_date end_date validation
        $('#start_date').change(function() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();


            if (end_date) {
                var start_date = new Date(start_date);
                var end_date = new Date(end_date);
                if (start_date < end_date) {
                    $("#end_date-error").text('');
                    $("#end_date").css('border-color', '');
                    $("#start_date-error").text('');
                    $("#start_date").css('border-color', '');
                    $('#btn_create').attr('disabled', false);
                    $('#btn_update').attr('disabled', false);

                } else {
                    $("#start_date-error").text('Ngày bắt đầu phải nhỏ hơn ngày kết thúc!');
                    $("#start_date").css('border-color', 'red');
                    $("#btn_create").attr("disabled", 'disabled');
                    $("#btn_update").attr("disabled", 'disabled');
                }
            }

        });

        $('#end_date').change(function() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();

            if (start_date) {
                var start_date = new Date(start_date);
                var end_date = new Date(end_date);
                if (start_date < end_date) {
                    $("#end_date-error").text('');
                    $("#end_date").css('border-color', '');
                    $("#start_date-error").text('');
                    $("#start_date").css('border-color', '');
                    $('#btn_create').attr('disabled', false);
                    $('#btn_update').attr('disabled', false);

                } else {
                    $("#end_date-error").text('Ngày kết thúc phải lớn hơn ngày bắt đầu!');
                    $("#end_date").css('border-color', 'red');
                    $("#btn_create").attr("disabled", 'disabled');
                    $("#btn_update").attr("disabled", 'disabled');
                }
            }

        });
        // end start_date end_date validation
    </script>



    </html>