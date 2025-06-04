// API配置
export const API_BASE_URL = 'http://localhost:3000';

// API端点
export const API_ENDPOINTS = {
    PROFILE: '/api/profile',
    PROJECTS: '/api/projects',
    CONTACT: '/api/contact'
};

// 完整的API URL
export const API_URLS = {
    PROFILE: API_BASE_URL + API_ENDPOINTS.PROFILE,
    PROJECTS: API_BASE_URL + API_ENDPOINTS.PROJECTS,
    CONTACT: API_BASE_URL + API_ENDPOINTS.CONTACT
}; 