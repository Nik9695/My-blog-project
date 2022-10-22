<template>
  <main>
    <!--   <AboutArticleCard /> -->
    <article class="aboutArticle">
      <div class="aboutArticle__inner">
        <ul class="aboutArticle__categories">
          <li class="aboutArticle__category">
            <a href="#" class="aboutArticle__category-link">Category</a>
          </li>
        </ul>
        <h2 class="aboutArticle__heading">
          {{ article.title }}
        </h2>

        <p class="aboutArticle__content-author">{{ article.author.name }}</p>
      </div>
    </article>
    <div class="section">
      <div class="section__inner section__inner--aboutArticle__page">
        <div class="aboutArticle__timeline">
          <div class="aboutArticle__date">{{ formatDate }}</div>
          <div class="aboutArticle__timeline-divider"></div>
          <div class="aboutArticle__time">4 minutes</div>
        </div>
        <div class="aboutArticle__area">
          <div class="aboutArticle__area-content">
            <div class="aboutArticle__area-text">
              {{ article.content }}
            </div>
          </div>
          <div class="aboutArticle__area-tags">
            <ul class="section__categories-list">
              <RouterLink to="/" class="aboutArticle__area-tag-item"
                >adventure</RouterLink
              >
              <RouterLink to="/" class="aboutArticle__area-tag-item"
                >photo</RouterLink
              >
              <RouterLink to="/" class="aboutArticle__area-tag-item"
                >design</RouterLink
              >
            </ul>
          </div>
          <div class="aboutArticle__area-author">
            <div class="aboutArticle__area-author-info">
              <img
                src="@/assets/images/authorImage.jpg"
                class="aboutArticle__area-author-photo"
              />
              <div class="aboutArticle__area-author-content">
                <div class="aboutArticle__area-author-name">
                  {{ article.author.name }}
                </div>
                <div class="aboutArticle__area-author-title">
                  {{ article.author.slug }}
                </div>
              </div>
            </div>
            <div class="aboutArticle__area-author-social-networks">
              <a href="#" target="_blank">
                <i class="fa-brands fa-twitter"></i>
              </a>
              <a href="#" target="_blank">
                <i class="fa-brands fa-pinterest"></i>
              </a>
              <a href="#" target="_blank">
                <i class="fa-brands fa-facebook"></i>
              </a>
              <a href="#" target="_blank">
                <i class="fa-brands fa-instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="section__inner">
        <h2 class="aboutArticle__section-heading">Related Posts</h2>
        <div class="section__articles">
          <ArticleCard
            v-for="article in articlesRelated"
            :key="article.id"
            :article="article"
          />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import ArticleCard from '../components/article/ArticleCard.vue'
import AboutArticleCard from '../components/article/AboutArticleCard.vue'
import ArticleCardMixin from '@/mixins/ArticleCardMixin'
import Article from '@/services/Article.js'

export default {
  name: 'Article',
  components: { ArticleCard, AboutArticleCard },
  mixins: [ArticleCardMixin],
  data() {
    return {
      articlesRelated: [],
      article: {}
    }
  },

  async created() {
    try {
      const response = await Article.show(this.$route.params.id)
      console.log(response)
      this.article = response.data
    } catch (error) {
      console.log(error)
    }

    Article.getAll()
      .then((response) => {
        this.articlesRelated = response.data.data.slice(0, 3)
      })
      .catch((error) => {
        console.log(error)
      })
  }
}
</script>
