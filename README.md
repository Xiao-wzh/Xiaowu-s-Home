# 个人作品集展示网站

![微信图片_20250605140423_72](https://github.com/user-attachments/assets/724c0a71-41b4-4d54-8f1f-93bbffde80bd)
![微信图片_20250605140423_74](https://github.com/user-attachments/assets/7cbb8082-448c-40c6-b207-6641738a926f)
![微信图片_20250605140423_76](https://github.com/user-attachments/assets/0d4097c1-359e-410a-a745-aadc8782618e)
![微信图片_20250605140423_78](https://github.com/user-attachments/assets/ecff9824-c6e9-4878-ac94-b1627e8dd6b2)


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

# 个人作品集后端项目

这是一个基于Spring Boot和MyBatis的个人作品集后端项目。

## 技术栈

- Spring Boot 3.3.2
- MyBatis/MyBatis-Plus
- MySQL 8.0
- JDK 17

## 项目结构

```
src/main/java/com/portfolio/
├── controller/        # REST API控制器
├── service/           # 业务逻辑服务
│   └── impl/          # 服务实现类
├── mapper/            # 数据访问接口
├── entity/            # 实体类
├── config/            # 配置类
└── PortfolioApplication.java  # 应用程序入口
```

## 功能模块

### 个人简介 (Profile)

- 获取个人简介信息
- 更新个人简介信息

### 项目作品 (Project)

- 获取所有项目作品
- 获取单个项目详情
- 添加新项目
- 更新项目信息
- 删除项目

### 设置 (Settings)

- 获取网站设置
- 更新网站设置

## 数据库设计

### profile表

| 字段名       | 类型         | 描述         |
|-------------|--------------|-------------|
| id          | bigint       | 主键ID       |
| name        | varchar(100) | 姓名         |
| title       | varchar(100) | 职位标题      |
| subtitle    | varchar(200) | 副标题        |
| availability| varchar(50)  | 可用性状态     |
| coffee_text | varchar(200) | 咖啡约见文本   |
| skills      | text         | 技能列表      |
| qualities   | text         | 个人品质      |
| contact     | text         | 联系信息      |
| social      | text         | 社交媒体链接   |

### project表

| 字段名         | 类型         | 描述         |
|---------------|--------------|-------------|
| id            | bigint       | 主键ID       |
| title         | varchar(100) | 项目标题      |
| description   | text         | 项目描述      |
| technologies  | varchar(255) | 使用的技术    |
| thumbnail_url | varchar(255) | 缩略图URL     |
| demo_url      | varchar(255) | 演示URL      |
| code_url      | varchar(255) | 代码仓库URL   |

### settings表

| 字段名       | 类型         | 描述         |
|-------------|--------------|-------------|
| id          | bigint       | 主键ID       |
| theme       | varchar(50)  | 主题         |
| language    | varchar(20)  | 语言         |
| dark_mode   | tinyint(1)   | 暗黑模式      |
| font_family | varchar(100) | 字体         |
| font_size   | int          | 字体大小      |

## 如何运行

### 环境要求

- JDK 17或更高版本
- Maven 3.6或更高版本
- MySQL 8.0或更高版本

### 步骤

1. 克隆项目到本地

```bash
git clone https://github.com/yourusername/portfolio-backend.git
cd portfolio-backend
```

2. 配置数据库

创建MySQL数据库并修改`application.yml`中的数据库连接信息。

3. 构建项目

```bash
mvn clean package
```

4. 运行项目

```bash
java -jar target/portfolio-backend-1.0.0.jar
```

5. 访问API

```
http://localhost:8080/api/profile/1
```

## API文档

### 个人简介API

#### 获取个人简介

- **URL**: `/api/profile/{id}`
- **方法**: GET
- **路径参数**: 
  - `id`: 简介ID
- **响应**: Profile对象

#### 更新个人简介

- **URL**: `/api/profile`
- **方法**: POST
- **请求体**: Profile对象
- **响应**: 无

### 项目作品API

#### 获取所有项目

- **URL**: `/api/projects`
- **方法**: GET
- **响应**: Project对象数组

#### 获取项目详情

- **URL**: `/api/projects/{id}`
- **方法**: GET
- **路径参数**: 
  - `id`: 项目ID
- **响应**: Project对象

### 设置API

#### 获取设置

- **URL**: `/api/settings/{id}`
- **方法**: GET
- **路径参数**: 
  - `id`: 设置ID
- **响应**: Settings对象

#### 更新设置

- **URL**: `/api/settings`
- **方法**: POST
- **请求体**: Settings对象
- **响应**: 无 
