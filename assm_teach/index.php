<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Trang chủ | Cửa hàng Công nghệ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Cửa hàng công nghệ: Điện thoại, laptop, phụ kiện chính hãng, khuyến mãi sốc!">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Roboto', Arial, sans-serif; background: #f8f9fa; }
    .menu { background: #fff; padding: 1.2rem 1rem; border-radius: 1rem; margin-bottom: 2rem; }
    .menu a { font-family: 'Playfair Display', serif; margin-right: 1.5rem; font-weight: 500; color: #0d6efd; text-decoration: none; }
    .menu a.active, .menu a:hover { color: #fff; background: #0d6efd; border-radius: 6px; padding: 0.25rem 0.75rem; }
    .hero { background: linear-gradient(92deg, #4776e6, #8e54e9); color: #fff; border-radius: 1.2rem; padding: 3.5rem 1rem 2.7rem 1rem; margin-bottom: 2.2rem; }
    .hero-title { font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 700; }
    .hero-desc { font-size: 1.2rem; margin-bottom: 1.7rem; }
    .cta-btn { font-size: 1.1rem; font-weight: 600; border-radius: 2rem; padding: 0.7rem 2.5rem; }
    .category-card { background: #fff; border-radius: 1rem; box-shadow: 0 2px 10px #0001; text-align: center; padding: 1.5rem 1rem; transition: box-shadow .2s; }
    .category-card:hover { box-shadow: 0 4px 24px #0002; }
    .category-icon { font-size: 2.3rem; margin-bottom: 0.7rem; color: #615fbe;}
    .section-title { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem; }
    .product-card { border-radius: 1rem; border: 1px solid #dee2e6; background: #fff; padding: 1.25rem; margin-bottom: 2rem; box-shadow: 0 2px 8px #0001; }
    .product-title { font-family: 'Playfair Display', serif; font-weight: 700; }
    .product-category { font-size: 0.95rem; color: #6c757d; }
    .product-img { width: 100%; height: 180px; object-fit: contain; background: #f3f3f3; border-radius: 0.5rem; margin-bottom: 1rem; }
    .add-cart-btn { font-weight: 500; letter-spacing: 0.04em; }
    footer { padding: 2rem 0 1rem 0; background: #fff; border-top: 1px solid #eaeaea; text-align: center; margin-top: 3rem; border-radius: 1rem 1rem 0 0;}
    @media (max-width: 991px) {
      .hero-title { font-size: 1.5rem; }
      .section-title { font-size: 1.35rem; }
      .category-card { padding: 1rem 0.5rem; }
      .product-card { padding: 0.7rem; }
    }
  </style>
</head>
<body>
   <?php 
          require "./db_utils.php";
          $db_util = new DB_UTILS();
          $dsDanhMuc = $db_util->getAll('select * from DanhMuc');
          $dsSanPham = $db_util->getAll('select * from sanpham sp left join danhmuc dm on sp.maLoai = dm.maLoai  ');
          // echo "<pre>";
          // var_dump( $dsSanPham);
          // echo "</pre>";
          // die;

    ?>
  <div class="container" style="max-width: 1150px; margin-top: 36px;">
    <!-- Menu -->
    <nav class="menu d-flex align-items-center mb-4">
      <a href="index.html" class="active">Trang chủ</a>
      <a href="product-list.php">Sản phẩm</a>
      <a href="about.html">Giới thiệu</a>
      <a href="contact.html">Liên hệ</a>
      <a href="cart.html">Giỏ hàng</a>
      <a href="profile.html">Tài khoản</a>
    </nav>
    <!-- Banner/Hero -->
    <div class="hero text-center mb-5">
      <div class="hero-title mb-2">Cửa hàng Công nghệ Uy tín</div>
      <div class="hero-desc">Nơi bạn tìm thấy điện thoại, laptop, phụ kiện chất lượng và dịch vụ tốt nhất.<br />Khuyến mãi hấp dẫn mỗi ngày!</div>
      <a href="products.html" class="btn btn-warning cta-btn shadow-sm">Khám phá ngay</a>
    </div>
    <!-- Danh mục nổi bật -->
    <div class="mb-5">
      <div class="section-title">Danh mục nổi bật</div>
      <div class="row g-3">
        <?php foreach($dsDanhMuc as $danhmuc): ?>
        <div class="col-6 col-md-3">
          <a href="products.html?cat=smartphone" class="category-card d-block h-100">
            <div class="category-icon"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16"><path d="M11 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h6zm1 2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V3z"/><path d="M8 12.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/></svg></div>
            <div><?php echo $danhmuc['TenLoai']; ?></div>
          </a>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <!-- Sản phẩm mới -->
    <div class="mb-5">
      <div class="section-title">Sản phẩm mới</div>
      <div class="row">
         <?php foreach($dsSanPham as $sanpham): ?>
        <div class="col-lg-3 col-md-4 col-6">
          <div class="product-card h-100 d-flex flex-column">
            <img src="<?php echo $sanpham['hinhAnh'];?>" alt="<?php echo $sanpham['tenSP'];?>" class="product-img" />
            <div class="product-title"><?php echo $sanpham['tenSP'];?></div>
            <div class="product-category"><?php echo $sanpham['TenLoai'];?></div>
            <div class="my-2">Quantity: <?php echo $sanpham['soLuong'];?></div>
            <a href="product-detail.html?id=1" class="btn btn-outline-primary mb-2 w-100">Xem chi tiết</a>
            <a href="cart.html?add=1" class="btn btn-warning add-cart-btn w-100">Thêm vào giỏ</a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <!-- CTA -->
    <div class="text-center mb-5">
      <h3 class="mb-3" style="font-family: 'Playfair Display', serif;">Nhận thông tin khuyến mãi mới nhất</h3>
      <form class="d-flex justify-content-center flex-wrap gap-2" style="max-width:420px; margin:auto;">
        <input type="email" class="form-control" placeholder="Nhập email của bạn" required>
        <button class="btn btn-primary px-4" type="submit">Đăng ký</button>
      </form>
    </div>
    <!-- Footer -->
    <footer>
      <div class="text-muted">© 2025 Công ty Công nghệ ABC - All rights reserved.</div>
      <div class="small mt-2">
        <a href="privacy.html" class="me-3">Chính sách bảo mật</a>
        <a href="terms.html">Điều khoản sử dụng</a>
      </div>
    </footer>
  </div>
</body>
</html>