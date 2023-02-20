<?php

require_once 'database.php';

class Category
{

    public function insertCategory($name, $status)
    {
        $db = new connect();
        $sql = "INSERT INTO categories (name, status) VALUES ('$name', '$status')";
        $r = $db->exec($sql);
        return $r;
    }
    public function getCategoryList()
    {
        $db = new connect();
        $sql = 'SELECT * FROM categories';
        $r = $db->getList($sql);
        return $r;
    }

    public function getCategoryByName($name)
    {
        $db = new connect();
        $sql = "SELECT * FROM categories WHERE name='$name'";
        $r = $db->getInstance($sql);
        return $r;
    }
    public function getCategoryById($category_ID)
    {
        $db = new connect();
        $sql = "SELECT * FROM categories WHERE category_ID=$category_ID";
        $r = $db->getInstance($sql);
        return $r;
    }


    public function updateCategory($category_ID, $name, $status)
    {
        $db = new connect();
        $sql = "UPDATE categories SET name='$name', status='$status' WHERE category_ID='$category_ID'";
        $r = $db->exec($sql);
        return $r;
    }
    public function deleteCategory($category_ID)
    {
        $db = new connect();
        $sql = "DELETE FROM categories WHERE category_ID='$category_ID'";
        $r = $db->exec($sql);
        return $r;
    }


}
