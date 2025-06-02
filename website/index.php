<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
define('SITE_ROOT', realpath(dirname(__DIR__)));
require_once "Database.php";

$db = new Database();
$connect = $db->getConnection();

$error_message = "";

$query = "select * from sanpham sp left join DanhMuc dm on sp.maLoai = dm.maLoai";
$stmt = $connect->prepare($query);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$list_sanpham = $stmt->fetchAll();
// echo "<pre>";
// var_dump($list_sanpham);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap 5 Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container-fluid p-5 bg-primary text-white text-center">
        <h1>Dashboard</h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <?php include "./includes/sidebar.php" ?>
            <div class="col-sm-8">
                <?php include "./includes/message.php" ?>
                <h4>Quản lý sản phẩm</h4>
                <!-- form -->
                <a href="sanpham/them_sanpham.php" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã Loại</th>
                            <th>Tên SP</th>
                            <th>Số Lượng</th>
                            <th>Danh mục</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($list_sanpham) > 0) {
                            foreach ($list_sanpham as $item) { ?>
                                <tr>
                                    <td><?php echo $item['maSP'] ?></td>
                                    <td><?php echo $item['tenSP'] ?></td>
                                    <td><?php echo $item['soLuong'] ?></td>
                                    <td><?php echo $item['TenLoai'] ?></td>
                                    <td>
                                        <a class="btn btn-danger" href="delete-danhmuc.php?id=<?= $item['maLoai'] ?>">xoá</a>
                                        <a class="btn btn-info" href="edit-danhmuc.php?id=<?= $item['maLoai'] ?>">sửa</a>
                                    </td>
                                </tr>

                            <?php }
                            ?>



                        <?php  } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    if (isset($_SESSION['message'])) {
        unset($_SESSION['message']);
    }
    ?>

</body>

</html>