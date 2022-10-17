<template>
  <div class="article__item">
    <div class="article__item-top">
      <img
        src="https://loremflickr.com/420/350"
        alt=""
        class="article__item-image"
      />
      <ul class="article__categories">
        <CategoryCard />
      </ul>
    </div>
    <div class="article__item-bottom">
      <time class="article__item-bottom-date">{{ formatDate }}</time>
      <h3 class="article__item-bottom-title">
        <RouterLink to="/" class="article__item-bottom-titleLink">{{
          article.title.substring(0, 10)
        }}</RouterLink>
      </h3>
      <p class="article__item-bottom-text">
        {{ article.content.substring(0, 100) }}
      </p>
      <div class="article__area-author-info">
        <img
          src="@/assets/images/authorImage.jpg"
          class="article__area-author-photo"
        />
        <div class="article__area-author-content">
          <div class="article__area-author-name">By Jennifer Lawrence</div>
          <div class="article__area-author-title">Thinker & Designer</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CategoryCard from './CategoryCard.vue'
import { format, parseISO } from 'date-fns'
export default {
  name: 'ArticleItemCard',
  components: { CategoryCard },
  props: {
    article: {
      type: Object,
      required: true
    }
  },
  computed: {
    formatDate() {
      const stringFromDate = parseISO(this.article.created_at)
      return format(stringFromDate, 'dd-MM-yyyy')
    }
  }
}
</script>
