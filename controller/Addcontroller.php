<!-- <?php
require '../model/admin.php';

if (isset($_GET['act']))
    $action = $_GET['act'];
else if (isset($_POST['act']))
    $action = $_POST['act'];
else
    $action = 'admin-list';


switch ($action) {
    case 'admin-list':
        $admin = new Admin();
        $results = $admin->getAdminList();
        include '../views/admin/admin.php';
        break;
    case 'admin-create-form':
        $admin = new Admin();
        $results = $admin->getAdminList();
        include '../views/admin/admin.php';
        break;

    case 'admin-edit-form':
        $admin_ID = $_GET['admin_ID'];

        $admin = new Admin();
        $r = $admin->getAdminById($admin_ID);
        // $r=$results->fetch_assoc();
        include '../views/admin/admin.php';
        break;
    case 'admin-create':
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        

        $admin = new Admin();
        $results = $admin->insertAdmin(
            $username,
            $password,
            
        );
        if ($results) {
            $_SESSION['success'] = 'Thêm tài khoản thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Thêm tài khoản thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?admin');
        break;

    case 'admin-edit':
        $admin_ID = $_POST['admin_ID'];
        $username = $_POST['username'];
        
        $admin = new Admin();
        $results = $admin->updateAdmin(
            $admin_ID,
            $username,
            
        );
        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?admin');
        break;

    case 'admin-delete':
        $admin_ID = $_GET['admin_ID'];
        $admin = new Admin();
        $results = $admin->deleteAdmin($admin_ID);
        if ($results) {
            $_SESSION['success'] = 'Cập nhật thành công!';
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
            unset($_SESSION['success']);
        }
        header('location: index.php?admin');
        break;
}
 -->
