<?php
require_once "Database.php";

$db = new Database();
$connect = $db->getConnection();
$query = "select * from DanhMuc";
$stmt = $connect->prepare($query);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$danhmuc = $stmt->fetchAll();
// var_dump($danhmuc);
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
                <h4>Quản lý danh mục</h4>
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
                                    <td></td>
                                </tr>

                            <?php }
                            ?>



                        <?php  } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>