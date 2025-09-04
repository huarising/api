<?php
// auth.php - 软件授权认证文件
header('Content-Type: application/json'); // 返回 JSON

// 授权数据数组（key: 软件标识, value: 到期时间 'YYYY-MM-DD'）
// 示例：可以根据需要添加更多条目，并在 GitHub 上更新后推送
$licenses = [
    'sultrycare.com' => '2025-10-31', // 示例 WordPress 站点域名作为 key
    'www.sultrycare.com' => '2025-10-30',
];

// 获取传入的 key 参数（例如域名或 license key）
$key = isset($_GET['key']) ? $_GET['key'] : '';

if (empty($key) || !array_key_exists($key, $licenses)) {
    echo json_encode(['status' => 'invalid', 'message' => 'Invalid license key']);
    exit;
}

// 检查到期时间
$expiration_date = strtotime($licenses[$key]);
$current_date = time();

if ($current_date > $expiration_date) {
    echo json_encode(['status' => 'expired', 'message' => 'License has expired']);
} else {
    echo json_encode(['status' => 'valid', 'message' => 'License is active', 'expiration' => $licenses[$key]]);
}
?>
