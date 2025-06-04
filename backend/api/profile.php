<?php
/**
 * 个人资料API接口
 * 提供个人信息、技能和社交媒体链接
 */

require_once __DIR__ . '/../config/cors.php';
require_once __DIR__ . '/../config/config.php';

// 只允许GET请求
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    sendJsonResponse(['error' => 'Method not allowed'], 405);
}

// 读取个人资料数据
$profileData = readJsonFile('profile.json');

// 发送响应
sendJsonResponse($profileData); 