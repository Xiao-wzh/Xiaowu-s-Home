<?php
/**
 * 项目作品集API接口
 * 提供项目作品集信息
 */

require_once __DIR__ . '/../config/cors.php';
require_once __DIR__ . '/../config/config.php';

// 只允许GET请求
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    sendJsonResponse(['error' => 'Method not allowed'], 405);
}

// 读取项目数据
$projectsData = readJsonFile('projects.json');

// 处理可能的过滤参数
$filter = isset($_GET['filter']) ? $_GET['filter'] : null;
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// 如果请求特定ID的项目
if ($id !== null) {
    $found = false;
    
    // 在featured项目中查找
    foreach ($projectsData['featured'] as $project) {
        if ($project['id'] === $id) {
            sendJsonResponse($project);
            $found = true;
            break;
        }
    }
    
    // 在other项目中查找
    if (!$found) {
        foreach ($projectsData['other'] as $project) {
            if ($project['id'] === $id) {
                sendJsonResponse($project);
                $found = true;
                break;
            }
        }
    }
    
    // 如果未找到项目
    if (!$found) {
        sendJsonResponse(['error' => 'Project not found'], 404);
    }
}
// 如果请求特定类型的项目
elseif ($filter === 'featured') {
    sendJsonResponse(['projects' => $projectsData['featured']]);
} 
elseif ($filter === 'other') {
    sendJsonResponse(['projects' => $projectsData['other']]);
}
// 否则返回所有项目
else {
    sendJsonResponse($projectsData);
} 