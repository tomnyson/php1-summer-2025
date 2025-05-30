<?php
require_once "Database.php";

$db = new Database();
$connect = $db->getConnection();

$error_message = "";
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (empty($_POST['maLoai'])) {
        $error_message = "Mã Loại không để trống <br/>";
    }
    if (empty($_POST['tenLoai'])) {
        $error_message .= "Tên Loại không để trống </br>";
    }
    if ($error_message == "") {
        // check ton tai ma loai
        $query_kiemtratontai  = "select * from DanhMuc  where maLoai = :maLoai";
        $stmt = $connect->prepare($query_kiemtratontai);
        $stmt->bindParam(':maLoai', $_POST['maLoai']);
        $stmt->execute();
        $isExist = count($stmt->fetchAll()) > 0;
        if (!$isExist) {
            // thêm nếu không trùng
            $query_insert = "INSERT INTO DanhMuc(TenLoai,maLoai) values (:tenLoai, :maLoai)";
            $stmt = $connect->prepare($query_insert);
            $stmt->bindParam(':tenLoai', $_POST['tenLoai']);
            $stmt->bindParam(':maLoai', $_POST['maLoai']);
            $result =  $stmt->execute();
        } else {
            $error_message .= "Mã không được trùng <br/>";
        }
    }
}