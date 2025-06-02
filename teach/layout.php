<?php
if (!isset($title)) $title = 'Trang chủ';
if (!isset($header)) $header = '';
if (!isset($content)) $content = '';
if (!defined('SITE_PATH')) {
    define('SITE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/php1-2025/website');
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="container-fluid p-3 bg-primary text-white text-center">
        <h1><?= htmlspecialchars($header) ?></h1>
    </header>
    <div class="container mt-5">
        <div class="row">
            <?php include SITE_PATH . '/includes/sidebar.php'; ?>
            <div class="col-sm-8">
                <?php include SITE_PATH . '/includes/message.php'; ?>
                <?= isset($content) ? $content : '' ?>
            </div>
        </div>
    </div>
</body>
</html>