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
          <CategoryCard
            v-for="category in article.categories"
            :key="category.id"
            :category="category"
          />
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
          {{ shortContent }}
        </p>
        <div class="article__area-author-info">
          <img
            :src="article.author.avatar_path"
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
import CategoryCard from '@/components/article/CategoryCard.vue'
import ArticleCardMixin from '@/mixins/ArticleCardMixin'
export default {
  name: 'ArticleSmallCard',
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
