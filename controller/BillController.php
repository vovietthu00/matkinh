<?php
require '../model/bill.php';

if (isset($_GET['act']))
    $action = $_GET['act'];
else if (isset($_POST['act']))
    $action = $_POST['act'];
else
    $action = 'bill-list';


switch ($action) {
    case 'bill-list':
        $bill = new Bill();
        $results = $bill->getBillList();
        include '../views/admin/bill.php';
        break;

    case 'bill-edit-form':
        $bill_ID = $_GET['bill_ID'];

        $bill = new Bill();
        $b = $bill->getBillById($bill_ID);
        $bill_product = $bill->getListBillProductByBillId($bill_ID);
        if ($b['promotion_ID'] != 0) {
            $promotion = $bill->getPromotionById($b['promotion_ID']);
        } else {
            $promotion['name'] = '';
        }
        include '../views/admin/bill.php';
        break;

    case 'bill-edit':
        $bill_ID = $_POST['bill_ID'];
        $status = $_POST['status'];
        $payment_status = $_POST['payment_status'];

        $bill = new Bill();
        $results = $bill->updateBill(
            $bill_ID,
            $status,
            $payment_status
        );
        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?bill');
        break;

    case 'bill-delete':
        $bill_ID = $_GET['bill_ID'];
        $bill = new Bill();
        $results = $bill->deleteBill($bill_ID);
        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?bill');
        break;
}
