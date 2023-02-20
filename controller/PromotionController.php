<?php
require '../model/promotion.php';

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
    $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '', $str);
    $str = preg_replace("/( )/", '-', $str);
    return $str;
}

if (isset($_GET['act']))
    $action = $_GET['act'];
else if (isset($_POST['act']))
    $action = $_POST['act'];
else
    $action = 'promotion-list';

// echo $action;

switch ($action) {
    case 'promotion-list':
        $promotion = new Promotion();
        $results = $promotion->getPromotionList();
        // var_dump($results);

        include '../views/admin/promotion.php';
        break;

    case 'promotion-create-form':
        include '../views/admin/promotion.php';
        break;

    case 'promotion-name':
        $name = convertName($_POST['name']);
        $promotion = new Promotion();
        $results = $promotion->getPromotionByName($name);
        if ($results) {
            echo 'error';
        } else {
            echo 'success';
            // echo json_decode($results);

        }
        // var_dump($results);

        break;
    case 'promotion-create':
        $name = convertName($_POST['name']);
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $detail = $_POST['detail'];
        $promotion_type = $_POST['promotion_type'];
        $discount = $_POST['discount'];
        $condition_discount = $_POST['condition_discount'];
        $status = $_POST['status'];
        $promotion = new Promotion();

        $results = $promotion->insertPromotion(
            $name,
            $start_date,
            $end_date,
            $detail,
            $promotion_type,
            $discount,
            $condition_discount,
            $status
        );

        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?promotion');

        break;

    case 'promotion-edit-form':
        $promotion_ID = $_GET['promotion_ID'];

        $promotion = new Promotion();
        $r = $promotion->getPromotionById($promotion_ID);

        include '../views/admin/promotion.php';
        break;

    case 'promotion-edit':
        $promotion_ID = $_POST['promotion_ID'];
        $name = convertName($_POST['name']);
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $detail = $_POST['detail'];
        $promotion_type = $_POST['promotion_type'];
        $discount = $_POST['discount'];
        $condition_discount = $_POST['condition_discount'];
        $status = $_POST['status'];

        $promotion = new Promotion();
        $results = $promotion->updatePromotion(
            $promotion_ID,
            $name,
            $start_date,
            $end_date,
            $detail,
            $promotion_type,
            $discount,
            $condition_discount,
            $status
        );
        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?promotion');
        break;

    case 'promotion-delete':
        $promotion_ID = $_GET['promotion_ID'];
        $promotion = new Promotion();
        $results = $promotion->deletePromotion($promotion_ID);
        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?promotion');
        break;
}
