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
              class="category__link-articleForm"
            />
          </ul>
        </div>
        <div class="aboutArticle__area-author">
          <AuthorCard :article="article" />
          <SocialNetworksCard />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ArticleBigCard from '@/components/article/ArticleBigCard.vue'
import CategoryCard from '@/components/article/CategoryCard.vue'
import AboutArticleCard from '@/components/article/AboutArticleCard.vue'
import SocialNetworksCard from '@/components/general/SocialNetworksCard.vue'
import AuthorCard from '@/components/general/AuthorCard.vue'

import ArticleCardMixin from '@/mixins/ArticleCardMixin.js'

export default {
  name: 'ArticleCard',
  components: {
    ArticleBigCard,
    AboutArticleCard,
    CategoryCard,
    SocialNetworksCard,
    AuthorCard
  },
  mixins: [ArticleCardMixin],

  props: {
    article: {
      type: Object,
      required: true
    }
  }
}
</script>
