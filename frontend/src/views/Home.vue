<template>
  <div class="home" :class="{ 'is-loaded': isLoaded }">
    <div v-if="!isLoaded" class="loading-screen">
      <div class="loader"></div>
    </div>

    <section class="hero section fade-in-up">
      <div class="container">
        <div class="hero-content">
          <div class="availability slide-in-left">{{ profile.availability }}</div>
          <h1 class="hero-title slide-in-left">{{ profile.title }}</h1>
          <p class="hero-subtitle slide-in-left">{{ profile.subtitle }}</p>
          <div class="hero-buttons slide-in-left">
            <a href="#projects" class="btn btn-primary">查看作品 <span class="wave">👋🏻</span></a>
            <router-link to="/contact" class="btn btn-outline">联系我</router-link>
          </div>
        </div>
        <div class="hero-image slide-in-right">
          <img src="https://peter-home.vercel.app/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fmemoji-computer.0c295dc9.png&w=640&q=75" alt="Person peeking from behind laptop" class="person-img" />
        </div>
      </div>
    </section>

    <section class="skills section fade-in-up">
      <div class="container">
        <h2 class="section-title">技能特长</h2>
        <div class="skills-track">
          <div class="skills-track-inner">
            <div v-for="(skill, index) in profile.qualities" :key="index" class="skill-item">
              {{ skill }}
            </div>
            <!-- 重复一遍以实现无缝滚动 -->
            <div v-for="(skill, index) in profile.qualities" :key="'dup-'+index" class="skill-item">
              {{ skill }}
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="projects" class="section projects fade-in-up">
      <div class="container">
        <h2 class="section-title">精选项目</h2>
        <h3 class="section-subtitle">实际项目成果</h3>
        <p class="section-description">看看我是如何将概念转化为引人入胜的数字体验。</p>
        
        <div class="grid grid-3">
          <div v-for="project in featuredProjects"
               :key="project.id"
               class="card project-card">
            <div class="project-year">{{ project.company || 'Personal' }}•{{ new Date().getFullYear() }}</div>
            <h3 class="project-title">{{ project.title }}</h3>
            <div class="project-divider"></div>
            <p class="project-description">{{ project.description }}</p>
            <div class="project-tags">
              <span v-for="tag in project.tags"
                    :key="tag"
                    class="tag">
                {{ tag }}
              </span>
            </div>
            <div class="project-links">
              <a :href="project.github" class="project-link" target="_blank">
                <i class="icon-github"></i>
              </a>
              <a :href="project.link" class="project-link" target="_blank">
                <i class="icon-external-link"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="testimonials section fade-in-up">
      <div class="container">
        <h2 class="section-title">客户评价</h2>
        <h3 class="section-subtitle">他们如何评价我的工作</h3>
        <p class="section-description">不要只相信我的话，看看我的客户是如何评价我的工作的。</p>
        
        <div class="testimonials-track">
          <div class="testimonials-track-inner">
            <div v-for="testimonial in profile.testimonials" :key="testimonial.id" class="testimonial-card">
              <div class="testimonial-content">
                <p class="testimonial-text">{{ testimonial.content }}</p>
              </div>
              <div class="testimonial-author">
                <div class="author-name">{{ testimonial.name }}</div>
                <div class="author-title">{{ testimonial.title }}</div>
              </div>
            </div>
            <!-- 重复一遍以实现无缝滚动 -->
            <div v-for="testimonial in profile.testimonials" :key="'dup-'+testimonial.id" class="testimonial-card">
              <div class="testimonial-content">
                <p class="testimonial-text">{{ testimonial.content }}</p>
              </div>
              <div class="testimonial-author">
                <div class="author-name">{{ testimonial.name }}</div>
                <div class="author-title">{{ testimonial.title }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { API_URLS } from '../config/api'

export default {
  name: 'HomePage',
  setup() {
    const profile = ref({
      title: '',
      subtitle: '',
      skills: [],
      qualities: [],
      testimonials: []
    })
    const featuredProjects = ref([])
    const isLoaded = ref(false)

    const getSkillIcon = (skill) => {
      const icons = {
        'JavaScript': 'fab fa-js',
        'HTML5': 'fab fa-html5',
        'CSS3': 'fab fa-css3-alt',
        'React': 'fab fa-react',
        'Vue.js': 'fab fa-vuejs',
        'GitHub': 'fab fa-github',
        'Java': 'fab fa-java',
        // 添加更多图标映射
      }
      return icons[skill] || 'fas fa-code'
    }

    const fetchData = async () => {
      try {
        const [profileRes, projectsRes] = await Promise.all([
          axios.get(API_URLS.PROFILE),
          axios.get(API_URLS.PROJECTS)
        ])
        
        if (profileRes.data) {
          profile.value = profileRes.data
        }
        
        if (projectsRes.data && projectsRes.data.featured) {
          featuredProjects.value = projectsRes.data.featured
        }

        // 添加一个小延迟以确保动画流畅
        setTimeout(() => {
          isLoaded.value = true
        }, 500)
      } catch (error) {
        console.error('Error fetching data:', error)
        isLoaded.value = true // 即使出错也要设置加载完成
      }
    }

    onMounted(() => {
      fetchData()
    })

    return {
      profile,
      featuredProjects,
      getSkillIcon,
      isLoaded
    }
  }
}
</script>

<style scoped>
.loading-screen {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: var(--bg-primary);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.loader {
  width: 50px;
  height: 50px;
  border: 3px solid var(--bg-secondary);
  border-radius: 50%;
  border-top-color: var(--primary);
  animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.home {
  opacity: 0;
  transition: opacity 0.5s ease;
}

.home.is-loaded {
  opacity: 1;
}

.slide-in-left {
  opacity: 0;
  transform: translateX(-20px);
  animation: slideInLeft 0.5s ease forwards;
}

.slide-in-right {
  opacity: 0;
  transform: translateX(20px);
  animation: slideInRight 0.5s ease forwards;
}

.fade-in-up {
  opacity: 0;
  transform: translateY(20px);
  animation: fadeInUp 0.5s ease forwards;
}

@keyframes slideInLeft {
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes slideInRight {
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes fadeInUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.hero-content > * {
  animation-delay: calc(var(--index, 0) * 0.1s + 0.5s);
}

.availability { --index: 1; }
.hero-title { --index: 2; }
.hero-subtitle { --index: 3; }
.hero-buttons { --index: 4; }

.hero {
  min-height: 100vh;
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
  padding: 100px 0;
}

.hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 50% 50%, rgba(100, 255, 218, 0.1), transparent 50%);
  pointer-events: none;
}

.hero .container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 4rem;
}

.hero-content {
  flex: 1;
  max-width: 600px;
  z-index: 1;
}

.availability {
  display: inline-block;
  padding: 0.5rem 1.5rem;
  background: rgba(100, 255, 218, 0.1);
  border: 1px solid var(--primary);
  border-radius: 4px;
  color: var(--primary);
  font-size: 0.9rem;
  margin-bottom: 2rem;
  position: relative;
  overflow: hidden;
}

.hero-title {
  font-size: 4.5rem;
  line-height: 1.1;
  margin-bottom: 1.5rem;
  background: linear-gradient(120deg, var(--primary), #fff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  position: relative;
}

.hero-subtitle {
  font-size: 1.25rem;
  line-height: 1.8;
  color: var(--text-secondary);
  margin-bottom: 2.5rem;
  max-width: 540px;
}

.hero-buttons {
  display: flex;
  gap: 1.5rem;
}

.hero-buttons .btn {
  padding: 1rem 2rem;
  font-size: 1.1rem;
  font-weight: 500;
  letter-spacing: 0.5px;
  position: relative;
  overflow: hidden;
}

.hero-buttons .btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.1);
  transform: translateX(-100%);
  transition: transform 0.3s ease;
}

.hero-buttons .btn:hover::before {
  transform: translateX(0);
}

.wave {
  display: inline-block;
  animation: wave 2s infinite;
  transform-origin: 70% 70%;
}

@keyframes wave {
  0% { transform: rotate(0deg); }
  10% { transform: rotate(14deg); }
  20% { transform: rotate(-8deg); }
  30% { transform: rotate(14deg); }
  40% { transform: rotate(-4deg); }
  50% { transform: rotate(10deg); }
  60% { transform: rotate(0deg); }
  100% { transform: rotate(0deg); }
}

.hero-image {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
}

.person-img {
  max-width: 100%;
  height: auto;
  filter: drop-shadow(0 0 20px rgba(100, 255, 218, 0.2));
  animation: float 6s ease-in-out infinite;
}

@keyframes float {
  0% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-20px);
  }
  100% {
    transform: translateY(0px);
  }
}

