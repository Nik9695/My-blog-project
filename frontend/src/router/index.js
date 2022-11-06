import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import Article from '@/views/Article.vue'
import MyProfile from '../views/MyProfile.vue'
import ProfileEditor from '../views/ProfileEditor.vue'
import ArticleEditor from '../views/ArticleEditor.vue'
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
      path: '/article/:id',
      name: 'article',
      component: Article
    },
    {
      path: '/my-profile',
      name: 'my-profile',
      component: MyProfile,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/edit-my-profile',
      name: 'edit-my-profile',
      component: ProfileEditor,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/create-article',
      name: 'create-article',
      component: ArticleEditor,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/edit-article/:id',
      name: 'edit-article',
      component: ArticleEditor,
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
