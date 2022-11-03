<template>
  <main>
    <AboutArticleCard :article="article" />
    <ArticleCard :article="article" />

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
import CategoryCard from '@/components/article/CategoryCard.vue'
import AboutArticleCard from '@/components/article/AboutArticleCard.vue'
import ArticleCard from '@/components/article/ArticleCard.vue'

import Article from '@/services/Article.js'
import handleError from '@/helpers/handleError.js'
import ArticleCardMixin from '@/mixins/ArticleCardMixin.js'

export default {
  name: 'Article',
  components: { ArticleBigCard, AboutArticleCard, CategoryCard, ArticleCard },
  mixins: [ArticleCardMixin],
  data() {
    return {
      articlesRelated: [],
      article: {
        author: {
          name: ''
        }
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

    Article.getAll('created_at', 'desc', 3)
      .then((response) => {
        this.articlesRelated = response.data.data
      })
      .catch((error) => {
        handleError(error)
      })
  }
}
</script>
