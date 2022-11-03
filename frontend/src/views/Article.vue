<template>
  <main>
    <AboutArticleCard :article="article" />
    <ArticleCard :article="article" />

    <div class="section">
      <div class="section__inner">
        <div class="commentsArea">
          <div class="comments__heading">Comments:</div>

          <Form
            :handleCallback="storeComment"
            :data="comment"
            v-slot="slotProps"
            class="form__comments"
          >
            <div class="comments__inputWrapper">
              <img
                :src="article.author.avatar_path"
                class="comment__author-photo"
              />
              <div class="comments__input">
                <input
                  v-model="comment.content"
                  class="comment__inputForm"
                  name="comment"
                  placeholder="Write comment"
                />

                <Btn
                  type="submit"
                  :isLoading="slotProps.isLoading"
                  class="btn__send-comment"
                  >Send</Btn
                >
              </div>
            </div>
          </Form>

          <CommentCard
            v-for="comment in comments"
            :key="comment.id"
            :comment="comment"
          />
        </div>
      </div>
    </div>

    <div class="section">
      <div class="section__inner">
        <h2 class="aboutArticle__section-heading">Related Posts</h2>
        <div class="section__articles">
          <ArticleBigCard
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
import ArticleBigCard from '@/components/article/ArticleBigCard.vue'
import CategoryCard from '@/components/article/CategoryCard.vue'
import AboutArticleCard from '@/components/article/AboutArticleCard.vue'
import ArticleCard from '@/components/article/ArticleCard.vue'
import CommentCard from '@/components/comment/CommentCard.vue'
import Form from '@/components/general/Form.vue'
import Btn from '@/components/general/Btn.vue'

import Article from '@/services/Article.js'
import Comment from '@/services/Comment.js'
import handleError from '@/helpers/handleError.js'
import ArticleCardMixin from '@/mixins/ArticleCardMixin.js'

export default {
  name: 'Article',
  components: {
    ArticleBigCard,
    AboutArticleCard,
    CategoryCard,
    ArticleCard,
    Btn,
    Form,
    CommentCard
  },
  mixins: [ArticleCardMixin],
  data() {
    return {
      articlesRelated: [],
      article: {
        author: {
          name: ''
        }
      },
      comment: {},
      user: {}
    }
  },
  async created() {
    try {
      const response = await Article.show(this.$route.params.id)
      this.article = response.data
    } catch (error) {
      handleError(error)
    }

    Article.getAll('created_at', 'desc', 3)
      .then((response) => {
        this.articlesRelated = response.data.data
      })
      .catch((error) => {
        handleError(error)
      })
  },

  computed: {
    comments() {
      return this.article.comments
    }
  },

  methods: {
    async storeComment() {
      const response = await Comment.create(
        this.article.id,
        this.comment.content
      )
      this.resetInputForm()
      this.isLoading = false
    },
    resetInputForm() {
      this.comment = Object.assign({}, '')
    }
  }
}
</script>
