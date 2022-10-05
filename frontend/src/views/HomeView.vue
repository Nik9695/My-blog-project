<template>
  <main>
    <div class="section">
      <MainArticle :article="featuredArticle" />
      <div class="section__inner">
        <h2 class="section__heading">Popular topics</h2>

        <div class="section__categories">
          <ul class="section__categories-list">
            <li class="section__categories-item">
              <RouterLink to="/" class="section__categories-link--active"
                >All</RouterLink
              >
            </li>
            <li class="section__categories-item">
              <RouterLink to="/" class="section__categories-link"
                >Adventure</RouterLink
              >
            </li>
            <li class="section__categories-item">
              <RouterLink to="/" class="section__categories-link"
                >Travel</RouterLink
              >
            </li>
            <li class="section__categories-item">
              <RouterLink to="/" class="section__categories-link"
                >Fashion</RouterLink
              >
            </li>
            <li class="section__categories-item">
              <RouterLink to="/" class="section__categories-link"
                >Technology</RouterLink
              >
            </li>
            <li class="section__categories-item">
              <RouterLink to="/" class="section__categories-link"
                >Branding</RouterLink
              >
            </li>
            <li class="section__categories-item section__categories-item--last">
              <RouterLink to="/" class="section__categories-link--last"
                >View all</RouterLink
              >
            </li>
          </ul>
        </div>

        <div class="section__articles-cascade">
          <ArticleItemCard
            v-for="article in articlesPopular"
            :key="article.id"
            :article="article"
          />
        </div>
      </div>
    </div>

    <div class="section">
      <div class="section__inner">
        <h2 class="section__heading">Editor's pick</h2>

        <div class="section__articles">
          <ArticleCard
            v-for="article in articlesEditorsPick"
            :key="article.id"
            :article="article"
          />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import MainArticle from '../components/article/MainArticle.vue'
import ArticleItemCard from '../components/article/ArticleItemCard.vue'
import ArticleCard from '../components/article/ArticleCard.vue'
import axios from 'axios'

export default {
  components: { MainArticle, ArticleItemCard, ArticleCard },
  data() {
    return {
      articlesPopular: [],
      articlesEditorsPick: []
    }
  },
  created() {
    axios
      .get('http://localhost:8000/api/articles')
      .then((response) => {
        for (let i = 0; i < 3; ++i) {
          this.articlesEditorsPick.push(response.data[i])
        }
      })
      .catch((error) => {
        console.log(error)
      })

    axios
      .get('http://localhost:8000/api/articles')
      .then((response) => {
        for (let i = 0; i < 8; ++i) {
          this.articlesPopular.push(response.data[i])
        }
      })
      .catch((error) => {
        console.log(error)
      })
  },
  computed: {
    featuredArticle() {
      if (this.articlesPopular.length) {
        return this.articlesPopular[0]
      } else {
        return {}
      }
    }
  }
}
</script>
