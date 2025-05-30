<?php
session_start();
require_once "../Database.php";

$db = new Database();
$connect = $db->getConnection();

$error_message = "";

$query = "select * from DanhMuc";
$stmt = $connect->prepare($query);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$danhmuc = $stmt->fetchAll();
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
            <?php include "../includes/sidebar.php" ?>
            <div class="col-sm-8">
                <?php
                if (isset($_SESSION['message']) && !empty($_SESSION['message']['success'])) {
                    echo "<div class='alert alert-success'>" .
                    $_SESSION['message']['success'] .
                    "</div>";
                } else if (isset($_SESSION['message']) && !empty($_SESSION['message']['error'])) {
                    echo "<div class='alert alert-danger'>" .
                        $_SESSION['message']['error'] .
                        "</div>";
                }
                ?>
                <h4>Thêm mới sản phẩm</h4>
                <!-- form -->
                <?php include "./form_sanpham.php" ?>
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