<template>
  <div class="about">
    <section class="about-hero section">
      <div class="container">
        <h1 class="section-title">关于我</h1>
        <div class="about-content">
          <div class="about-text">
            <p class="about-description">{{ profile.about }}</p>
            <div class="experience">
              <h2 class="experience-title">工作经历</h2>
              <div class="timeline">
                <div v-for="exp in profile.experience" :key="exp.id" class="timeline-item">
                  <div class="timeline-date">{{ exp.period }}</div>
                  <div class="timeline-content">
                    <h3 class="timeline-title">{{ exp.title }}</h3>
                    <div class="timeline-company">{{ exp.company }}</div>
                    <p class="timeline-description">{{ exp.description }}</p>
                    <div class="timeline-skills">
                      <span v-for="skill in exp.skills" :key="skill" class="skill-tag">
                        {{ skill }}
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="about-image">
            <img :src="profile.avatar" alt="Profile picture" class="profile-img" />
          </div>
        </div>
      </div>
    </section>

    <section class="skills-section section">
      <div class="container">
        <h2 class="section-title">技能 & 工具</h2>
        <div class="skills-grid">
          <div v-for="(skills, category) in profile.skills" :key="category" class="skills-category">
            <h3 class="category-title">{{ category }}</h3>
            <ul class="skills-list">
              <li v-for="skill in skills" :key="skill" class="skill-item">
                {{ skill }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="education-section section">
      <div class="container">
        <h2 class="section-title">教育背景</h2>
        <div class="education-grid">
          <div v-for="edu in profile.education" :key="edu.id" class="education-card">
            <div class="education-period">{{ edu.period }}</div>
            <h3 class="education-degree">{{ edu.degree }}</h3>
            <div class="education-school">{{ edu.school }}</div>
            <p class="education-description">{{ edu.description }}</p>
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
  name: 'AboutPage',
  setup() {
    const profile = ref({
      about: '',
      avatar: '',
      experience: [],
      skills: {},
      education: []
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
.about {
  padding-top: 6rem;
}

.about-content {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 4rem;
  align-items: start;
}

.about-description {
  font-size: 1.25rem;
  line-height: 1.8;
  color: var(--text-secondary);
  margin-bottom: 4rem;
}

.about-image {
  position: sticky;
  top: 8rem;
}

.profile-img {
  width: 100%;
  border-radius: 8px;
  box-shadow: 0 10px 30px -15px rgba(2, 12, 27, 0.7);
}

/* Experience Timeline */
.experience {
  margin-top: 4rem;
}

.experience-title {
  font-size: 2rem;
  color: var(--text-primary);
  margin-bottom: 2rem;
}

.timeline {
  position: relative;
  padding-left: 2rem;
}

.timeline::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 2px;
  background-color: var(--primary);
}

.timeline-item {
  position: relative;
  padding-bottom: 3rem;
}

.timeline-item::before {
  content: '';
  position: absolute;
  left: -2rem;
  top: 0.5rem;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: var(--primary);
  border: 2px solid var(--bg-main);
}

.timeline-date {
  color: var(--primary);
  font-size: 0.875rem;
  margin-bottom: 0.5rem;
}

.timeline-title {
  color: var(--text-primary);
  font-size: 1.25rem;
  margin-bottom: 0.5rem;
}

.timeline-company {
  color: var(--text-secondary);
  font-size: 1rem;
  margin-bottom: 1rem;
}

.timeline-description {
  color: var(--text-secondary);
  line-height: 1.6;
  margin-bottom: 1rem;
}

.timeline-skills {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.skill-tag {
  padding: 0.25rem 0.75rem;
  background-color: rgba(100, 255, 218, 0.1);
  color: var(--primary);
  border-radius: 4px;
  font-size: 0.875rem;
}

/* Skills Section */
.skills-section {
  background-color: var(--bg-secondary);
  padding: 6rem 0;
}

.skills-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
}

.skills-category {
  padding: 2rem;
  background-color: var(--bg-main);
  border-radius: 8px;
}

.category-title {
  color: var(--primary);
  font-size: 1.25rem;
  margin-bottom: 1.5rem;
}

.skills-list {
  list-style: none;
  padding: 0;
}

.skills-list .skill-item {
  color: var(--text-secondary);
  margin-bottom: 0.5rem;
  position: relative;
  padding-left: 1.5rem;
}

.skills-list .skill-item::before {
  content: '▹';
  position: absolute;
  left: 0;
  color: var(--primary);
}

/* Education Section */
.education-section {
  padding: 6rem 0;
}

.education-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
}

.education-card {
  padding: 2rem;
  background-color: var(--bg-secondary);
  border-radius: 8px;
  transition: var(--transition);
}

.education-card:hover {
  transform: translateY(-5px);
}

.education-period {
  color: var(--primary);
  font-size: 0.875rem;
  margin-bottom: 0.5rem;
}

.education-degree {
  color: var(--text-primary);
  font-size: 1.25rem;
  margin-bottom: 0.5rem;
}

.education-school {
  color: var(--text-secondary);
  font-size: 1rem;
  margin-bottom: 1rem;
}

.education-description {
  color: var(--text-secondary);
  line-height: 1.6;
}

/* Responsive Styles */
@media (max-width: 768px) {
  .about-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }

  .about-image {
    position: static;
    margin-top: 2rem;
  }

  .skills-grid {
    grid-template-columns: 1fr;
  }

  .education-grid {
    grid-template-columns: 1fr;
  }
}
</style> 