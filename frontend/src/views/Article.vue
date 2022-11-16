<template>
  <main>
    <AboutArticleCard :article="article" />
    <ArticleCard :article="article" />

    <CommentsOnArticle :articleId="this.$route.params.id" />

    <div class="section">
      <div class="section__inner">
        <h2 class="aboutArticle__section-heading">Related Posts</h2>
        <div class="section__articles">
          <ArticleBigCard
            v-for="article in articlesRelated"
            :key="article.id"
            :article="article"
          />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import ArticleBigCard from '@/components/article/ArticleBigCard.vue'
import AboutArticleCard from '@/components/article/AboutArticleCard.vue'
import ArticleCard from '@/components/article/ArticleCard.vue'
import CommentsOnArticle from '@/components/comment/CommentsOnArticle.vue'

import Article from '@/services/Article.js'
import handleError from '@/helpers/handleError.js'
import ArticleCardMixin from '@/mixins/ArticleCardMixin.js'

import { mapStores } from 'pinia'
import { useAuthStore } from '@/store/Auth.js'

import 'v3-infinite-loading/lib/style.css'

export default {
  name: 'Article',
  components: {
    ArticleBigCard,
    AboutArticleCard,
    ArticleCard,
    CommentsOnArticle
  },
  mixins: [ArticleCardMixin],
  data() {
    return {
      articlesRelated: [],
      article: {
        author: {}
      }
    }
  },
  async created() {
    try {
      const response = await Article.show(this.$route.params.id)
      this.article = response.data
    } catch (error) {
      handleError(error)
    }

    try {
      const response = await Article.getAll('created_at', 'desc', 3)
      this.articlesRelated = response.data.data
    } catch (error) {
      handleError(error)
    }
  },

  computed: {
    ...mapStores(useAuthStore),
    user() {
      return this.authStore.user
    }
  }
}
</script>
