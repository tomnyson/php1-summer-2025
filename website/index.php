<?php
/**
 * b1: ket noi mysql
 * b2: viet cau query thuan 
 * b3: do cau query vaof pdo
 * b4: huong ket qua tra ve
 */
require_once "Database.php";

$db = new Database();
$connect = $db->getConnection();
// var_dump($connect);
if(!empty($connect)) {
    $query = "select * from DanhMuc";
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $listDanhMuc = $stmt->fetchAll();
    foreach($listDanhMuc as $danhmuc) {
        echo $danhmuc->maLoai;
        // echo $danhmuc["TenLoai"];
    }
} else {
    echo "no connect";
}
