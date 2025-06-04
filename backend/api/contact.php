<?php
/**
 * 联系表单API接口
 * 处理联系表单提交
 */

require_once __DIR__ . '/../config/cors.php';
require_once __DIR__ . '/../config/config.php';

// 只允许POST请求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(['error' => 'Method not allowed'], 405);
}

// 获取POST数据
$postData = json_decode(file_get_contents('php://input'), true);

// 验证必填字段
$requiredFields = ['name', 'email', 'message'];
$missingFields = [];

foreach ($requiredFields as $field) {
    if (!isset($postData[$field]) || empty(trim($postData[$field]))) {
        $missingFields[] = $field;
    }
}

if (!empty($missingFields)) {
    sendJsonResponse([
        'success' => false,
        'error' => 'Missing required fields: ' . implode(', ', $missingFields)
    ], 400);
}

// 验证邮箱格式
if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
    sendJsonResponse([
        'success' => false,
        'error' => 'Invalid email format'
    ], 400);
}

// 在实际应用中，这里可以发送邮件或保存到数据库
// 这里我们只是模拟成功响应

// 记录联系请求（仅用于演示）
$logData = [
    'timestamp' => date('Y-m-d H:i:s'),
    'name' => $postData['name'],
    'email' => $postData['email'],
    'subject' => isset($postData['subject']) ? $postData['subject'] : '(No Subject)',
    'message' => $postData['message']
];

// 将日志写入文件（实际应用中可能会存入数据库）
$logFile = DATA_DIR . 'contact_log.json';
$existingLog = [];

if (file_exists($logFile)) {
    $existingLogContent = file_get_contents($logFile);
    $existingLog = json_decode($existingLogContent, true) ?: [];
}

$existingLog[] = $logData;
file_put_contents($logFile, json_encode($existingLog, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// 返回成功响应
sendJsonResponse([
    'success' => true,
    'message' => 'Thank you for your message. We will get back to you soon!'
]); 