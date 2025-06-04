<template>
  <div class="about-page">
    <div class="container">
      <section class="section">
        <h1 class="section-title">关于我</h1>
        <h3 class="section-subtitle">了解我的世界</h3>
        <p class="section-description">了解更多关于我是谁，我做什么，以及什么激励着我。</p>
        
        <div class="about-content">
          <div class="about-section">
            <h3 class="about-heading">我的阅读</h3>
            <p class="about-subheading">探索塑造我观点的书籍</p>
            
            <div class="books-grid">
              <div class="book-card">
                <div class="book-title">代码整洁之道</div>
                <div class="book-subtitle">敏捷软件工艺的指南</div>
              </div>
            </div>
          </div>
          
          <div class="about-section">
            <h3 class="about-heading">我的工具箱</h3>
            <p class="about-subheading">探索我用于打造卓越数字体验的技术和工具。</p>
            
            <div class="tools-grid">
              <div v-for="skill in profile.skills" :key="skill" class="tool-item">
                {{ skill }}
              </div>
            </div>
          </div>
          
          <div class="about-section">
            <h3 class="about-heading">编码之外</h3>
            <p class="about-subheading">探索我在数字世界之外的兴趣和爱好。</p>
            
            <div class="hobbies-grid">
              <div class="hobby-item">绘画🎨</div>
              <div class="hobby-item">摄影📸</div>
              <div class="hobby-item">徒步🥾</div>
              <div class="hobby-item">游戏🎮</div>
              <div class="hobby-item">音乐🎵</div>
              <div class="hobby-item">阅读📚</div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { API_URLS } from '../config/api'

export default {
  name: 'AboutPage',
  setup() {
    const profile = ref({
      name: '',
      subtitle: '',
      skills: [],
      social: []
    })

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
    })

    return {
      profile
    }
  }
}
</script>

<style scoped>
.about-page {
  padding-top: 120px;
  padding-bottom: 4rem;
}

.about-content {
  max-width: 900px;
  margin: 0 auto;
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

.about-section {
  margin-bottom: 4rem;
}

.about-heading {
  font-size: 1.75rem;
  margin-bottom: 0.5rem;
  color: #e6f1ff;
}

.about-subheading {
  font-size: 1.1rem;
  color: #8892b0;
  margin-bottom: 2rem;
}

.books-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 2rem;
}

.book-card {
  background-color: #112240;
  border-radius: 4px;
  padding: 2rem;
  transition: transform 0.3s ease;
}

.book-card:hover {
  transform: translateY(-5px);
}

.book-title {
  font-size: 1.25rem;
  margin-bottom: 0.5rem;
  color: #e6f1ff;
}

.book-subtitle {
  font-size: 0.9rem;
  color: #8892b0;
}

.tools-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
  gap: 1.5rem;
}

.tool-item {
  background-color: #112240;
  border-radius: 4px;
  padding: 1.5rem 1rem;
  text-align: center;
  color: #64ffda;
  transition: transform 0.3s ease;
}

.tool-item:hover {
  transform: translateY(-5px);
}

.hobbies-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
  gap: 1.5rem;
}

.hobby-item {
  background-color: #112240;
  border-radius: 4px;
  padding: 1.5rem;
  text-align: center;
  color: #e6f1ff;
  transition: transform 0.3s ease;
}

.hobby-item:hover {
  transform: translateY(-5px);
}

@media (max-width: 768px) {
  .about-page {
    padding-top: 100px;
  }
  
  .section-title,
  .section-subtitle,
  .section-description {
    text-align: center;
  }
  
  .section-description {
    margin-left: auto;
    margin-right: auto;
  }
  
  .about-heading,
  .about-subheading {
    text-align: center;
  }
  
  .tools-grid,
  .hobbies-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
</style> 