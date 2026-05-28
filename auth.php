<?php
// Bật hiển thị lỗi trên màn hình
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$json_file = __DIR__ . '/data.json';

if (!file_exists($json_file)) {
    die("LỖI NẶNG: Không thấy file data.json. Đường dẫn đang tìm là: " . $json_file);
}

$data = json_decode(file_get_contents($json_file), true);

if ($data === null) {
    die("LỖI JSON: File data.json tồn tại nhưng nội dung bị sai định dạng!");
}

function checkAuth() {
    global $data;
    $current_page = basename($_SERVER['PHP_SELF']);
    
    if ($current_page !== 'login.php' && (!isset($_SESSION['key']) || !isset($data[$_SESSION['key']]))) {
        header("Location: login.php"); 
        exit;
    }
}
?>
