<template>
  <div class="article__item">
    <RouterLink
      :to="{ name: 'article', params: { id: article.id } }"
      class="articleItem__link"
    >
      <div class="article__item-top">
        <img
          :src="article.background_image_path"
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
        <AuthorCard :article="article" />
      </div>
    </RouterLink>
  </div>
</template>

<script>
import CategoryCard from '@/components/article/CategoryCard.vue'
import AuthorCard from '@/components/general/AuthorCard.vue'
import ArticleCardMixin from '@/mixins/ArticleCardMixin'
export default {
  name: 'ArticleSmallCard',
  components: { CategoryCard, AuthorCard },
  mixins: [ArticleCardMixin],
  props: {
    article: {
      type: Object,
      required: true
    }
  }
}
</script>
