<template>
  <div class="aboutArticle__area-author-info">
    <img
      :src="article.author.avatar_path"
      class="aboutArticle__area-author-photo"
      alt=""
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
</template>

<script>
export default {
  props: {
    article: {
      type: Object,
      required: true
    }
  }
}
</script>
