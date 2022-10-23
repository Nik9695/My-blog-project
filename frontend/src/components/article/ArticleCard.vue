<template>
  <article class="article">
    <RouterLink
      :to="{ name: 'article', params: { id: article.id } }"
      class="article__link"
    >
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
    <div class="edit__option" v-if="currentRouteName === 'my-profile'">
      <RouterLink
        :to="{ name: 'edit-article', params: { id: article.id } }"
        class="editArticle__link"
      >
        <img
          src="@/assets/images/edit-article-button.png"
          alt="Title"
          class="editArticle__btn"
        />
      </RouterLink>
    </div>
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
  },
  computed: {
    currentRouteName() {
      return this.$route.name
    }
  }
}
</script>
