<template>
  <main>
    <article class="myProfile">
      <div class="myProfile__inner">
        <ul class="myProfile__categories"></ul>
        <h2 class="myProfile__heading">
          {{ user.name }}
        </h2>
        <p class="myProfile__content">
          {{ user.email }}
        </p>
      </div>
    </article>

    <div class="section">
      <div
        class="section__inner section__inner--myProfile__page"
        v-if="hasArticles"
      >
        <h2 class="myProfile__section-heading">My articles:</h2>
        <div class="section__articles">
          <ArticleCard
            v-for="article in articles"
            :key="article.id"
            :article="article"
          />
        </div>
      </div>
      <div
        class="section__inner section__inner--myProfile__page"
        :class="{ noArticles: !hasArticles }"
        v-else
      >
        <h2 class="myProfile__section-heading">You don't have any articles</h2>
      </div>
    </div>
  </main>
</template>

<script>
import ArticleCard from '../components/article/ArticleCard.vue'
import Auth from '@/services/Auth.js'
import Article from '@/services/Article.js'
import { mapStores } from 'pinia'
import { useAuthStore } from '@/store/Auth.js'

export default {
  components: { ArticleCard },
  data() {
    return {
      articles: []
    }
  },
  async created() {
    this.getAuth()
  },
  computed: {
    hasArticles() {
      return this.articles.length
    },

    ...mapStores(useAuthStore),

    user() {
      return this.authStore.user
    }
  },
  methods: {
    async getAuth() {
      const token = localStorage.getItem('token')

      if (!token) {
        this.$router.push('/')
        console.log()
      }

      try {
        const response = await Auth.me()
        this.authStore.setUser(response.data)
      } catch (error) {
        localStorage.setItem('token', '')
        this.$router.push('/')
      }
      this.getArticles()
    },
    async getArticles() {
      try {
        const response = await Article.bySlug(this.authStore.user.slug)
        this.articles = response.data
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>
