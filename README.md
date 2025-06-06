# 个人作品集网站

这是一个使用Vue.js构建的现代化个人作品集网站。网站采用响应式设计，支持多种设备访问，并具有优雅的动画效果和用户友好的界面。

## 功能特点

- 响应式设计，适配各种屏幕尺寸
- 现代化的UI设计和流畅的动画效果
- 深色主题支持
- 优化的性能和加载速度
- SEO友好的结构

## 项目结构

```
project/
├── src/
│   ├── assets/
│   │   ├── css/
│   │   │   └── main.css      # 全局样式文件
│   │   └── images/           # 图片资源
│   ├── components/           # Vue组件
│   │   ├── Header.vue       # 导航头部
│   │   ├── Footer.vue       # 页面底部
│   │   └── ...
│   ├── views/               # 页面视图
│   │   ├── Home.vue        # 首页
│   │   ├── About.vue       # 关于页面
│   │   ├── Projects.vue    # 项目展示
│   │   └── Contact.vue     # 联系页面
│   ├── App.vue             # 根组件
│   └── main.js             # 应用入口
├── index.html              # HTML入口文件
└── README.md              # 项目文档
```

## 技术栈

- Vue.js 3 - 渐进式JavaScript框架
- Vue Router - 官方路由管理器
- CSS变量 - 主题定制
- Google Fonts (Inter) - 字体
- 响应式设计 - 移动优先

## 开发指南

### 环境要求

- Node.js >= 14.0.0
- npm >= 6.0.0

### 安装依赖

```bash
npm install
```

### 开发服务器

```bash
npm run dev
```

### 构建生产版本

```bash
npm run build
```

## 自定义主题

网站使用CSS变量进行主题定制，主要变量定义在 `src/assets/css/main.css` 文件中：

```css
:root {
  --primary: #64ffda;        # 主要强调色
  --bg-main: #0a192f;       # 主背景色
  --bg-secondary: #112240;   # 次要背景色
  --text-primary: #e6f1ff;   # 主要文本色
  --text-secondary: #8892b0; # 次要文本色
}
```

## 页面说明

### 首页 (Home.vue)
- 个人简介展示
- 技能概览
- 最新项目预览

### 关于 (About.vue)
- 详细个人介绍
- 专业技能列表
- 工作经历时间线

### 项目 (Projects.vue)
- 项目展示网格
- 项目详细信息
- 技术栈标签

### 联系 (Contact.vue)
- 联系表单
- 社交媒体链接
- 联系信息

## 性能优化

- 使用 `preconnect` 预加载Google Fonts
- 图片懒加载
- CSS和JavaScript的代码分割
- 响应式图片加载

## 浏览器支持

- Chrome (最新版本)
- Firefox (最新版本)
- Safari (最新版本)
- Edge (最新版本)

## 贡献指南

1. Fork 项目
2. 创建特性分支 (`git checkout -b feature/AmazingFeature`)
3. 提交更改 (`git commit -m 'Add some AmazingFeature'`)
4. 推送到分支 (`git push origin feature/AmazingFeature`)
5. 开启Pull Request

## 许可证

MIT License - 详见 LICENSE 文件

## 联系方式

如有任何问题或建议，请通过以下方式联系：

- 电子邮件：[your.email@example.com]
- GitHub：[Your GitHub Profile]
- LinkedIn：[Your LinkedIn Profile]

---

© 2024 Your Name. All rights reserved. 
