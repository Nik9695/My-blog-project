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
      <form @submit.prevent="deleteArticle" class="delete__option">
        <button type="submit" class="deleteArticle__btn"></button>
      </form>
    </div>
  </article>
</template>

<script>
import CategoryCard from './CategoryCard.vue'
import ArticleCardMixin from '@/mixins/ArticleCardMixin'
import Article from '@/services/Article.js'
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
  methods: {
    async deleteArticle() {
      const response = await Article.delete(this.article, this.article.id)
      if (response?.status === 200) {
        this.$router.go({ name: 'my-profile' })
      }
    }
  },
  computed: {
    currentRouteName() {
      return this.$route.name
    }
  }
}
</script>
