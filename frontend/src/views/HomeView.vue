<template>
  <main>
    <div class="section">
      <MainArticle :article="featuredArticle" />
      <div class="section__inner">
        <h2 class="section__heading">Popular topics</h2>
        <CategoriesList />
        <div class="section__articles-cascade">
          <ArticleSmallCard
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
          <ArticleBigCard
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
import MainArticle from '@/components/article/MainArticle.vue'
import ArticleSmallCard from '@/components/article/ArticleSmallCard.vue'
import ArticleBigCard from '@/components/article/ArticleBigCard.vue'
import CategoriesList from '@/components/general/CategoriesList.vue'

import Article from '@/services/Article.js'
import handleError from '@/helpers/handleError.js'

export default {
  components: { MainArticle, ArticleSmallCard, ArticleBigCard, CategoriesList },
  data() {
    return {
      articlesPopular: [],
      articlesEditorsPick: []
    }
  },
  created() {
    Article.getAll('created_at', 'desc', 8)
      .then((response) => {
        this.articlesPopular = response.data.data
      })
      .catch((error) => {
        handleError(error)
      })

    Article.getAll('created_at', 'desc', 3)
      .then((response) => {
        this.articlesEditorsPick = response.data.data
      })
      .catch((error) => {
        handleError(error)
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
