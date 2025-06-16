<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Shopping Cart & Checkout</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Roboto&display=swap" rel="stylesheet" />
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Roboto', Arial, sans-serif;
    }

    .menu {
      background: #fff;
      padding: 1.2rem 1rem;
      border-radius: 1rem;
      margin-bottom: 2rem;
    }

    .menu a {
      font-family: 'Playfair Display', serif;
      margin-right: 1.5rem;
      font-weight: 500;
      color: #0d6efd;
      text-decoration: none;
    }

    .menu a.active,
    .menu a:hover {
      color: #fff;
      background: #0d6efd;
      border-radius: 6px;
      padding: 0.25rem 0.75rem;
    }

    .cart-table td,
    .cart-table th {
      vertical-align: middle;
    }

    .cart-product-img {
      width: 64px;
      height: 64px;
      object-fit: contain;
      border-radius: 8px;
      background: #f6f8fa;
    }

    .cart-summary {
      background: #fff;
      border-radius: 1rem;
      box-shadow: 0 1px 8px #0001;
      padding: 1.5rem;
    }

    .checkout-form {
      background: #fff;
      border-radius: 1rem;
      box-shadow: 0 1px 8px #0001;
      padding: 2rem;
    }

    @media (max-width: 991px) {

      .cart-summary,
      .checkout-form {
        padding: 1rem;
      }
    }
  </style>
</head>

<body>
  <?php
  require_once("./db_utils.php");
  $db_utils = new DB_UTILS;
  $total = 0;
  $query_getcart = "SELECT * FROM carts crt left join sanpham sp on crt.product_id = sp.maSP left join danhmuc dm on dm.maLoai = sp.maLoai WHERE user_id =?";
  $result_getcart = $db_utils->getAll($query_getcart, [$_SESSION['user_id']]);
  // echo "<pre>";
  // var_dump($result_getcart);
  // echo "</pre>";

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
      $action = $_POST['action'];
      if ($action == 'checkout') {
        // lưu orders
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $method_payment = $_POST['payment'];
        $user_id = $_SESSION['user_id'];
        /**
         * b1: thêm orders trước
         * sau đó lấy lastId tạo ra.
         * duyệt qua cart và thêm vào order_detail
         * status: 'pending', 'confirm', 'delivery', 'complete'
         */
        $total = 0;
        foreach ($result_getcart as $item) {
          $total += $item['gia'] * $item['quantity'];
        }
        $date = date('Y-m-d H:i:s');
        $query_add_order = "INSERT INTO orders(address, phone,user_id, status, total, created_at, method_payment) values (?,?,?,?,?,?,?)";
        $check_insert = $db_utils->execute($query_add_order, [
          $address,
          $phone,
          $user_id,
          'pending',
          $total,
          $date,
          $method_payment
        ]);
        $order_id = $db_utils->getLastInsertId();
        foreach ($result_getcart as $item) {
          $query_insert_order_detail = "INSERT INTO order_details(order_id, product_id, price, quantity) value(?,?,?,?)";
          $check_insert = $db_utils->execute($query_insert_order_detail, [$order_id, $item['maSP'], $item['gia'], $item['quantity']]);
        }
        //xoá cart
        $query_clear_cart = "DELETE FROM carts where user_id = ?";
        $db_utils->execute($query_clear_cart, [$user_id]);
        // redirect ->
        header('Location: order-success.php');
      } else {
      }
    }
  }
  ?>
  <div class="container" style="max-width: 980px; margin-top: 40px;">
    <!-- Navigation menu -->
    <nav class="menu d-flex align-items-center mb-4">
      <a href="index.html">Home</a>
      <a href="products.html">Products</a>
      <a href="cart.html" class="active">Cart</a>
      <a href="about.html">About</a>
    </nav>

    <!-- Cart Section -->
    <section class="mb-5">
      <h2 class="mb-4" style="font-family: 'Playfair Display', serif;">Shopping Cart</h2>
      <div class="row g-4">
        <div class="col-lg-8">
          <div class="table-responsive">
            <table class="table cart-table align-middle bg-white rounded shadow-sm">
              <thead>
                <tr>
                  <th style="width: 72px;">Product</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th style="width:110px;">Quantity</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="cart-body">
                <?php if (count($result_getcart) > 0) {
                  foreach ($result_getcart as $item) {
                ?>
                    <!-- Demo cart items -->
                    <tr data-id="1">
                      <td>
                        <img src="<?= $item['hinhAnh'] ?>" alt="<?= $item['tenSP'] ?>" class="cart-product-img" />
                      </td>
                      <td>
                        <div class="fw-semibold"><?= $item['tenSP'] ?></div>
                        <div class="text-muted small"><?= $item['maLoai'] ?></div>
                      </td>
                      <td><?= $item['gia'] ?></td>
                      <td>
                        <input type="number" class="form-control form-control-sm cart-qty" min="1" max="<?= $item['soLuong'] ?>" value="<?= $item['quantity'] ?>" style="width:72px;" />
                      </td>
                      <td class="cart-item-total"><?= $item['gia'] * $item['quantity'];
                                                  $total += $item['gia'] * $item['quantity'];
                                                  ?></td>
                      <td>
                        <button class="btn btn-link text-danger cart-remove px-1" title="Remove">
                          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 6l12 12M6 18L18 6" />
                          </svg>
                        </button>
                      </td>
                    </tr>
                  <?php } ?>
                <?php } ?>
              </tbody>
            </table>
            <div id="cart-empty" class="text-center text-muted py-4 d-none">
              Your cart is empty.
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="cart-summary">
            <h5 class="mb-3">Order Summary</h5>
            <div class="d-flex justify-content-between mb-2">
              <span>Subtotal</span>
              <span id="cart-subtotal"><?= $total ?></span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Shipping</span>
              <span id="cart-shipping">$20</span>
            </div>
            <div class="d-flex justify-content-between fs-5 fw-bold border-top pt-2">
              <span>Total</span>
              <span id="cart-total">$3120</span>
            </div>
            <a href="#checkout" class="btn btn-primary w-100 mt-3" id="checkout-btn">Proceed to Checkout</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Checkout Section -->
    <section class="checkout-form mb-5" id="checkout">
      <h2 class="mb-4" style="font-family: 'Playfair Display', serif;">Checkout</h2>
      <form id="orderForm" class="row g-3" method="POST" action="">
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" name="name" required />
        </div>
        <div class="col-md-6">
          <label class="form-label">Phone</label>
          <input type="tel" class="form-control" name="phone" required />
        </div>
        <div class="col-12">
          <label class="form-label">Address</label>
          <input type="text" class="form-control" name="address" required />
        </div>
        <div class="col-12">
          <label class="form-label">Payment Method</label>
          <select class="form-select" name="payment" required>
            <option value="">Select…</option>
            <option value="cod">Cash on Delivery</option>
            <option value="bank">Bank Transfer</option>
          </select>
        </div>
        <div class="col-12 text-end">
          <button type="submit" name="action" value="checkout" class="btn btn-success">Place Order</button>
        </div>
      </form>
      <div id="order-success" class="alert alert-success mt-4 d-none">
        🎉 Your order has been placed successfully!
      </div>
    </section>
  </div>
</body>

</html>