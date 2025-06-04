<?php
/**
 * 网站设置API接口
 * 提供网站基本设置、导航菜单等信息
 */

require_once __DIR__ . '/../config/config.php';

// 处理OPTIONS请求（CORS预检请求）
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// 只允许GET请求
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    sendJsonResponse(['error' => 'Method not allowed'], 405);
}

// 读取设置数据
$settingsData = readJsonFile('settings.json');

// 处理可能的过滤参数
$section = isset($_GET['section']) ? $_GET['section'] : null;

// 如果请求特定部分的设置
if ($section !== null && isset($settingsData[$section])) {
    sendJsonResponse([$section => $settingsData[$section]]);
}
// 否则返回所有设置
else {
    sendJsonResponse($settingsData);
} 