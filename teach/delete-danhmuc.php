<?php
require_once "Database.php";

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
            $query= "Delete from DanhMuc where maLoai=:maLoai";
            $stmt = $connect->prepare($query);
            $stmt->bindParam(':maLoai', $_GET['id']);
            $stmt->execute();
            $_SESSION['message']='Da xoa thanh cong';
            header('location:danhmuc.php');
            exit();
        } else {
            echo "id not empty";
        }
       
        

    }
    
?>