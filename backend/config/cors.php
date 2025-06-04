<?php
// 允许来自开发服务器和生产环境的请求
header("Access-Control-Allow-Origin: *");
// 允许的请求方法
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// 允许的请求头
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// 允许发送凭证（如cookies）
header("Access-Control-Allow-Credentials: true");

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// 设置响应类型为JSON
header('Content-Type: application/json'); 