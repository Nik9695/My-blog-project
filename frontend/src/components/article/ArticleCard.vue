<template>
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
            <CategoryCard
              v-for="category in this.article.categories"
              :key="category.id"
              :category="category"
              class="category__link category__link--article-page"
            />
          </ul>
        </div>
        <div class="aboutArticle__area-author">
          <div class="aboutArticle__area-author-info">
            <img
              :src="article.author.avatar_path"
              class="aboutArticle__area-author-photo"
              alt=""
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
</template>

<script>
import ArticleBigCard from '@/components/article/ArticleBigCard.vue'
import CategoryCard from '@/components/article/CategoryCard.vue'
import AboutArticleCard from '@/components/article/AboutArticleCard.vue'

import ArticleCardMixin from '@/mixins/ArticleCardMixin.js'

export default {
  name: 'ArticleCard',
  components: { ArticleBigCard, AboutArticleCard, CategoryCard },
  mixins: [ArticleCardMixin],

  props: {
    article: {
      type: Object,
      required: true
    }
  }
}
</script>
