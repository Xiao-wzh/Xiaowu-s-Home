<?php
/**
 * API入口文件
 * 处理所有API请求的路由
 */

// 设置错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 设置内容类型为JSON
header('Content-Type: application/json; charset=UTF-8');

// 允许跨域请求（开发环境使用）
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 如果是OPTIONS请求，直接返回200
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 包含配置文件
require_once __DIR__ . '/config/config.php';

// 获取请求的路径
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

// 移除开头的斜杠
$path = ltrim($path, '/');

// 输出调试信息
error_log("Request URI: " . $request_uri);
error_log("Parsed Path: " . $path);

// API路由映射
$routes = [
    'api/profile' => 'profile.json',
    'api/projects' => 'projects.json',
    'api/contact' => 'contact.php',
    'api/settings' => 'settings.json'
];

// 检查是否匹配任何路由
if (isset($routes[$path])) {
    $endpoint = $routes[$path];
    error_log("Matched endpoint: " . $endpoint);
    
    // 如果是.json文件，直接读取并返回
    if (substr($endpoint, -5) === '.json') {
        $jsonPath = __DIR__ . '/data/' . $endpoint;
        error_log("Loading JSON file: " . $jsonPath);
        
        if (file_exists($jsonPath)) {
            $jsonContent = file_get_contents($jsonPath);
            echo $jsonContent;
            exit;
        } else {
            error_log("JSON file not found: " . $jsonPath);
            http_response_code(404);
            echo json_encode(['error' => 'File not found: ' . $endpoint]);
            exit;
        }
    }
    // 如果是.php文件，包含并执行
    else if (substr($endpoint, -4) === '.php') {
        $phpPath = __DIR__ . '/api/' . $endpoint;
        error_log("Including PHP file: " . $phpPath);
        
        if (file_exists($phpPath)) {
            require_once $phpPath;
            exit;
        } else {
            error_log("PHP file not found: " . $phpPath);
            http_response_code(404);
            echo json_encode(['error' => 'File not found: ' . $endpoint]);
            exit;
        }
    }
} else {
    // 返回404错误
    error_log("No route match for path: " . $path);
    http_response_code(404);
    echo json_encode([
        'error' => 'API endpoint not found',
        'requested_path' => $path,
        'available_routes' => array_keys($routes)
    ]);
    exit;
} 