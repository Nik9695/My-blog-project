<template>
  <main>
    <AboutArticleCard />
    <div class="section">
      <div class="section__inner--aboutArticle__page">MY PROFILE</div>
    </div>
    <div class="section">
      <div class="section__inner">
        <h2 class="aboutArticle__section-heading">Related Posts</h2>
        <div class="section__articles">
          <ArticleCard v-for="i in 3" :key="i" />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import ArticleCard from '../components/article/ArticleCard.vue'
import AboutArticleCard from '../components/article/AboutArticleCard.vue'
import axios from 'axios'
export default {
  components: { AboutArticleCard, ArticleCard },
  data() {
    return {
      user: {}
    }
  },
  async created() {
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
      //console.log(response.data)
      //console.log(this.user)
    } catch (error) {
      console.log(error)
      localStorage.setItem('token', '')
      this.$router.push('/')
    }
  }
}
</script>
