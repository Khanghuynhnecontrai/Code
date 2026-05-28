<?php
session_start();

// SỬA Ở ĐÂY: Dùng đường dẫn tuyệt đối __DIR__
$json_file = __DIR__ . '/data.json';

// Kiểm tra file có tồn tại không
if (!file_exists($json_file)) {
    die("LỖI: Không tìm thấy file data.json tại: " . $json_file);
}

$json_content = file_get_contents($json_file);
$data = json_decode($json_content, true);

// Kiểm tra JSON có hợp lệ không
if ($data === null) {
    die("LỖI: File data.json không phải định dạng JSON hợp lệ!");
}

function checkAuth() {
    global $data;
    $current_page = basename($_SERVER['PHP_SELF']);
    
    if ($current_page !== 'login.php' && (!isset($_SESSION['key']) || !isset($data[$_SESSION['key']]))) {
        header("Location: login.php"); 
        exit;
    }
    
    if (!isset($_SESSION['key'])) return;

    $key = $_SESSION['key'];
    // ... phần còn lại của bạn ...
}
