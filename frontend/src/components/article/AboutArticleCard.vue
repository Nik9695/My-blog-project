<template>
  <article class="aboutArticle">
    <div class="aboutArticle__inner">
      <ul class="aboutArticle__categories">
        <CategoryCard
          v-for="category in article.categories"
          :key="category.id"
          :category="category"
        />
      </ul>
      <h2 class="aboutArticle__heading">
        {{ article.title }}
      </h2>

      <p class="aboutArticle__content-author">
        {{ article.author.name }}
      </p>
    </div>
  </article>
</template>

<script>
import CategoryCard from './CategoryCard.vue'
import ArticleCardMixin from '@/mixins/ArticleCardMixin'

export default {
  name: 'AboutArticleCard',
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
