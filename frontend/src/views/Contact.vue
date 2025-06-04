<template>
  <div class="contact-page">
    <div class="container">
      <section class="section">
        <h1 class="section-title">联系我</h1>
        <h3 class="section-subtitle">让我们一起创造精彩</h3>
        <p class="section-description">准备好开始您的下一个项目了吗？让我们联系并讨论我如何帮助您实现目标。</p>
        
        <div class="contact-content">
          <div class="contact-form-container">
            <form class="contact-form" @submit.prevent="handleSubmit">
              <div class="form-group">
                <label for="name" class="form-label">姓名</label>
                <input type="text"
                       id="name"
                       v-model="form.name"
                       class="form-control"
                       required>
              </div>

              <div class="form-group">
                <label for="email" class="form-label">邮箱</label>
                <input type="email"
                       id="email"
                       v-model="form.email"
                       class="form-control"
                       required>
              </div>

              <div class="form-group">
                <label for="subject" class="form-label">主题</label>
                <input type="text"
                       id="subject"
                       v-model="form.subject"
                       class="form-control">
              </div>

              <div class="form-group">
                <label for="message" class="form-label">留言</label>
                <textarea id="message"
                          v-model="form.message"
                          class="form-control"
                          rows="5"
                          required></textarea>
              </div>

              <button type="submit" class="btn btn-primary" :disabled="isSubmitting">
                {{ isSubmitting ? '发送中...' : '发送消息' }}
              </button>

              <div v-if="submitStatus" 
                   :class="['submit-status', submitStatus.success ? 'success' : 'error']">
                {{ submitStatus.message }}
              </div>
            </form>
          </div>
          
          <div class="contact-info">
            <div class="info-card">
              <div class="info-item">
                <i class="info-icon">📧</i>
                <a :href="'mailto:' + contact.email">{{ contact.email }}</a>
              </div>
              <div class="info-item">
                <i class="info-icon">📱</i>
                <a :href="'tel:' + contact.phone">{{ contact.phone }}</a>
              </div>
              <div class="info-divider"></div>
              <div class="info-item">
                <div class="map-placeholder">地图</div>
              </div>
            </div>
            
            <div class="emoji-container">
              <div class="emoji">笑脸表情</div>
              <div class="emoji">派对表情</div>
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
  name: 'ContactPage',
  setup() {
    const contact = ref({
      email: '',
      phone: '',
      address: ''
    })

    const form = ref({
      name: '',
      email: '',
      subject: '',
      message: ''
    })

    const isSubmitting = ref(false)
    const submitStatus = ref(null)

    const fetchContactInfo = async () => {
      try {
        // 使用硬编码的联系信息，因为我们没有settings.php
        contact.value = {
          email: 'contact@example.com',
          phone: '+1 (123) 456-7890',
          address: 'San Francisco, CA'
        }
      } catch (error) {
        console.error('Error fetching contact info:', error)
      }
    }

    const handleSubmit = async () => {
      isSubmitting.value = true
      submitStatus.value = null

      try {
        await axios.post(API_URLS.CONTACT, form.value)
        submitStatus.value = {
          success: true,
          message: '消息发送成功！'
        }
        // 清空表单
        form.value = {
          name: '',
          email: '',
          subject: '',
          message: ''
        }
      } catch (error) {
        submitStatus.value = {
          success: false,
          message: error.response?.data?.error || '发送失败，请重试。'
        }
      } finally {
        isSubmitting.value = false
      }
    }

    onMounted(() => {
      fetchContactInfo()
    })

    return {
      contact,
      form,
      isSubmitting,
      submitStatus,
      handleSubmit
    }
  }
}
</script>

<style scoped>
.contact-page {
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

.contact-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  max-width: 1100px;
  margin: 0 auto;
}

.contact-form-container {
  background-color: #112240;
  border-radius: 8px;
  padding: 2.5rem;
}

.info-card {
  background-color: #112240;
  border-radius: 8px;
  padding: 2.5rem;
  margin-bottom: 2rem;
}

.info-item {
  display: flex;
  align-items: center;
  margin-bottom: 1.5rem;
}

.info-icon {
  font-size: 1.5rem;
  margin-right: 1rem;
}

.info-item a {
  color: #8892b0;
  text-decoration: none;
  transition: color 0.3s ease;
}

.info-item a:hover {
  color: #64ffda;
}

.info-divider {
  height: 1px;
  background-color: #233554;
  margin: 1.5rem 0;
}

.map-placeholder {
  width: 100%;
  height: 200px;
  background-color: rgba(255, 255, 255, 0.05);
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 4px;
  color: #64ffda;
}

.emoji-container {
  display: flex;
  justify-content: space-between;
}

.emoji {
  width: 100px;
  height: 100px;
  background-color: #112240;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  color: #64ffda;
}

.submit-status {
  margin-top: 1.5rem;
  padding: 1rem;
  border-radius: 4px;
  text-align: center;
}

.submit-status.success {
  background-color: rgba(100, 255, 218, 0.1);
  color: #64ffda;
}

.submit-status.error {
  background-color: rgba(255, 100, 100, 0.1);
  color: #ff6464;
}

@media (max-width: 768px) {
  .contact-page {
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
  
  .contact-content {
    grid-template-columns: 1fr;
  }
  
  .emoji-container {
    justify-content: center;
    gap: 2rem;
  }
}
</style> 