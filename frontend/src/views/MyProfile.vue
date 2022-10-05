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
        MY PROFILE
      </div>
    </div>
    <div class="section">
      <div class="section__inner">
        <h2 class="myProfile__section-heading">Related Posts</h2>
        <div class="section__articles">
          <ArticleCard v-for="i in 3" :key="i" />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import ArticleCard from '../components/article/ArticleCard.vue'
//import MyProfileCard from '../components/article/MyProfileCard.vue'
import axios from 'axios'
export default {
  components: { ArticleCard },
  data() {
    return {
      user: {},
      articles: {}
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
  },
  computed: {
    loadArticles() {
      const articles = this.user
    }
  }
}
</script>
