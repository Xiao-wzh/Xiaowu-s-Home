<template>
  <div class="projects-page">
    <div class="container">
      <section class="section">
        <h1 class="section-title">Featured Projects</h1>
        <h3 class="section-subtitle">Real-world Results</h3>
        <p class="section-description">See how I transformed concepts into engaging digital experiences.</p>
        
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
      </section>

      <section class="section">
        <h2 class="section-title">Other Projects</h2>
        <h3 class="section-subtitle">Experimental Creations</h3>
        <p class="section-description">Explore some of my side projects and experimental creations.</p>
        
        <div class="grid grid-3">
          <div v-for="project in otherProjects"
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
      </section>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { API_URLS } from '../config/api'

export default {
  name: 'ProjectsPage',
  setup() {
    const featuredProjects = ref([])
    const otherProjects = ref([])

    const fetchProjects = async () => {
      try {
        const response = await axios.get(API_URLS.PROJECTS)
        console.log('Projects API response:', response.data)
        
        if (response.data) {
          if (response.data.featured) {
            featuredProjects.value = response.data.featured || []
          }
          if (response.data.other) {
            otherProjects.value = response.data.other || []
          }
        }
      } catch (error) {
        console.error('Error fetching projects:', error)
      }
    }

    onMounted(() => {
      fetchProjects()
    })

    return {
      featuredProjects,
      otherProjects
    }
  }
}
</script>

<style scoped>
.projects-page {
  padding-top: 120px;
  padding-bottom: 4rem;
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

@media (max-width: 768px) {
  .projects-page {
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
  
  .grid-3 {
    grid-template-columns: 1fr;
  }
}
</style> 