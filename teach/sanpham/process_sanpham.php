<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
define('SITE_ROOT', realpath(dirname(__DIR__)));
require_once SITE_ROOT . "/Database.php";
$db = new Database();
$connect = $db->getConnection();

$error_message = "";
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (empty($_POST['tenSP'])) {
        $error_message .= "Tên không để trống </br>";
    }
    if (empty($_POST['gia'])) {
        $error_message .= "gia không để trống </br>";
    }

    if (empty($_POST['soLuong'])) {
        $error_message .= "số lượng không để trống </br>";
    }
    if (empty($_POST['maLoai'])) {
        $error_message .= "danh mục không để trống </br>";
    }

    if (empty($_POST['hinhAnh'])) {
        $error_message .= "hình ảnh không để trống </br>";
    }

    if ($error_message == "") {
        // check ton tai ma loai
        try {
            $query_insert = "INSERT INTO sanpham(maSP,tenSP, soLuong, gia, moTa, maLoai, hinhAnh, ngayTao) values (:maSP, :tenSP, :soLuong, :gia, :moTa, :maLoai, :hinhAnh, :ngayTao)";
            $stmt = $connect->prepare($query_insert);
            $stmt->bindParam(':maSP', $_POST['maSP']);
            $stmt->bindParam(':tenSP', $_POST['tenSP']);
            $stmt->bindParam(':soLuong', $_POST['soLuong']);
            $stmt->bindParam(":maLoai", $_POST['maLoai']);
            $stmt->bindParam(':gia', $_POST['gia']);
            $stmt->bindParam(':moTa', $_POST['moTa']);
            $stmt->bindParam(':hinhAnh', $_POST['hinhAnh']);
            $date = date('Y-m-d H:i:s');
            $stmt->bindParam(":ngayTao", $date );
            $stmt->execute();
            $_SESSION['message']['success']= "thêm sản phẩm thành công";
            header('location: ../sanpham.php');
            exit();
        } catch(Exception $e) {
            print_r($e->getMessage());
        }
           
    }else {
        $_SESSION['message']['error']= $error_message;
        header('location: them_sanpham.php');
        exit();
    }
}