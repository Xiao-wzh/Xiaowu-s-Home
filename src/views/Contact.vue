<template>
  <div class="contact">
    <section class="contact-hero section">
      <div class="container">
        <h1 class="section-title">联系我</h1>
        <p class="section-description">
          如果您有任何问题或合作意向，请随时与我联系。我会在24小时内回复您的消息。
        </p>

        <div class="contact-content">
          <div class="contact-info">
            <div class="info-card">
              <div class="info-icon">📍</div>
              <h3>地址</h3>
              <p>{{ profile.location }}</p>
            </div>
            <div class="info-card">
              <div class="info-icon">📧</div>
              <h3>邮箱</h3>
              <p>{{ profile.email }}</p>
            </div>
            <div class="info-card">
              <div class="info-icon">📱</div>
              <h3>社交媒体</h3>
              <div class="social-links">
                <a v-for="(link, platform) in profile.social"
                   :key="platform"
                   :href="link"
                   target="_blank"
                   class="social-link">
                  {{ platform }}
                </a>
              </div>
            </div>
          </div>

          <form class="contact-form" @submit.prevent="handleSubmit">
            <div class="form-group">
              <label for="name">姓名</label>
              <input type="text"
                     id="name"
                     v-model="form.name"
                     required
                     placeholder="请输入您的姓名" />
            </div>

            <div class="form-group">
              <label for="email">邮箱</label>
              <input type="email"
                     id="email"
                     v-model="form.email"
                     required
                     placeholder="请输入您的邮箱" />
            </div>

            <div class="form-group">
              <label for="subject">主题</label>
              <input type="text"
                     id="subject"
                     v-model="form.subject"
                     required
                     placeholder="请输入消息主题" />
            </div>

            <div class="form-group">
              <label for="message">消息</label>
              <textarea id="message"
                        v-model="form.message"
                        required
                        rows="6"
                        placeholder="请输入您的消息内容"></textarea>
            </div>

            <button type="submit" class="submit-btn" :disabled="isSubmitting">
              {{ isSubmitting ? '发送中...' : '发送消息' }}
            </button>

            <div v-if="submitStatus" :class="['submit-status', submitStatus.type]">
              {{ submitStatus.message }}
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { ref, reactive, onMounted } from 'vue'
import axios from 'axios'
import { API_URLS } from '../config/api'

export default {
  name: 'ContactPage',
  setup() {
    const profile = ref({
      location: '',
      email: '',
      social: {}
    })

    const form = reactive({
      name: '',
      email: '',
      subject: '',
      message: ''
    })

    const isSubmitting = ref(false)
    const submitStatus = ref(null)

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

    const handleSubmit = async () => {
      isSubmitting.value = true
      submitStatus.value = null

      try {
        await axios.post(API_URLS.CONTACT, form)
        submitStatus.value = {
          type: 'success',
          message: '消息发送成功！我会尽快回复您。'
        }
        // 重置表单
        Object.keys(form).forEach(key => form[key] = '')
      } catch (error) {
        submitStatus.value = {
          type: 'error',
          message: '发送失败，请稍后重试。'
        }
        console.error('Error submitting form:', error)
      } finally {
        isSubmitting.value = false
      }
    }

    onMounted(() => {
      fetchProfile()
    })

    return {
      profile,
      form,
      isSubmitting,
      submitStatus,
      handleSubmit
    }
  }
}
</script>

<style scoped>
.contact {
  padding-top: 6rem;
}

.section-description {
  max-width: 600px;
  margin: 0 auto 4rem;
  text-align: center;
  color: var(--text-secondary);
  font-size: 1.125rem;
  line-height: 1.6;
}

.contact-content {
  display: grid;
  grid-template-columns: 1fr 2fr;
  gap: 4rem;
  align-items: start;
}

/* Contact Info */
.contact-info {
  display: grid;
  gap: 2rem;
}

.info-card {
  background-color: var(--bg-secondary);
  padding: 2rem;
  border-radius: 8px;
  text-align: center;
}

.info-icon {
  font-size: 2rem;
  margin-bottom: 1rem;
}

.info-card h3 {
  color: var(--text-primary);
  margin-bottom: 1rem;
  font-size: 1.25rem;
}

.info-card p {
  color: var(--text-secondary);
}

.social-links {
  display: flex;
  justify-content: center;
  gap: 1rem;
}

.social-link {
  color: var(--text-secondary);
  transition: var(--transition);
}

.social-link:hover {
  color: var(--primary);
  transform: translateY(-3px);
}

/* Contact Form */
.contact-form {
  background-color: var(--bg-secondary);
  padding: 3rem;
  border-radius: 8px;
}

.form-group {
  margin-bottom: 1.5rem;
}

label {
  display: block;
  color: var(--text-primary);
  margin-bottom: 0.5rem;
  font-size: 0.875rem;
}

input,
textarea {
  width: 100%;
  padding: 0.75rem 1rem;
  background-color: var(--bg-main);
  border: 1px solid var(--bg-secondary);
  border-radius: 4px;
  color: var(--text-primary);
  font-size: 1rem;
  transition: var(--transition);
}

input:focus,
textarea:focus {
  outline: none;
  border-color: var(--primary);
}

textarea {
  resize: vertical;
}

.submit-btn {
  width: 100%;
  padding: 1rem;
  background-color: var(--primary);
  color: var(--bg-main);
  border: none;
  border-radius: 4px;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: var(--transition);
}

.submit-btn:hover {
  opacity: 0.9;
}

.submit-btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.submit-status {
  margin-top: 1rem;
  padding: 1rem;
  border-radius: 4px;
  text-align: center;
}

.submit-status.success {
  background-color: rgba(100, 255, 218, 0.1);
  color: var(--primary);
}

.submit-status.error {
  background-color: rgba(255, 100, 100, 0.1);
  color: #ff6464;
}

/* Responsive Styles */
@media (max-width: 768px) {
  .contact-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }

  .contact-form {
    padding: 2rem;
  }
}
</style> 