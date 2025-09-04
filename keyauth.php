<?php
// auth.php - 软件授权认证文件
header('Content-Type: application/json'); // 返回 JSON


$licenses = [
    'sultrycare.com' => '2025-10-31', 
    'www.sultrycare.com' => '2025-10-30',
];


$key = isset($_GET['key']) ? $_GET['key'] : '';

if (empty($key) || !array_key_exists($key, $licenses)) {
    echo json_encode(['status' => 'invalid', 'message' => 'Invalid license key']);
    exit;
}


$expiration_date = strtotime($licenses[$key]);
$current_date = time();

if ($current_date > $expiration_date) {
    echo json_encode(['status' => 'expired', 'message' => 'License has expired']);
} else {
    echo json_encode(['status' => 'valid', 'message' => 'License is active', 'expiration' => $licenses[$key]]);
}
?>
