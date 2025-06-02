<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Roboto&display=swap" rel="stylesheet" />
  <link href="shared.css" rel="stylesheet" />
</head>
<body>
  <div class="auth-container">
    <h2>PHP EASY GO</h2>
    <form id="loginForm"  method="post" action="">
      <div class="mb-3">
        <?php 
          require "./db_utils.php";
          $db_util = new DB_UTILS();
          $error = "";
          if ($_SERVER['REQUEST_METHOD']== 
          "POST"){
            if (empty($_POST['email'] || empty('password'))){
              $error .= "emal and password not empty";
            }if ($error == ""){
              // b1
              $check_email = "select * From khachhang where email = ?";
              $result = $db_util->getOne($check_email, [$_POST['email']]);
              if($result) {
                //b2
                //kiem tra khop tai khoan or mat khau
              $kt_matkhau = password_verify($_POST['password'], $result['password']);
              if($kt_matkhau) {
                $_SESSION['user_id'] = $result['makh'];
                $_SESSION['name'] = $result['tenkh'];
                $_SESSION['role'] = $result['role'];
              } else {
                $error.= "email or password wrong";
              }
              }
            }
          }
        ?>
        <label>Email</label>
        <input type="email" name="email" class="form-control" required />
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required />
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
      <?php if($error !== "") {
        echo "<span class='text-danger'>$error</span>";
      } ?>
      <div class="form-text text-center mt-3">
        <a href="forgot.html">Forgot password?</a> · <a href="register.php">Sign up</a>
      </div>
    </form>
  </div>
</body>
</html>