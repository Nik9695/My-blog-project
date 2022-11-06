<template>
  <main>
    <div class="create__article" v-if="currentRouteName === 'create-article'">
      <ArticleCreateForm title="Create new article" />
    </div>

    <div class="create__article" v-if="currentRouteName === 'edit-article'">
      <ArticleUpdateForm title="Edit article" />
    </div>
  </main>
</template>

<script>
import ArticleCreateForm from '@/components/forms/ArticleCreateForm.vue'
import ArticleUpdateForm from '@/components/forms/ArticleUpdateForm.vue'

export default {
  components: { ArticleCreateForm, ArticleUpdateForm },

  computed: {
    currentRouteName() {
      return this.$route.name
    }
  }
}
</script>
