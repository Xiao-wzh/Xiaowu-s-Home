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

/* Hero section */
.hero {
  min-height: 100vh;
  display: flex;
  align-items: center;
  padding: 6rem 0;
}

.hero-content {
  max-width: 600px;
}

.availability {
  display: inline-block;
  padding: 0.5rem 1rem;
  background-color: rgba(100, 255, 218, 0.1);
  color: var(--primary);
  border-radius: 4px;
  font-size: 0.875rem;
  margin-bottom: 2rem;
}

.hero-title {
  font-size: 4rem;
  line-height: 1.1;
  color: var(--text-primary);
  margin-bottom: 1.5rem;
}

.hero-subtitle {
  font-size: 1.5rem;
  color: var(--text-secondary);
  margin-bottom: 2rem;
  max-width: 540px;
}

.hero-buttons {
  display: flex;
  gap: 1rem;
}

.hero-image {
  position: relative;
}

.person-img {
  max-width: 100%;
  height: auto;
}

/* Skills section */
.skills-track {
  overflow: hidden;
  padding: 2rem 0;
}

.skills-track-inner {
  display: flex;
  animation: scroll 20s linear infinite;
}

.skill-item {
  flex-shrink: 0;
  padding: 0.5rem 1rem;
  margin: 0 1rem;
  background-color: var(--bg-secondary);
  border-radius: 4px;
  color: var(--text-primary);
  white-space: nowrap;
}

@keyframes scroll {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}

/* Projects section */
.project-card {
  background-color: var(--bg-secondary);
  padding: 2rem;
  border-radius: 8px;
  transition: var(--transition);
}

.project-card:hover {
  transform: translateY(-5px);
}

.project-year {
  color: var(--primary);
  font-size: 0.875rem;
  margin-bottom: 1rem;
}

.project-title {
  color: var(--text-primary);
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

.project-divider {
  width: 2rem;
  height: 2px;
  background-color: var(--primary);
  margin-bottom: 1rem;
}

.project-description {
  color: var(--text-secondary);
  margin-bottom: 1.5rem;
}

.project-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-bottom: 1.5rem;
}

.tag {
  padding: 0.25rem 0.75rem;
  background-color: rgba(100, 255, 218, 0.1);
  color: var(--primary);
  border-radius: 4px;
  font-size: 0.875rem;
}

.project-links {
  display: flex;
  gap: 1rem;
}

.project-link {
  color: var(--text-secondary);
  font-size: 1.25rem;
  transition: var(--transition);
}

.project-link:hover {
  color: var(--primary);
}

/* Testimonials section */
.testimonials-track {
  overflow: hidden;
  padding: 2rem 0;
}

.testimonials-track-inner {
  display: flex;
  animation: scroll 30s linear infinite;
}

.testimonial-card {
  flex-shrink: 0;
  width: 300px;
  margin: 0 1rem;
  padding: 2rem;
  background-color: var(--bg-secondary);
  border-radius: 8px;
}

.testimonial-text {
  color: var(--text-primary);
  margin-bottom: 1.5rem;
  font-style: italic;
}

.testimonial-author {
  display: flex;
  flex-direction: column;
}

.author-name {
  color: var(--primary);
  font-weight: 500;
}

.author-title {
  color: var(--text-secondary);
  font-size: 0.875rem;
}

/* Responsive styles */
@media (max-width: 768px) {
  .hero {
    padding: 4rem 0;
  }

  .hero-title {
    font-size: 3rem;
  }

  .hero-subtitle {
    font-size: 1.25rem;
  }

  .hero-buttons {
    flex-direction: column;
  }

  .project-card {
    margin-bottom: 2rem;
  }
}
</style> 