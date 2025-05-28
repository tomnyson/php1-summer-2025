<?php
session_start();
require_once "Database.php";

$db = new Database();
$connect = $db->getConnection();

// var_dump($danhmuc);
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

            <div class="col-sm-4">
                <a href="/danhmuc.php"> Danh Mục</a>
            </div>
            <div class="col-sm-8">
                <?php
                if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
                    echo "<div class='alert alert-info'>
  <strong>Info!</strong> $_SESSION[message]
</div>";
                }
                ?>
                <h4>Quản lý danh mục</h4>
                <!-- form -->
                <form method="post" action="">
                    <label class="form-label" for="ten">Mã danh mục: </label>
                    <input class="form-control" type="text" name="maLoai">
                    <label class="form-label" for="">Tên Danh mục</label>
                    <input class="form-control" type="text" name="tenLoai">
                    <?php
                    if (!empty($error_message)) {
                        echo "<span class='text-danger'>$error_message</span>";
                    }
                    ?>
                    <button type="sumbit" class="btn btn-primary mt-2" name="nut">Create</button>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã Loại</th>
                            <th>Tên Loại</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($danhmuc) > 0) {
                            foreach ($danhmuc as $item) { ?>
                                <tr>
                                    <td><?php echo $item['maLoai'] ?></td>
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
        if(isset($_SESSION['message'])) {
            unset($_SESSION['message']);
        }
    ?>

</body>

</html>