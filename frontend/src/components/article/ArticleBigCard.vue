<template>
  <article class="article">
    <RouterLink
      :to="{ name: 'article', params: { id: article.id } }"
      class="article__link"
    >
      <ul class="article__categories">
        <CategoryCard
          v-for="category in article.categories"
          :key="category.id"
          :category="category"
        />
      </ul>
      <img :src="article.background_image_path" alt="" class="article__image" />
      <div class="article__content">
        <time class="article__time">{{ formatDate }}</time>
        <h3 class="article__heading">
          {{ article.title }}
        </h3>
        <p class="article__text">{{ shortContent }}</p>
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
      <button
        type="submit"
        class="deleteArticle__btn"
        @click.prevent="deleteArticle"
      ></button>
    </div>
  </article>
</template>

<script>
import CategoryCard from '@/components/article/CategoryCard.vue'
import ArticleCardMixin from '@/mixins/ArticleCardMixin'
import Article from '@/services/Article.js'
export default {
  name: 'ArticleBigCard',
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
