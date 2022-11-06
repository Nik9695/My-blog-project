<template>
  <div class="article__item">
    <RouterLink
      :to="{ name: 'article', params: { id: article.id } }"
      class="articleItem__link"
    >
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
          <div to="/" class="article__item-bottom-titleLink">
            {{ article.title.substring(0, 10) }}
          </div>
        </h3>
        <p class="article__item-bottom-text">
          {{ article.content.substring(0, 70) }}
        </p>
        <div class="article__area-author-info">
          <img
            src="@/assets/images/authorImage.jpg"
            class="article__area-author-photo"
          />
          <div class="article__area-author-content">
            <div class="article__area-author-name">
              {{ article.author.name }}
            </div>
            <div class="article__area-author-title">
              {{ article.author.slug }}
            </div>
          </div>
        </div>
      </div>
    </RouterLink>
  </div>
</template>

<script>
import CategoryCard from './CategoryCard.vue'
import ArticleCardMixin from '@/mixins/ArticleCardMixin'
export default {
  name: 'ArticleItemCard',
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
