<template>
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
</template>

<script>
import Form from '@/components/general/Form.vue'
import Btn from '@/components/general/Btn.vue'
import CommentCard from '@/components/comment/CommentCard.vue'
import InfiniteLoading from 'v3-infinite-loading'

import { mapStores } from 'pinia'
import { useAuthStore } from '@/store/Auth.js'
import handleError from '@/helpers/handleError.js'
import Comment from '@/services/Comment.js'

export default {
  components: { Form, Btn, InfiniteLoading, CommentCard },
  data() {
    return {
      comments: {
        data: []
      },
      newComment: {}
    }
  },
  props: {
    articleId: {
      type: Number,
      required: true
    }
  },
  async created() {
    this.reloadComments()
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
      await Comment.create(this.articleId, this.newComment.content)
      await this.reloadComments()
      this.resetInputForm()
      this.isLoading = false
    },
    async loadComments() {
      this.isLoading = true

      if (this.isLastPage) {
        return
      }

      let articleId = this.articleId

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
        const response = await Comment.getAll(this.articleId)
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
