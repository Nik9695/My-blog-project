<template>
  <main>
    <div class="myProfile">
      <div class="myProfile__inner">
        <img
          src="@/assets/images/default-user-icon.png"
          class="myProfile__image"
        />
        <h2 class="myProfile__heading">
          {{ user.name }}
        </h2>
        <p class="myProfile__content">
          {{ user.email }}
        </p>

        <p>
          <RouterLink class="myProfile__link" to="/edit-my-profile">
            Edit profile</RouterLink
          >
        </p>

        <p>
          <RouterLink class="myProfile__link" to="/create-article">
            Create Article</RouterLink
          >
        </p>

        <p>
          <RouterLink class="myProfile__link" to="/edit-article">
            Edit Article</RouterLink
          >
        </p>
      </div>
    </div>

    <div class="section">
      <div
        class="section__inner section__inner--myProfile__page"
        v-if="hasArticles"
      >
        <h2 class="myProfile__section-heading">My articles:</h2>
        <div class="section__articles">
          <ArticleCard
            v-for="article in articles"
            :key="article.id"
            :article="article"
          />
        </div>
      </div>
      <div
        class="section__inner section__inner--myProfile__page"
        :class="{ noArticles: !hasArticles }"
        v-else
      >
        <h2 class="myProfile__section-heading">You don't have any articles</h2>
      </div>
    </div>
  </main>
</template>

<script>
import ArticleCard from '../components/article/ArticleCard.vue'
import Article from '@/services/Article.js'
import { mapStores } from 'pinia'
import { useAuthStore } from '@/store/Auth.js'

export default {
  components: { ArticleCard },
  data() {
    return {
      articles: []
    }
  },
  async created() {
    this.getArticles()
  },
  computed: {
    hasArticles() {
      return this.articles.length
    },

    ...mapStores(useAuthStore),

    user() {
      return this.authStore.user
    }
  },
  methods: {
    async getArticles() {
      try {
        const response = await Article.byUserId(this.authStore.user.id)
        this.articles = response.data.data
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>
