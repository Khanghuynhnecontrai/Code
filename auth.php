<?php
session_start();
$data = json_decode(file_get_contents('data.json'), true);
// Tạm thời chèn dòng này để kiểm tra
if ($data === null) {
function checkAuth() {
    global $data;
    
    // THÊM DÒNG NÀY: Kiểm tra xem có đang ở trang login.php không
    $current_page = basename($_SERVER['PHP_SELF']);
    
    // CHỈ chuyển hướng nếu:
    // 1. Không phải trang login.php
    // 2. VÀ chưa đăng nhập
    if ($current_page !== 'login.php' && (!isset($_SESSION['key']) || !isset($data[$_SESSION['key']]))) {
        header("Location: login.php"); 
        exit;
    }
    
    // Các dòng code còn lại giữ nguyên...
    if (!isset($_SESSION['key'])) return; // Thêm dòng này để tránh lỗi nếu chưa đăng nhập mà gọi hàm bên dưới

    $key = $_SESSION['key'];
    // ... code tiếp theo ...
}
