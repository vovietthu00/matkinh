<?php
require '../model/category.php';

if (isset($_GET['act']))
    $action = $_GET['act'];
else if (isset($_POST['act']))
    $action = $_POST['act'];
else
    $action = 'category-list';


switch ($action) {
    case 'category-list':
        $category = new Category();
        $results = $category->getCategoryList();
        include '../views/admin/category.php';
        break;

    case 'category-create-form':
        include '../views/admin/category.php';
        break;

    case 'category-name':
        $name = $_POST['name'];
        $category = new Category();
        $results = $category->getCategoryByName($name);
        if ($results) {
            echo 'error';
        } else {
            echo 'success';
        }
        break;

    case 'category-create':
        $name = $_POST['name'];
        $status = $_POST['status'];
        $category = new Category();

        $results = $category->insertCategory(
            $name,
            $status
        );

        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?category');

        break;

    case 'category-edit-form':
        $category_ID = $_GET['category_ID'];

        $category = new Category();
        $r = $category->getCategoryById($category_ID);
        // $r=$results->fetch_assoc();
        include '../views/admin/category.php';
        break;

    case 'category-edit':
        $category_ID = $_POST['category_ID'];
        $name = $_POST['name'];
        $status = $_POST['status'];

        $category = new Category();
        $results = $category->updateCategory(
            $category_ID,
            $name,
            $status
        );
        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?category');
        break;

    case 'category-delete':
        $category_ID = $_GET['category_ID'];
        $category = new Category();
        $results = $category->deleteCategory($category_ID);
        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?category');
        break;
}
