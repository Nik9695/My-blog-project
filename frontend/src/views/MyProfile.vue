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
      <div class="section__inner section__inner--myProfile__page">
        <h2 class="myProfile__section-heading">My articles:</h2>
        <div class="section__articles">
          <ArticleCard
            v-for="article in articles"
            :key="article.id"
            :article="article"
          />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import ArticleCard from '../components/article/ArticleCard.vue'
import axios from 'axios'
export default {
  components: { ArticleCard },
  data() {
    return {
      user: {},
      articles: []
    }
  },
  async created() {
    this.getAuth()
    this.getArticles()
  },
  methods: {
    async getAuth() {
      const token = localStorage.getItem('token')

      if (!token) {
        this.$router.push('/')
        console.log()
      }
      try {
        const response = await axios.get('http://localhost:8000/api/user', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        this.user = response.data
      } catch (error) {
        console.log(error)
        localStorage.setItem('token', '')
        this.$router.push('/')
      }
    }
  },
  computed: {
    async getArticles() {
      try {
        const token = localStorage.getItem('token')
        const response = await axios.get(
          `http://localhost:8000/api/users/${this.user.slug}/articles`,
          {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }
        )
        this.articles = response.data
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>
