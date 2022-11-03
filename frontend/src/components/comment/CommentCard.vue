<template>
  <div class="articleComments">
    <img :src="comment.author.avatar_path" class="comment__author-photo" />

    <div class="comment">
      <div class="comment__author">
        {{ comment.author.name }}
      </div>

      <div class="comment__createdAt">
        {{ formatDate }} - {{ commentLifeTime }} minutes
      </div>

      <div class="comment__content">
        {{ comment.content }}
      </div>
    </div>
  </div>
</template>

<script>
import CommentCardMixin from '@/mixins/CommentCardMixin.js'
export default {
  mixins: [CommentCardMixin],
  props: {
    comment: {
      type: Object,
      required: true
    }
  }
}
</script>
