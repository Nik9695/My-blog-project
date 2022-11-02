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
            v-for="article in articles.data"
            :key="article.id"
            :article="article"
          />
          <InfiniteLoading
            v-if="this.isLastPage === false"
            @infinite="loadArticles"
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
import Article from '@/services/Article.js'
import handleError from '@/helpers/handleError.js'
import InfiniteLoading from 'v3-infinite-loading'
import 'v3-infinite-loading/lib/style.css'

export default {
  components: { MainArticle, ArticleItemCard, ArticleCard, InfiniteLoading },
  data() {
    return {
      articles: {
        data: []
      },
      articlesPopular: [],
      isLoading: false
    }
  },
  computed: {
    featuredArticle() {
      if (this.articles.data.length) {
        return this.articles.data[0]
      } else {
        return {}
      }
    },
    isLastPage() {
      return this.articles.current_page === this.articles.last_page
    }
  },
  async created() {
    this.isLoading = true
    try {
      const response = await Article.getAll('created_at', 'desc', 8)
      this.articles = response.data
      this.isLoading = false
    } catch (error) {
      handleError(error)
    }
  },
  methods: {
    async loadArticles() {
      this.isLoading = true

      if (this.isLastPage) {
        return
      }

      try {
        const response = await Article.getAll(
          'created_at',
          'desc',
          8,
          this.articles.current_page + 1
        )

        this.articles.data = this.articles.data.concat(response.data.data)
        this.articles.current_page = response.data.current_page
        this.articles.last_page = response.data.last_page
      } catch (error) {}

      this.isLoading = false
    }
  }
}
</script>