.skill-item {
  position: relative;
  transition: transform 0.3s ease;
}

.skill-item:hover {
  transform: translateY(-2px);
}

.testimonial-card {
  position: relative;
  overflow: hidden;
}

.testimonial-card::before {
  content: '"';
  position: absolute;
  top: 20px;
  left: 20px;
  font-size: 4rem;
  color: var(--primary);
  opacity: 0.1;
  font-family: serif;
}

.section-subtitle {
  font-size: 1.75rem;
  margin-bottom: 1rem;
  color: #64ffda;
}

.section-description {
  font-size: 1.1rem;
  color: #8892b0;
  margin-bottom: 3rem;
  max-width: 600px;
}

.projects {
  background-color: #0a192f;
}

.project-card {
  overflow: hidden;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.project-year {
  font-size: 0.9rem;
  color: #64ffda;
  margin-bottom: 1rem;
}

.project-divider {
  height: 1px;
  background-color: #233554;
  margin: 1rem 0;
}

.project-title {
  font-size: 1.5rem;
  margin-bottom: 1rem;
  color: #e6f1ff;
}

.project-description {
  color: #8892b0;
  margin-bottom: 1.5rem;
  flex-grow: 1;
}

.project-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-bottom: 1.5rem;
}

.tag {
  padding: 0.25rem 0.75rem;
  background-color: #233554;
  color: #64ffda;
  border-radius: 20px;
  font-size: 0.875rem;
}

