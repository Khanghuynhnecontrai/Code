<?php
session_start();
$data = json_decode(file_get_contents('data.json'), true);

function checkAuth() {
    global $data;
    if (!isset($_SESSION['key']) || !isset($data[$_SESSION['key']])) {
        header("Location: login.php"); exit;
    }
    $key = $_SESSION['key'];
    $device = $_SERVER['HTTP_USER_AGENT'];
    if (empty($data[$key]['device'])) {
        $data[$key]['device'] = $device;
        file_put_contents('data.json', json_encode($data));
    }
    if ($data[$key]['device'] !== $device || date("Y-m-d") > $data[$key]['expire']) {
        session_destroy();
        die("<h1>Key đã hết hạn hoặc thiết bị không hợp lệ!</h1>");
    }
}
?>
