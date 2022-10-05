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
        <time class="article__time">10:00</time>
        <h3 class="article__heading">{{ articleTitle }}</h3>
        <p class="article__text">{{ articleContent }}</p>
      </div>
    </RouterLink>
  </article>
</template>

<script>
import CategoryCard from './CategoryCard.vue'
export default {
  name: 'ArticleCard',
  components: { CategoryCard },

  props: {
    articleTitle: {
      type: String,
      required: true
    },
    articleContent: {
      type: String,
      required: true
    }
  }
}
</script>