.project-links {
  display: flex;
  gap: 1rem;
}

.project-link {
  color: #8892b0;
  font-size: 1.25rem;
  transition: color 0.3s ease;
}

.project-link:hover {
  color: #64ffda;
}

.skills {
  overflow: hidden;
  background-color: var(--bg-secondary);
  padding: 2rem 0;
}

.skills-track {
  width: 100%;
  overflow: hidden;
}

.skills-track-inner {
  display: flex;
  animation: scroll 30s linear infinite;
  width: fit-content;
}

.skill-item {
  white-space: nowrap;
  padding: 0 2rem;
  color: var(--text-primary);
  font-size: 1.5rem;
  display: flex;
  align-items: center;
}

.skill-item::after {
  content: '';
  display: inline-block;
  width: 0.5rem;
  height: 0.5rem;
  background-color: var(--primary);
  border-radius: 50%;
  margin-left: 2rem;
}

@keyframes scroll {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}

.testimonials {
  background-color: #0a192f;
}

.testimonial-card {
  background-color: #112240;
  border-radius: 4px;
  padding: 2rem;
  max-width: 800px;
  margin: 0 auto;
}

.testimonial-text {
  font-size: 1.2rem;
  color: #8892b0;
  margin-bottom: 2rem;
  font-style: italic;
}

.testimonial-author {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.author-name {
  font-size: 1.1rem;
  color: #e6f1ff;
  font-weight: 600;
}

.author-title {
  font-size: 0.9rem;
  color: #64ffda;
}

.cta {
  background-color: #112240;
  text-align: center;
}

.cta-title {
  font-size: 2.5rem;
  margin-bottom: 1.5rem;
  color: #e6f1ff;
}

.cta-description {
  font-size: 1.2rem;
  color: #8892b0;
  margin-bottom: 2rem;
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
}

.testimonials-track {
  width: 100%;
  overflow: hidden;
  padding: 2rem 0;
}

.testimonials-track-inner {
  display: flex;
  animation: testimonialScroll 40s linear infinite;
  width: fit-content;
  gap: 2rem;
}

.testimonial-card {
  flex: 0 0 400px;
  background-color: var(--bg-secondary);
  border-radius: 8px;
  padding: 2rem;
  box-shadow: 0 10px 30px -15px rgba(2, 12, 27, 0.7);
  border: 2px solid var(--bg-secondary);
  transition: var(--transition);
}

.testimonial-card:hover {
  transform: translateY(-5px);
  border-color: var(--primary);
}

.testimonial-text {
  font-size: 1.2rem;
  line-height: 1.8;
  color: var(--text-primary);
}

.testimonial-author {
  display: flex;
  flex-direction: column;
}

.author-name {
  font-size: 1.1rem;
  font-weight: 600;
  color: var(--primary);
  margin-bottom: 0.25rem;
}

.author-title {
  font-size: 0.9rem;
  color: var(--text-secondary);
}

@keyframes testimonialScroll {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}

@media (max-width: 1200px) {
  .hero-title {
    font-size: 4rem;
  }
}

@media (max-width: 992px) {
  .hero .container {
    flex-direction: column;
    text-align: center;
    gap: 3rem;
  }

  .hero-content {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .hero-subtitle {
    margin-left: auto;
    margin-right: auto;
  }

  .hero-title {
    font-size: 3.5rem;
  }

  .testimonial-card {
    flex: 0 0 300px;
  }
}

@media (max-width: 768px) {
  .hero {
    padding: 80px 0;
  }

  .hero-title {
    font-size: 2.8rem;
  }

  .hero-subtitle {
    font-size: 1.1rem;
  }

  .hero-buttons {
    flex-direction: column;
    width: 100%;
    max-width: 300px;
  }

  .hero-buttons .btn {
    width: 100%;
    text-align: center;
    justify-content: center;
  }
}
</style> 