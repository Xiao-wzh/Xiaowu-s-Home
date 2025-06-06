-- 创建数据库
CREATE DATABASE IF NOT EXISTS portfolio DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE portfolio;

-- 创建个人简介表
CREATE TABLE IF NOT EXISTS profile (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL COMMENT '姓名',
    title VARCHAR(100) COMMENT '职位标题',
    subtitle VARCHAR(200) COMMENT '副标题',
    availability VARCHAR(50) COMMENT '可用性状态',
    coffee_text VARCHAR(200) COMMENT '咖啡约见文本',
    skills TEXT COMMENT '技能列表',
    qualities TEXT COMMENT '个人品质',
    contact TEXT COMMENT '联系信息',
    social TEXT COMMENT '社交媒体链接',
    created_time DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    updated_time DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='个人简介表';

-- 创建项目作品表
CREATE TABLE IF NOT EXISTS project (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL COMMENT '项目标题',
    description TEXT COMMENT '项目描述',
    technologies VARCHAR(255) COMMENT '使用的技术',
    thumbnail_url VARCHAR(255) COMMENT '缩略图URL',
    demo_url VARCHAR(255) COMMENT '演示URL',
    code_url VARCHAR(255) COMMENT '代码仓库URL',
    created_time DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    updated_time DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='项目作品表';

-- 创建设置表
CREATE TABLE IF NOT EXISTS settings (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    theme VARCHAR(50) COMMENT '主题',
    language VARCHAR(20) COMMENT '语言',
    dark_mode TINYINT(1) DEFAULT 0 COMMENT '暗黑模式',
    font_family VARCHAR(100) COMMENT '字体',
    font_size INT COMMENT '字体大小',
    created_time DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    updated_time DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='设置表';

-- 插入初始数据
INSERT INTO profile (name, title, subtitle, availability, coffee_text, skills, qualities, contact, social)
VALUES ('张三', '全栈开发工程师', '热爱编程和创新的开发者', '可接受远程工作', '随时欢迎约我喝咖啡聊技术', 
        'Java, Spring Boot, React, MySQL, Docker', '创新, 责任心, 团队合作', 
        '{"email": "zhangsan@example.com", "phone": "123456789"}',
        '{"github": "https://github.com/zhangsan", "linkedin": "https://linkedin.com/in/zhangsan"}');

INSERT INTO project (title, description, technologies, thumbnail_url, demo_url, code_url)
VALUES ('个人作品集网站', '使用Spring Boot和React开发的个人作品展示网站', 'Spring Boot, React, MySQL, Docker', 
        '/images/portfolio.jpg', 'https://demo.example.com', 'https://github.com/zhangsan/portfolio');

INSERT INTO settings (theme, language, dark_mode, font_family, font_size)
VALUES ('default', 'zh-CN', 0, 'Arial', 16); 