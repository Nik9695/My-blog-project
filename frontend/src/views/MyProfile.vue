<template>
  <main>
    <ProfileCard
      :user="user"
      :link="'/edit-my-profile'"
      :linkLabel="'Edit profile'"
    />

    <div class="section">
      <div
        class="section__inner section__inner--myProfile__page"
        v-if="hasArticles"
      >
        <h2 class="myProfile__section-heading">My articles:</h2>
        <div class="section__articles section__articles--myProfile">
          <ArticleBigCard
            v-for="article in articles"
            :key="article.id"
            :article="article"
          />
          <div class="addArticle">
            <RouterLink
              :to="{ name: 'create-article' }"
              class="addArticle__btn"
            >
              +
            </RouterLink>
            <p class="addArticle__btn-text">Add new article</p>
          </div>
        </div>
      </div>
      <div
        class="section__inner section__inner--myProfile__page"
        :class="{ noArticles: !hasArticles }"
        v-else
      >
        <h2 class="myProfile__section-heading">You don't have any articles</h2>
        <div class="addArticle">
          <RouterLink :to="{ name: 'create-article' }" class="addArticle__btn">
            +
          </RouterLink>
          <p class="addArticle__btn-text">Add new article</p>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import ArticleBigCard from '../components/article/ArticleBigCard.vue'
import ProfileCard from '@/components/general/ProfileCard.vue'
import Article from '@/services/Article.js'
import { mapStores } from 'pinia'
import { useAuthStore } from '@/store/Auth.js'
import handleError from '@/helpers/handleError.js'

export default {
  components: { ArticleBigCard, ProfileCard },
  data() {
    return {
      articles: []
    }
  },
  async created() {
    try {
      const response = await Article.byUserId(this.user.id)
      this.articles = response.data.data.slice(0, 5)
    } catch (error) {
      handleError(error)
    }
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
  methods: {}
}
</script>
