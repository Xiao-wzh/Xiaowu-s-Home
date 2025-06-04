<?php
/**
 * 入口文件
 * 处理所有前端路由请求，将它们重定向到Vue应用
 */

// 如果请求的是API路径，则转发到对应的API处理器
if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
    $apiPath = __DIR__ . '/backend' . $_SERVER['REQUEST_URI'];
    if (file_exists($apiPath)) {
        require_once $apiPath;
        exit;
    }
}

// 否则返回Vue应用的index.html
$indexFile = __DIR__ . '/public/index.html';
if (file_exists($indexFile)) {
    readfile($indexFile);
} else {
    header('HTTP/1.1 404 Not Found');
    echo 'Frontend application not built. Please run `npm run build` in the frontend directory.';
} 