<template>
  <article class="mainArticle">
    <div class="mainArticle__inner">
      <ul class="mainArticle__categories">
        <CategoryCard />
      </ul>
      <h2 class="mainArticle__heading">
        {{ article.title }}
      </h2>
      <p class="mainArticle__content">
        <time class="marinArticle__content-time">{{ formatDate }}</time>
        <span class="mainArticle__content-divider"></span>
        <span class="mainArticle__content-text">{{
          article.content.substring(0, 100)
        }}</span>
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
