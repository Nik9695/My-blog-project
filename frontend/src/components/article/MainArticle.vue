<template>
  <article class="mainArticle">
    <div class="mainArticle__inner">
      <ul class="mainArticle__categories">
        <CategoryCard
          v-for="category in article.categories"
          :key="category.id"
          :category="category"
        />
      </ul>

      <h2 v-if="article.title" class="mainArticle__heading">
        <RouterLink
          :to="{ name: 'article', params: { id: article.id } }"
          class="mainArticle__heading-link"
        >
          {{ article.title }}
        </RouterLink>
      </h2>
      <p v-if="article.content" class="mainArticle__content">
        <time class="marinArticle__content-time">{{ formatDate }}</time>
        <span class="mainArticle__content-divider"></span>
        <span class="mainArticle__content-text">{{ shortContent }}</span>
      </p>
    </div>
  </article>
</template>

<script>
import CategoryCard from './CategoryCard.vue'
import ArticleCardMixin from '@/mixins/ArticleCardMixin'

export default {
  name: 'MainArticle',
  components: { CategoryCard },
  mixins: [ArticleCardMixin],
  props: {
    article: {
      type: Object,
      required: true
    }
  }
}
</script>
