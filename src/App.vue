

<template>
  <div id="app" :class="{ 'dark-mode': true }">
    <header class="header" :class="{ 'scrolled': isScrolled }">
      <div class="container">
        <nav class="navbar">
          <div class="logo">
            <router-link to="/">🔈</router-link>
          </div>
          <ul class="nav-links">
            <li><router-link to="/">首页</router-link></li>
            <li><router-link to="/projects">项目</router-link></li>
            <li><router-link to="/about">关于</router-link></li>
            <li><router-link to="/contact">联系</router-link></li>
          </ul>
        </nav>
      </div>
    </header>

    <div class="main-content" :class="{ 'dark-mode': isDarkMode }">
      <router-view v-slot="{ Component }">
        <transition name="page" mode="out-in">
          <component :is="Component" :key="$route.path" />
        </transition>
      </router-view>
    </div>

    <div class="coffee-button">
      <button class="btn-coffee" @mouseenter="showCoffeeTooltip = true" @mouseleave="showCoffeeTooltip = false">
        ☕️
      </button>
      <div class="coffee-tooltip" v-show="showCoffeeTooltip">
        {{ profile.coffee_text }}
      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <div class="footer-content">
          <p class="copyright">© {{ new Date().getFullYear() }} 版权所有</p>
          <div class="social-links">
            <a href="#" class="social-link">link</a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue'
import axios from 'axios'
import { API_URLS } from './config/api'
export default {
  name: 'App',
  setup() {
    const showCoffeeTooltip = ref(false)
    const isScrolled = ref(false)
    const profile = ref({
      coffee_text: ''
    })

    // 处理滚动效果
    const handleScroll = () => {
      // 导航栏滚动效果
      isScrolled.value = window.scrollY > 50

      // 页面sections的渐入效果
      const sections = document.querySelectorAll('.section')
      sections.forEach(section => {
        const sectionTop = section.getBoundingClientRect().top
        const windowHeight = window.innerHeight
        if (sectionTop < windowHeight * 0.75) {
          section.classList.add('visible')
        }
      })
    }

    const fetchProfile = async () => {
      try {
        const response = await axios.get(API_URLS.PROFILE)
        if (response.data) {
          profile.value = response.data
        }
      } catch (error) {
        console.error('Error fetching profile:', error)
      }
    }

    onMounted(() => {
      fetchProfile()
      window.addEventListener('scroll', handleScroll)
      handleScroll() // 初始检查
    })

    onUnmounted(() => {
      window.removeEventListener('scroll', handleScroll)
    })

    return {
      showCoffeeTooltip,
      isScrolled,
      profile
    }
  }
}
</script>

<style>
/* Reset and base styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

:root {
  --primary: #64ffda;
  --bg-main: #0a192f;
  --bg-secondary: #112240;
  --text-primary: #e6f1ff;
  --text-secondary: #8892b0;
  --transition: all 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
}

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  font-size: 16px;
  line-height: 1.6;
  color: var(--text-secondary);
  background-color: var(--bg-main);
}

/* Scroll behavior */
html {
  scroll-behavior: smooth;
}

/* Scrollbar styling */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: var(--bg-main);
}

::-webkit-scrollbar-thumb {
  background: var(--bg-secondary);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: var(--primary);
}

a {
  text-decoration: none;
  color: var(--primary);
  transition: var(--transition);
}

a:hover {
  color: var(--primary);
  opacity: 0.8;
}

ul {
  list-style: none;
}

.container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}

.section {
  padding: 6rem 0;
  opacity: 0;
  transform: translateY(20px);
  transition: var(--transition);
}

.section.visible {
  opacity: 1;
  transform: translateY(0);
}

.section-title {
  font-size: 2.5rem;
  margin-bottom: 1.5rem;
  color: var(--text-primary);
}

/* Grid system */
.grid {
  display: grid;
  gap: 2rem;
}

.grid-3 {
  grid-template-columns: repeat(3, 1fr);
}

/* Button styles */
.btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  border-radius: 4px;
  font-weight: 500;
  transition: var(--transition);
  cursor: pointer;
  border: none;
}

.btn-primary {
  background-color: var(--primary);
  color: var(--bg-main);
}

.btn-outline {
  background-color: transparent;
  border: 1px solid var(--primary);
  color: var(--primary);
}

/* Navigation styles */
.header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  padding: 1.5rem 0;
  background-color: rgba(10, 25, 47, 0.85);
  backdrop-filter: blur(10px);
  z-index: 100;
  transition: var(--transition);
}

.header.scrolled {
  padding: 1rem 0;
  box-shadow: 0 10px 30px -10px rgba(2, 12, 27, 0.7);
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo a {
  font-size: 2rem;
  font-weight: 700;
  color: var(--primary);
}

.nav-links {
  display: flex;
  gap: 2rem;
}

.nav-links a {
  color: var(--text-primary);
  font-weight: 500;
  position: relative;
}

.nav-links a:hover {
  color: var(--primary);
}

.nav-links a::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 0;
  height: 2px;
  background-color: var(--primary);
  transition: var(--transition);
}

.nav-links a:hover::after,
.nav-links .router-link-active::after {
  width: 100%;
}

/* Main content styles */
.main-content {
  min-height: 100vh;
  padding-top: 5rem;
}

/* Page transitions */
.page-enter-active,
.page-leave-active {
  transition: opacity 0.5s, transform 0.5s;
}

.page-enter-from,
.page-leave-to {
  opacity: 0;
  transform: translateY(20px);
}

/* Footer styles */
.footer {
  background-color: var(--bg-secondary);
  padding: 2rem 0;
}

.footer-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
}

.copyright {
  color: var(--text-secondary);
}

.social-links {
  display: flex;
  gap: 1rem;
}

.social-link {
  font-size: 1.5rem;
  color: var(--text-secondary);
  transition: var(--transition);
}

.social-link:hover {
  color: var(--primary);
  transform: translateY(-3px);
}

/* Coffee button */
.coffee-button {
  position: fixed;
  right: 2rem;
  bottom: 2rem;
  z-index: 99;
}

.btn-coffee {
  width: 4rem;
  height: 4rem;
  border-radius: 50%;
  background-color: var(--primary);
  border: none;
  font-size: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: var(--transition);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.btn-coffee:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.coffee-tooltip {
  position: absolute;
  bottom: 100%;
  right: 0;
  width: 200px;
  padding: 1rem;
  background-color: var(--bg-secondary);
  border-radius: 4px;
  margin-bottom: 1rem;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  color: var(--text-primary);
}

.coffee-tooltip::after {
  content: '';
  position: absolute;
  bottom: -10px;
  right: 20px;
  border-width: 10px 10px 0;
  border-style: solid;
  border-color: var(--bg-secondary) transparent transparent;
}

/* Responsive styles */
@media (max-width: 768px) {
  .container {
    padding: 0 1rem;
  }

  .grid-3 {
    grid-template-columns: 1fr;
  }

  .navbar {
    flex-direction: column;
    gap: 1rem;
  }

  .nav-links {
    width: 100%;
    justify-content: center;
    gap: 1rem;
  }

  .section {
    padding: 4rem 0;
  }

  .section-title {
    font-size: 2rem;
  }

  .footer-content {
    flex-direction: column;
    gap: 1rem;
    text-align: center;
  }
}
</style>
