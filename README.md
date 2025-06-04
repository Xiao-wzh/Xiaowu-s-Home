# 个人作品集展示网站

## 项目概述
这是一个使用PHP作为后端，Vue.js作为前端的个人作品集展示网站。网站设计为一个现代化的Landing Page，展示个人专业技能和项目作品。

## 功能特点
- 响应式设计，适配各种设备尺寸
- 动态导航菜单（Home, Project, About, Contact）
- 个人简介和技能展示
- 项目作品集展示
- 联系表单功能
- 动态数据渲染，内容可通过后端管理

## 技术栈
- 前端：Vue.js 3、HTML5、CSS3、JavaScript
- 后端：PHP 8.0+
- 数据存储：JSON文件（可扩展为MySQL数据库）

## 项目结构
```
/
├── backend/                # PHP后端
│   ├── api/                # API接口
│   ├── config/             # 配置文件
│   └── data/               # 数据文件
├── frontend/               # Vue前端
│   ├── public/             # 静态资源
│   └── src/                # Vue源代码
└── index.php               # 入口文件
```

## 安装与使用
1. 克隆项目到本地或服务器
2. 确保安装了PHP 8.0+和Node.js环境
3. 前端设置：
   ```
   cd frontend
   npm install
   npm run build
   ```
4. 将构建后的前端文件部署到服务器
5. 配置服务器指向index.php入口文件

## API接口说明
网站提供以下API接口获取动态数据：

1. `/backend/api/profile.php` - 获取个人资料信息
2. `/backend/api/projects.php` - 获取项目作品集信息
3. `/backend/api/contact.php` - 处理联系表单提交

## 如何修改内容
网站内容可通过编辑 `/backend/data/` 目录下的JSON文件进行修改：
- `profile.json` - 修改个人资料、技能和简介
- `projects.json` - 修改项目作品集信息
- `settings.json` - 修改网站基本设置（标题、SEO信息等）

## 开发与调试
- 前端开发模式：`cd frontend && npm run serve`
- API测试：使用Postman或其他API测试工具访问后端接口

## 开发环境设置

### 前端开发

1. 进入前端项目目录：
   ```bash
   cd frontend
   ```

2. 安装依赖：
   ```bash
   npm install
   ```

3. 启动开发服务器：
   ```bash
   npm run serve
   ```

### 后端开发

1. 确保已安装 PHP 7.4 或更高版本
2. 配置 Web 服务器（Apache/Nginx）指向项目根目录

## 构建部署

### 前端构建

1. 进入前端项目目录：
   ```bash
   cd frontend
   ```

2. 安装依赖（如果尚未安装）：
   ```bash
   npm install
   ```

3. 构建生产版本：
   ```bash
   npm run build
   ```

4. 构建完成后，生产文件将位于 `public` 目录中，包括：
   - JavaScript 文件（已压缩）
   - CSS 文件（已压缩）
   - 其他静态资源

### 部署说明

1. 将后端文件部署到 Web 服务器
2. 将前端构建产物（`public` 目录下的文件）部署到 Web 服务器的相应目录
3. 配置 Web 服务器将前端路由请求指向 `index.html`

## 注意事项

- 确保 Node.js 版本 >= 12.0.0
- 确保 PHP 版本 >= 7.4
- 开发时注意保持代码规范，遵循 ESLint 规则
- 生产环境部署前请先执行构建命令 