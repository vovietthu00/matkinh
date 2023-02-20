<?php
require_once '../model/product.php';
// require_once '../model/category.php';

function convertName($str)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = preg_replace('/\s+/', '-', $str);
    $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
    $str = preg_replace("/( )/", '-', $str);
    return $str;
}

if (isset($_GET['act']))
    $action = $_GET['act'];
else if (isset($_POST['act']))
    $action = $_POST['act'];
else
    $action = 'product-list';

// echo $action;

switch ($action) {
    case 'product-list':
        $product = new Product();
        $results = $product->getProductList();
        include '../views/admin/product.php';
        break;

    case 'product-create-form':
        $product = new Product();
        $results = $product->getCategoryList();
        include '../views/admin/product.php';
        break;

    case 'product-name':
        $name = $_POST['name'];
        $product = new Product();
        $results = $product->getProductByName($name);
        if ($results) {
            echo 'error';
        } else {
            echo 'success';
        }
        break;
        
    case 'product-create':
        $name = $_POST['name'];
        $short_des = $_POST['short_des'];
        $des_content_title = $_POST['des_content_title'];
        $des_content = $_POST['des_content'];
        $price = $_POST['price'];
        $status = $_POST['status'];
        $category_ID = $_POST['category_ID'];


        $image_upload = $_FILES['image'];
        // $path = $_FILES['image']['name'];
        $image_ext = pathinfo($image_upload['name'], PATHINFO_EXTENSION);
        $image = convertName($name) . '.' . $image_ext;
        // var_dump($image);
        // var_dump($image_upload);
        move_uploaded_file($image_upload['tmp_name'], '../uploads/products/' . $image);


        $product = new Product();
        $categories = $product->getCategoryList();

        $results = $product->insertProduct(
            $name,
            $image,
            $short_des,
            $des_content_title,
            $des_content,
            $price,
            $status,
            $category_ID
        );

        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?product');

        break;

    case 'product-edit-form':
        $product_ID = $_GET['product_ID'];

        $product = new Product();
        $categories = $product->getCategoryList();

        $r = $product->getProductById($product_ID);
        // $r=$results->fetch_assoc();
        include '../views/admin/product.php';
        break;

    case 'product-edit':
        $product = new Product();

        $product_ID = $_POST['product_ID'];
        $name = $_POST['name'];
        $short_des = $_POST['short_des'];
        $des_content_title = $_POST['des_content_title'];
        $des_content = $_POST['des_content'];
        $price = $_POST['price'];
        $status = $_POST['status'];
        $category_ID = $_POST['category_ID'];
        $image_old = $_POST['image_old'];

        if (isset($_POST['image'])) {
            $image_upload = $_FILES['image'];
            // $path = $_FILES['image']['name'];
            $image_ext = pathinfo($image_upload['name'], PATHINFO_EXTENSION);
            $image = convertName($name) . '.' . $image_ext;
            echo $image_ext;
            var_dump($image);
            var_dump($image_upload);
            move_uploaded_file($image_upload['tmp_name'], '../uploads/products/' . $image);
        } else {
            $image = $image_old;
        }

        // echo $image;


        $results = $product->updateProduct(
            $product_ID,
            $name,
            $image,
            $short_des,
            $des_content_title,
            $des_content,
            $price,
            $status,
            $category_ID
        );
        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?product');
        break;

    case 'product-delete':
        $product_ID = $_GET['product_ID'];
        $product = new Product();
        $results = $product->deleteProduct($product_ID);
        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        // var_dump($r);
        header('location: index.php?product');
        break;
}
