<template>
  <main>
    <div class="create__article" v-if="currentRouteName === 'create-article'">
      <ArticleForm
        title="Create new article"
        sectionHeading="Add content"
        buttonLabel="Create"
        methodKey="create"
      />
    </div>

    <div class="create__article" v-if="currentRouteName === 'edit-article'">
      <ArticleForm
        title="Edit article"
        sectionHeading="Edit content"
        buttonLabel="Update"
        methodKey="update"
      />
    </div>
  </main>
</template>

<script>
import ArticleForm from '@/components/general/ArticleForm.vue'

export default {
  components: { ArticleForm },

  computed: {
    currentRouteName() {
      return this.$route.name
    }
  }
}
</script>
