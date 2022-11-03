<template>
  <main>
    <AboutArticleCard :article="article" />

    <div class="section">
      <div class="section__inner section__inner--aboutArticle__page">
        <div class="aboutArticle__timeline">
          <div class="aboutArticle__date">{{ formatDate }}</div>
          <div class="aboutArticle__timeline-divider"></div>
          <div class="aboutArticle__time">{{ articleLifeTime }} minutes</div>
        </div>
        <div class="aboutArticle__area">
          <div class="aboutArticle__area-content">
            <div class="aboutArticle__area-text" v-html="article.content"></div>
          </div>
          <div class="aboutArticle__area-tags">
            <ul class="section__categories-list">
              <RouterLink to="/" class="aboutArticle__area-tag-item"
                >adventure</RouterLink
              >
              <RouterLink to="/" class="aboutArticle__area-tag-item"
                >photo</RouterLink
              >
              <RouterLink to="/" class="aboutArticle__area-tag-item"
                >design</RouterLink
              >
            </ul>
          </div>
          <div class="aboutArticle__area-author">
            <div class="aboutArticle__area-author-info">
              <img
                src="@/assets/images/authorImage.jpg"
                class="aboutArticle__area-author-photo"
              />
              <div class="aboutArticle__area-author-content">
                <div class="aboutArticle__area-author-name">
                  {{ article.author.name }}
                </div>
                <div class="aboutArticle__area-author-title">
                  {{ article.author.slug }}
                </div>
              </div>
            </div>
            <div class="aboutArticle__area-author-social-networks">
              <a href="#" target="_blank">
                <i class="fa-brands fa-twitter"></i>
              </a>
              <a href="#" target="_blank">
                <i class="fa-brands fa-pinterest"></i>
              </a>
              <a href="#" target="_blank">
                <i class="fa-brands fa-facebook"></i>
              </a>
              <a href="#" target="_blank">
                <i class="fa-brands fa-instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="section__inner">
        <h2 class="aboutArticle__section-heading">Related Posts</h2>
        <div class="section__articles">
          <ArticleCard
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
import ArticleCard from '../components/article/ArticleCard.vue'
import AboutArticleCard from '@/components/article/AboutArticleCard.vue'
import ArticleCardMixin from '@/mixins/ArticleCardMixin'

import { parseISO } from 'date-fns'
import { differenceInMinutes } from 'date-fns'
import Article from '@/services/Article.js'
import handleError from '@/helpers/handleError.js'

export default {
  name: 'Article',
  components: { ArticleCard, AboutArticleCard },
  mixins: [ArticleCardMixin],
  data() {
    return {
      articlesRelated: [],
      article: {}
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
  },
  computed: {
    articleLifeTime() {
      const created = parseISO(this.article.created_at)
      const now = Date.now()
      return differenceInMinutes(now, created)
    }
  }
}
</script>
