<?php
require_once  "Database.php";

$db = new Database();
$connect = $db->getConnection();

$stmt = $connect->prepare("SELECT * FROM sanpham sp LEFT JOIN DanhMuc dm ON sp.maLoai = dm.maLoai");
$stmt->execute();
$list_sanpham = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = "Trang chủ";
$header = "Quản lý sản phẩm";
ob_start();
?>

<a href="sanpham/them_sanpham.php" class="btn btn-success mb-3">Thêm mới</a>
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
        <?php foreach ($list_sanpham as $item): ?>
        <tr>
            <td><?= $item['maSP'] ?></td>
            <td><?= $item['tenSP'] ?></td>
            <td><?= $item['soLuong'] ?></td>
            <td><?= $item['TenLoai'] ?></td>
            <td>
                <a class="btn btn-danger" href="delete-danhmuc.php?id=<?= $item['maLoai'] ?>">Xoá</a>
                <a class="btn btn-info" href="edit-danhmuc.php?id=<?= $item['maLoai'] ?>">Sửa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include SITE_PATH . "/layout.php"; // hoặc SITE_PATH . "/layout.php" nếu dùng hằng số
?>