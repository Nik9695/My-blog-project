<template>
  <article class="article">
    <RouterLink to="/" class="article__link">
      <ul class="article__categories">
        <CategoryCard />
      </ul>
      <img
        src="https://loremflickr.com/420/350"
        alt="Title"
        class="article__image"
      />
      <div class="article__content">
        <time class="article__time">{{ formatDate }}</time>
        <h3 class="article__heading">
          {{ article.title }}
        </h3>
        <p class="article__text">{{ article.content.substring(0, 100) }} ...</p>
      </div>
    </RouterLink>
  </article>
</template>

<script>
import CategoryCard from './CategoryCard.vue'
import ArticleCardMixin from '@/mixins/ArticleCardMixin'
export default {
  name: 'ArticleCard',
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
