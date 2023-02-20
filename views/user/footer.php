<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <a href="?act=home">
                    <img src="assets/user/images/logo-footer.png" alt="" width="50%">
                </a>
            </div>

            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <h1>
                    ABOUT
                </h1>

                <a href="?act=brand-story">Về chúng tôi</a>
                <a href="?act=matkinh-story">Chuyện mắt kính</a>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                <h1>
                    ADDRESS
                </h1>
                <p>
                    3/2, Xuan Khanh
                    <br>
                    Can Tho, Vietnam
                    <br>
                    0969696969
                    <br>
                    meostore@gmail.com
                </p>
            </div>

            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <h1>
                    DELIVERY
                </h1>
                <a href="?act=term">Điều khoản sử dụng</a>
                <a href="?act=privacy">Chính sách bảo mật</a>
            </div>

        </div>
        <hr>

        <div class="text-center">
            <i>Copyright &copy; Meostore</i>
        </div>
    </div>
</footer>
<script>
    function checkRegister() {
        var password = document.getElementById('password').value;
        var re_password = document.getElementById('re_password').value;
        if (password != re_password) {
            document.getElementById('password_error').innerHTML = 'Vui lòng nhập mật khẩu giống nhau!'
            return false;
        }
        return true;
    }

    function checkChangePass() {
        var new_password = document.getElementById('new_password').value;
        var re_new_password = document.getElementById('re_new_password').value;
        if (new_password != re_new_password) {
            document.getElementById('change_password_error').innerHTML = 'Vui lòng nhập mật khẩu giống nhau!'
            return false;
        }
        return true;
    }
</script>

<!-- Google Platform Library -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
<!-- Toastr -->
<script src="assets/user/vendors/toastr/toastr.min.js"></script>
<!-- SweetAlert  -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- DataTable  -->
<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script> -->

<script src="assets/user/vendors/datatables/jquery.dataTables.min.js"></script>



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

<?php
if (isset($_SESSION['login'])) :
?>
    <script>
        document.getElementById('login-form').style.display = 'block';
    </script>

<?php
endif;
unset($_SESSION['login']);
?>

<script>
    // var cart_count = $('#cart_count').val();


    $('.add-to-cart').click(function() {
        var product_ID = $(this).data('product_id');
        var cart_count = parseInt($('#cart_count').val());
        console.log(cart_count);
        // console.log(product_ID);

        $.ajax({
            url: '?act=add-to-cart',
            type: 'POST',
            cache: false,
            data: {
                product_ID: product_ID,
            },

            success: function(data) {
                // $(".product-quantity").text(data.message);
                if (data == 'success') {
                    // console.log('hiii');
                    swal("", "Thêm vào giỏ hàng thành công!", "success", {
                        buttons: false,
                        timer: 3000,
                    });
                    $('#cart-count').text(cart_count + 1);
                    $('#cart_count').val(cart_count + 1);
                } else if (data == 'login') {
                    document.getElementById('login-form').style.display = 'block';
                } else {
                    // console.log(data);
                    swal("", "Đã xảy ra lỗi!", "error", {
                        buttons: false,
                        timer: 3000,
                    });
                }


            },
            error: function(jqXHR, textStatus, err) {
                alert('text status ' + textStatus + ', err ' + err)
            }
        })

    });
</script>


<script>
    var googleUser = {};
    var startApp = function() {
        gapi.load('auth2', function() {
            // Retrieve the singleton for the GoogleAuth library and set up the client.
            auth2 = gapi.auth2.init({
                client_id: '16846388014-hmstmt42ejukecld89t834gjr52ebd6q.apps.googleusercontent.com',
                cookiepolicy: 'single_host_origin',
                // Request scopes in addition to 'profile' and 'email'
                //scope: 'additional_scope'
            });
            attachSignin(document.getElementById('login-with-google'));
            attachSignin(document.getElementById('register-with-google'));
        });
    };

    function attachSignin(element) {
        console.log(element.id);
        auth2.attachClickHandler(element, {},
            function(googleUser) {

                var profile = googleUser.getBasicProfile();
                console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
                console.log('Name: ' + profile.getName());
                console.log('Image URL: ' + profile.getImageUrl());
                console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
                console.log('Given Name: ' + profile.getGivenName());
                console.log('Family Name: ' + profile.getFamilyName());

                $.ajax({
                    url: '?act=login-with-google',
                    type: 'POST',
                    cache: false,
                    data: {
                        email: profile.getEmail()
                    },

                    success: function(data) {

                        location.reload();
                    },
                    error: function(jqXHR, textStatus, err) {
                        alert('text status ' + textStatus + ', err ' + err)
                    }
                })

            },
            function(error) {
                console.log(JSON.stringify(error, undefined, 2));
            });
    }

    startApp();
</script>

<script>
    // search ajax
    $('#search-input').keyup(function() {
        var value = $("#search-input").val();
        if (value.length > 0) {
            $.ajax({
                url: '?act=search',
                type: 'POST',
                cache: false,
                data: {
                    value: value,
                },

                success: function(data) {
                    data = JSON.parse(data);
                    console.log(data);
                    var search = '';
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            search += `<a href="?act=product-detail&product_ID=${data[i].product_ID}" class="menu-item-action-view animate-btn text-capitalize">${data[i].name}</a>`;
                        }
                        $("#search").html(search);

                    } else {
                        $("#search").html('');
                    }

                },
                error: function(jqXHR, textStatus, err) {
                    alert('text status ' + textStatus + ', err ' + err)
                }
            })
        } else {
            $("#search").html('');
        }


    });
    // end search ajax
</script>