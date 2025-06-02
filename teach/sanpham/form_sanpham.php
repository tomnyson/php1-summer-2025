<form method="post" action="./process_sanpham.php">
    <label class="form-label" for="ten">Mã: </label>
    <input class="form-control" value="<?php
echo uniqid();
?>" type="text" name="maSP" readonly>
    <label class="form-label" for="">Tên</label>
    <input class="form-control" type="text" name="tenSP">
    <label class="form-label" for="">Giá</label>
    <input class="form-control" type="number" name="gia">
    <label class="form-label" for="">Số lượng</label>
    <input class="form-control" type="number" name="soLuong">
    <label class="form-label" for="">danh mục</label>
     <select name="maLoai" class="form-control">
        <?php foreach($danhmuc as $item): ?>
        <option value="<?php echo $item['maLoai'] ?>"><?php echo $item['TenLoai'] ?></option>
        <?php endforeach; ?>
     </select>
     <label class="form-label" for="">hình ảnh</label>
     <input class="form-control" type="text" name="hinhAnh">
     <label class="form-label" for="">mô tả</label>
     <textarea rows="4" class="form-control" name="moTa"></textarea>
    <?php
    if (!empty($error_message)) {
        echo "<span class='text-danger'>$error_message</span>";
    }
    ?>
    <button type="sumbit" class="btn btn-primary mt-2" name="nut">Create</button>
</form>