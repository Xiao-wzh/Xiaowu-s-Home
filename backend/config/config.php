<?php
/**
 * 网站配置文件
 */

// 设置时区
date_default_timezone_set('Asia/Shanghai');

// 定义数据目录路径
define('DATA_DIR', __DIR__ . '/../data/');

// 允许跨域请求（开发环境使用）
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=UTF-8');

// 错误处理
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * 读取JSON数据文件
 * 
 * @param string $filename 文件名
 * @return array 解析后的JSON数据
 */
function readJsonFile($filename) {
    $filePath = DATA_DIR . $filename;
    
    if (!file_exists($filePath)) {
        return ['error' => 'File not found: ' . $filename];
    }
    
    $jsonContent = file_get_contents($filePath);
    $data = json_decode($jsonContent, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['error' => 'JSON parse error: ' . json_last_error_msg()];
    }
    
    return $data;
}

/**
 * 发送JSON响应
 * 
 * @param mixed $data 要发送的数据
 * @param int $statusCode HTTP状态码
 */
function sendJsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
} 