<?php
session_start();

// Sử dụng đường dẫn tuyệt đối
$json_file = __DIR__ . '/data.json';

// Kiểm tra xem file có thực sự nằm ở đó không
if (!file_exists($json_file)) {
    echo "LỖI: File không tồn tại tại: " . $json_file . "<br>";
    echo "Danh sách file trong thư mục hiện tại (" . __DIR__ . "):<br>";
    $files = scandir(__DIR__);
    echo "<pre>" . print_r($files, true) . "</pre>";
    die();
}

$data = json_decode(file_get_contents($json_file), true);
// ... tiếp tục code cũ của bạn
?>
