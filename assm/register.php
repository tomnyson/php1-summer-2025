<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Roboto&display=swap" rel="stylesheet" />
  <link href="shared.css" rel="stylesheet" />
</head>
<body>
  <?php
  require "./db_utils.php";
  $db_util = new DB_UTILS();
  $error = "";
      if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
          $error.="dữ liệu không được trống";
        }
        if($error == "") {
          $check_email = "select * from khachhang where email = ?";
          $result = $db_util->getOne($check_email,[$_POST['email']]);
          if(!$result) {
            $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $inser_user = "insert into khachhang(makh,tenkh,email,password,status, role) values(?,?,?,?,?,?)";
            $makh = uniqid();
            $result_user = $db_util->execute($inser_user,[
              $makh,
              $_POST['name'],
              $_POST['email'],
              $password_hash,
              1,
              'user'
            ]);
          }
        } else {
            $error = " email da bi trung ";
        }
      }
   ?>
  <div class="auth-container">
    <h2>Electric Store    </h2>
    <?php
      echo " email bi trung ";
    ?>
    <form id="registerForm" method="post" action="">
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required />
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required />
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required />
      </div>
      <div class="d-grid">
        <button class="btn btn-primary">Register</button>
      </div>
      <div class="form-text text-center mt-3">
        Already have an account? <a href="login.php">Login</a>
      </div>
    </form>
  </div>
</body>
</html>