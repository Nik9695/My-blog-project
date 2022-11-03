<template>
  <main>
    <div class="section">
      <MainArticle :article="featuredArticle" />
      <div class="section__inner">
        <h2 class="section__heading">Popular topics</h2>

        <CategoriesList />
        <div class="section__articles-cascade" v-if="articles.data.length">
          <ArticleItemCard
            v-for="article in articles.data"
            :key="article.id"
            :article="article"
          />
        </div>

        <div
          class="section__articles-cascade section__articles-cascade--noArticles"
          v-else
        >
          <p>No articles found.</p>
        </div>

        <InfiniteLoading
          v-if="this.isLastPage === false"
          @infinite="loadArticles"
        />
      </div>
    </div>
  </main>
</template>

<script>
import MainArticle from '@/components/article/MainArticle.vue'
import ArticleItemCard from '@/components/article/ArticleItemCard.vue'
import CategoriesList from '@/components/general/CategoriesList.vue'
import InfiniteLoading from 'v3-infinite-loading'

import Article from '@/services/Article.js'
import handleError from '@/helpers/handleError.js'
import 'v3-infinite-loading/lib/style.css'

export default {
  components: {
    MainArticle,
    ArticleItemCard,
    CategoriesList,
    InfiniteLoading
  },
  data() {
    return {
      articles: {
        data: []
      },
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

    let categorySlug = this.$route.params.slug
    if (this.$route.params.slug === 'all') {
      categorySlug = null
    }

    try {
      const response = await Article.getAll(
        'created_at',
        'desc',
        8,
        1,
        categorySlug
      )
      this.articles = response.data
      this.isLoading = false
    } catch (error) {
      handleError(error)
    }
    this.isLoading = false
  },
  methods: {
    async loadArticles() {
      this.isLoading = true

      if (this.isLastPage) {
        return
      }

      let categorySlug = this.$route.params.slug
      if (this.$route.params.slug === 'all') {
        categorySlug = null
      }

      try {
        const response = await Article.getAll(
          'created_at',
          'desc',
          8,
          this.articles.current_page + 1,
          categorySlug
        )

        this.articles.data = this.articles.data.concat(response.data.data)
        this.articles.current_page = response.data.current_page
        this.articles.last_page = response.data.last_page
      } catch (error) {
        handleError(error)
      }

      this.isLoading = false
    }
    /*     getCategorySlug() {
      let categorySlug = this.$route.params.slug
      if (this.$route.params.slug === 'all') {
        categorySlug = null
      }

      return categorySlug
    } */
  }
}
</script>
