<template>
  <div class="projects">
    <section class="projects-hero section">
      <div class="container">
        <h1 class="section-title">我的项目</h1>
        <p class="section-description">这里展示了我最近完成的一些项目。每个项目都代表了我在不同领域的探索和成长。</p>
        
        <div class="filters">
          <button v-for="category in categories"
                  :key="category"
                  :class="['filter-btn', { active: selectedCategory === category }]"
                  @click="filterProjects(category)">
            {{ category }}
          </button>
        </div>

        <div class="projects-grid">
          <div v-for="project in filteredProjects"
               :key="project.id"
               class="project-card">
            <div class="project-image">
              <img :src="project.image" :alt="project.title" />
              <div class="project-overlay">
                <div class="project-links">
                  <a :href="project.github" target="_blank" class="project-link" v-if="project.github">
                    <i class="icon-github"></i>
                  </a>
                  <a :href="project.demo" target="_blank" class="project-link" v-if="project.demo">
                    <i class="icon-external-link"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="project-content">
              <div class="project-header">
                <h3 class="project-title">{{ project.title }}</h3>
                <span class="project-category">{{ project.category }}</span>
              </div>
              <p class="project-description">{{ project.description }}</p>
              <div class="project-tech">
                <span v-for="tech in project.technologies"
                      :key="tech"
                      class="tech-tag">
                  {{ tech }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'
import { API_URLS } from '../config/api'

export default {
  name: 'ProjectsPage',
  setup() {
    const projects = ref([])
    const selectedCategory = ref('全部')
    const categories = ref(['全部'])

    const filteredProjects = computed(() => {
      if (selectedCategory.value === '全部') {
        return projects.value
      }
      return projects.value.filter(project => project.category === selectedCategory.value)
    })

    const filterProjects = (category) => {
      selectedCategory.value = category
    }

    const fetchProjects = async () => {
      try {
        const response = await axios.get(API_URLS.PROJECTS)
        if (response.data) {
          projects.value = response.data
          // 从项目中提取所有唯一的类别
          const uniqueCategories = new Set(projects.value.map(p => p.category))
          categories.value = ['全部', ...uniqueCategories]
        }
      } catch (error) {
        console.error('Error fetching projects:', error)
      }
    }

    onMounted(() => {
      fetchProjects()
    })

    return {
      projects,
      categories,
      selectedCategory,
      filteredProjects,
      filterProjects
    }
  }
}
</script>

<style scoped>
.projects {
  padding-top: 6rem;
}

.section-description {
  max-width: 600px;
  margin: 0 auto 3rem;
  text-align: center;
  color: var(--text-secondary);
  font-size: 1.125rem;
  line-height: 1.6;
}

.filters {
  display: flex;
  justify-content: center;
  gap: 1rem;
  margin-bottom: 3rem;
  flex-wrap: wrap;
}

.filter-btn {
  padding: 0.5rem 1.5rem;
  border: 1px solid var(--primary);
  background: transparent;
  color: var(--primary);
  border-radius: 4px;
  cursor: pointer;
  transition: var(--transition);
  font-size: 0.875rem;
}

.filter-btn:hover,
.filter-btn.active {
  background-color: rgba(100, 255, 218, 0.1);
}

.projects-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 2rem;
}

.project-card {
  background-color: var(--bg-secondary);
  border-radius: 8px;
  overflow: hidden;
  transition: var(--transition);
}

.project-card:hover {
  transform: translateY(-5px);
}

.project-image {
  position: relative;
  padding-top: 56.25%; /* 16:9 Aspect Ratio */
  overflow: hidden;
}

.project-image img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: var(--transition);
}

.project-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(10, 25, 47, 0.9);
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0;
  transition: var(--transition);
}

.project-card:hover .project-overlay {
  opacity: 1;
}

.project-links {
  display: flex;
  gap: 1.5rem;
}

.project-link {
  color: var(--text-primary);
  font-size: 1.5rem;
  transition: var(--transition);
}

.project-link:hover {
  color: var(--primary);
  transform: translateY(-3px);
}

.project-content {
  padding: 1.5rem;
}

.project-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.project-title {
  color: var(--text-primary);
  font-size: 1.25rem;
  margin: 0;
}

.project-category {
  color: var(--primary);
  font-size: 0.875rem;
}

.project-description {
  color: var(--text-secondary);
  margin-bottom: 1.5rem;
  line-height: 1.6;
}

.project-tech {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.tech-tag {
  padding: 0.25rem 0.75rem;
  background-color: rgba(100, 255, 218, 0.1);
  color: var(--primary);
  border-radius: 4px;
  font-size: 0.75rem;
}

@media (max-width: 768px) {
  .projects-grid {
    grid-template-columns: 1fr;
  }

  .filters {
    flex-direction: row;
    overflow-x: auto;
    padding-bottom: 1rem;
    margin: -0.5rem -1rem 2rem;
    padding: 0.5rem 1rem;
  }

  .filter-btn {
    flex-shrink: 0;
  }
}
</style> 