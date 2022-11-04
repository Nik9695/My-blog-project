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
            :data="newComment"
            v-slot="slotProps"
            class="form__comments"
          >
            <div class="comments__inputWrapper">
              <img :src="user.avatar_path" class="comment__author-photo" />
              <div class="comments__input">
                <input
                  v-model="newComment.content"
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
            v-for="comment in comments.data"
            :key="comment.id"
            :comment="comment"
          />
        </div>
        <InfiniteLoading v-if="isLastPage === false" @infinite="loadComments" />
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
import InfiniteLoading from 'v3-infinite-loading'

import Article from '@/services/Article.js'
import Comment from '@/services/Comment.js'
import handleError from '@/helpers/handleError.js'
import ArticleCardMixin from '@/mixins/ArticleCardMixin.js'

import { mapStores } from 'pinia'
import { useAuthStore } from '@/store/Auth.js'

import 'v3-infinite-loading/lib/style.css'

export default {
  name: 'Article',
  components: {
    ArticleBigCard,
    AboutArticleCard,
    CategoryCard,
    ArticleCard,
    Btn,
    Form,
    CommentCard,
    InfiniteLoading
  },
  mixins: [ArticleCardMixin],
  data() {
    return {
      comments: {
        data: []
      },
      articlesRelated: [],
      newComment: {},
      article: {
        author: {}
      }
    }
  },
  async created() {
    try {
      const response = await Article.show(this.$route.params.id)
      this.article = response.data
    } catch (error) {
      handleError(error)
    }
    try {
      const response = await Comment.getAll(this.$route.params.id)
      this.comments = response.data
    } catch (error) {
      handleError(error)
    }

    try {
      const response = await Article.getAll('created_at', 'desc', 3)
      this.articlesRelated = response.data.data
    } catch (error) {
      handleError(error)
    }
  },

  computed: {
    ...mapStores(useAuthStore),
    user() {
      return this.authStore.user
    },
    isLastPage() {
      console.log(this.comments.current_page)
      return this.comments.current_page === this.comments.last_page
    }
  },

  methods: {
    async storeComment() {
      await Comment.create(this.article.id, this.newComment.content)
      await this.reloadComments()
      this.resetInputForm()
      this.isLoading = false
    },

    async loadComments() {
      this.isLoading = true

      if (this.isLastPage) {
        return
      }

      let articleId = this.$route.params.id

      try {
        const response = await Comment.getAll(
          articleId,
          5,
          this.comments.current_page + 1
        )
        console.log(response)

        this.comments.data = this.comments.data.concat(response.data.data)
        this.comments.current_page = response.data.current_page
        this.comments.last_page = response.data.last_page
      } catch (error) {
        handleError(error)
      }

      this.isLoading = false
    },
    async reloadComments() {
      try {
        const response = await Comment.getAll(this.$route.params.id)
        this.comments = response.data
      } catch (error) {
        handleError(error)
      }
    },
    resetInputForm() {
      this.newComment = Object.assign({}, '')
    }
  }
}
</script>
