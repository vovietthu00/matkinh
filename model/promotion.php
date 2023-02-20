<?php

require_once 'database.php';

class Promotion
{

    public function insertPromotion($name, $start_date, $end_date, $detail, $promotion_type, $discount, $condition_discount, $status)
    {
        $db = new connect();
        $sql = "INSERT INTO promotions (name, start_date, end_date, detail, promotion_type, discount, condition_discount, status) 
        VALUES ('$name', '$start_date', '$end_date', '$detail', '$promotion_type', '$discount', '$condition_discount', '$status')";
        $r = $db->exec($sql);
        return $r;
    }
    public function getPromotionList()
    {
        $db = new connect();
        $sql = 'SELECT * FROM promotions';
        $r = $db->getList($sql);
        return $r;
    }

    public function getPromotionById($promotion_ID)
    {
        $db = new connect();
        $sql = "SELECT * FROM promotions WHERE promotion_ID=$promotion_ID";
        $r = $db->getInstance($sql);
        return $r;
    }
    public function getPromotionByName($name)
    {
        $db = new connect();
        $sql = "SELECT * FROM promotions WHERE name='$name'";
        $r = $db->getInstance($sql);
        return $r;
    }

    public function updatePromotion($promotion_ID, $name, $start_date, $end_date, $detail, $promotion_type, $discount, $condition_discount, $status)
    {
        $db = new connect();
        $sql = "UPDATE promotions 
        SET name='$name', 
        start_date='$start_date', 
        end_date='$end_date', 
        detail='$detail', 
        promotion_type='$promotion_type', 
        discount='$discount', 
        condition_discount='$condition_discount',
        status='$status' 
        WHERE promotion_ID='$promotion_ID'";
        $r = $db->exec($sql);
        return $r;
    }
    public function deletePromotion($promotion_ID)
    {
        $db = new connect();
        $sql = "DELETE FROM promotions WHERE promotion_ID='$promotion_ID'";
        $r = $db->exec($sql);
        return $r;
    }
}
