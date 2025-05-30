<?php
session_start();
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
        // thêm nếu không trùng
        $query_update = "UPDATE DanhMuc set TenLoai = :tenLoai where maLoai = :maLoai";
        $stmt = $connect->prepare($query_update);
        $stmt->bindParam(':tenLoai', $_POST['tenLoai']);
        $stmt->bindParam(':maLoai', $_POST['maLoai']);
        $result =  $stmt->execute();
        $_SESSION['message'] = 'Cập nhật thành cống';
        header('location:danhmuc.php');
        exit();
    } else {
        $error_message .= "Mã không được trùng <br/>";
    }
}
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!empty($_GET['id'])) {
        $query_get_detail  = "select * from DanhMuc where maLoai =:maLoai";
        $stmt = $connect->prepare($query_get_detail);
        // var_dump($_GET);
        $stmt->bindParam(':maLoai', $_GET['id']);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $danhmuc = $stmt->fetchAll();
        echo "<pre>";
        var_dump($danhmuc);
        echo "</pre>";
        if (count($danhmuc) > 0) { ?>
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
                            <a href="danhmuc.php"> Danh Mục</a>
                        </div>
                        <div class="col-sm-8">
                            <h4>Sửa danh mục</h4>
                            <!-- form -->
                            <form method="post" action="">
                                <label class="form-label" for="ten">Mã danh mục: </label>
                                <input value="<?php echo $danhmuc[0]['maLoai'] ?>" class="form-control" type="text" name="maLoai" readonly>
                                <label class="form-label" for="">Tên Danh mục</label>
                                <input value="<?php echo $danhmuc[0]['TenLoai'] ?>" class="form-control" type="text" name="tenLoai">
                                <?php
                                if (!empty($error_message)) {
                                    echo "<span class='text-danger'>$error_message</span>";
                                }
                                ?>
                                <button type="sumbit" class="btn btn-primary mt-2" name="nut">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
    <?php     } else {
            echo "Id không tồn tại";
        }
    }
} ?>
    <?php
    if (isset($_SESSION['message'])) {
        unset($_SESSION['message']);
    }
    ?>
            </body>

            </html>