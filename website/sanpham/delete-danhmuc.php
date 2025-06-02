<?php
define('SITE_ROOT', realpath(dirname(__DIR__)));
require_once SITE_ROOT . "/Database.php";
$db = new Database();
$connect = $db->getConnection();
session_start();
    if($_SERVER["REQUEST_METHOD"] == 'GET' ){
        /**
         * mo connect db
         *  tao query delete  -> DanhMuc
         * check query delete
         * ghi thong bao vao trong session bien message
         * chuyen huong ve trang danh sach
         */
        if(!empty($_GET['id'])) {
            $query= "Delete from sanpham where maSP=:maSP";
            $stmt = $connect->prepare($query);
            $stmt->bindParam(':maSP', $_GET['id']);
            $stmt->execute();
            $_SESSION['message']='Da xoa thanh cong';
            header('location:danhmuc.php');
            exit();
        } else {
            echo "id not empty";
        }
       
        

    }
    
?>