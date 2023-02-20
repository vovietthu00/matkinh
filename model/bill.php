<?php

require_once 'database.php';

class Bill 
{
    public function getBillList()
    {
        $db = new connect();
        $sql = "SELECT b.*, c.username FROM bills b INNER JOIN customers c ON b.customer_ID=c.customer_ID";
        $r = $db->getList($sql);
        return $r;
    }

    public function getBillById($bill_ID)
    {
        $db = new connect();
        $sql = "SELECT b.*, c.username, c.first_name, c.last_name, c.email 
        FROM bills b INNER JOIN customers c 
        ON b.customer_ID=c.customer_ID 
        WHERE bill_ID=$bill_ID";
        $r = $db->getInstance($sql);
        return $r;
    }

    public function getListBillProductByBillId($bill_ID)
    {
        $db = new connect();
        $sql = "SELECT b_p.*,p.name 
        FROM bill_product b_p INNER JOIN products p 
        ON b_p.product_ID=p.product_ID  
        WHERE bill_ID='$bill_ID'";
        $r = $db->getList($sql);
        return $r;
    }


    public function updateBill($bill_ID, $status, $payment_status)
    {
        $db = new connect();
        $sql = "UPDATE bills SET status='$status', payment_status='$payment_status' WHERE bill_ID='$bill_ID'";
        $r = $db->exec($sql);
        return $r;
    }
    public function deleteBill($bill_ID)
    {
        $db = new connect();
        $sql = "DELETE FROM bills WHERE bill_ID='$bill_ID'";
        $r = $db->exec($sql);
        return $r;
    }

    public function getPromotionById($promotion_ID)
    {
        $db = new connect();
        $sql = "SELECT * FROM promotions WHERE promotion_ID='$promotion_ID'";
        $r = $db->getInstance($sql);
        return $r;
    }


}
