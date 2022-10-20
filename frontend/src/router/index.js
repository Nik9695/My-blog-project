import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AboutView from '../views/AboutView.vue'
import MyProfile from '../views/MyProfile.vue'
import Auth from '@/services/Auth'
import { useAuthStore } from '@/store/Auth.js'
import { useModalStore } from '@/store/Modal.js'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      component: AboutView
    },
    {
      path: '/my-profile',
      name: 'my-profile',
      component: MyProfile,
      meta: {
        requiresAuth: true
      }
    }
  ]
})

router.beforeEach(async (to) => {
  const authStore = useAuthStore()
  const modalStore = useModalStore()

  if (localStorage.getItem('token') !== null && authStore.isGuest) {
    try {
      const response = await Auth.me()
      authStore.setUser(response.data)
    } catch (error) {
      authStore.logoutUser()
    }
  }

  if (to.meta.requiresAuth && authStore.isGuest) {
    modalStore.openModal('login')
    return {
      name: 'home'
    }
  }
})

export default router
