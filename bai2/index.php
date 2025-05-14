<html>
    <head>
        <title>php 1 co ban</title>
        <style>
                label, textarea, button {
                    display: block;
                    margin-top: 5px;
                }
                label {
                    font-weight: bold;
                }
                .xanh {
                    color: green;
                }
                .do {
                    color: red;
                }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <head>
    <body>
        <div class="container">
        <h1>Vòng lặp</h1>
        <form action="" method="POST">
            <label class="form-label">số thứ 1</label>
            <input type="number" class="form-control"  name="sothu1" placeholder="số thứ 1"/>
            <label class="form-label">số thứ 2</label>
            <input type="number" class="form-control"  name="sothu2" placeholder="số thứ 2"/>
            <button class="btn btn-primary mt-2" type="submit" name="action" value="bai1">Kết quả</button>
        </form>
        <h1>Hiển thị ds sinh viên và đếm số</h1>
        <form action="" method="POST">
            <label class="form-label">Ds Sinh viên</label>
            <textarea class="form-control" rows="4"  name="ds" placeholder="nhập danh sách"></textarea>
            <button class="btn btn-primary mt-2" type="submit" name="action" value="bai2">Kết quả</button>
        </form>
        <?php
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);

            if($_SERVER['REQUEST_METHOD'] == "POST") {
               $bai = $_POST['action'];
               if($bai == "bai1") {
                if(isset($_POST['sothu1']) && isset($_POST['sothu2'])) {
                    $sothu1 = intval($_POST['sothu1']);
                    $sothu2 = intval($_POST['sothu2']);
                    if(intval($sothu1) >= intval($sothu2)) {
                        echo "số thứ nhất < số thứ 2";
                    } else {
                        echo $sothu1;
                        echo $sothu2;
                        for($i = $sothu1 ; $i<=$sothu2;$i++){
                            echo $i . "<br/>";
                        }
                
                    }
                }
               } else if ($bai == "bai2") {
               } if(isset($_POST['ds'])){
                if(empty($_POST['ds'])){
                    echo 'phải có dữ liệu <br/>';
                }else {
                    $ds_sv = trim($_POST['ds']);
                    $arr_sv = explode("\n", $ds_sv);
                    // print_r($arr_sv);
                    /**
                     * in ra chan xanh color
                     * in le do color
                     * dem so luong sv nhap vao
                     */
                    for($i = 0; $i < count($arr_sv); $i++){
                        if($i%2==0){
                            echo "<p class='xanh'>$arr_sv[$i]</p><br>";
                        }
                        else {
                            echo "<p class='do'>$arr_sv[$i]</p><br>";
                        }


                    }
                }
               }
            }else {
                echo "wrong";
            }
            
        ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </body>
</html>