<template>
  <ArticleEditorCard :title="title" />
  <div class="section">
    <div class="section__inner section__inner--editor">
      <h2 class="editor__section-heading">{{ sectionHeading }}</h2>

      <Form
        :handleCallback="handleArticleMethod"
        :data="articleData"
        v-slot="slotProps"
        class="editor__inputForm editor__inputForm--article"
      >
        <div class="inputForm__column">
          <EditorInput
            v-model="articleData.title"
            name="title"
            lable="Title"
            placeholder="Enter title here"
          />
          <QuillEditor
            v-if="articleData.content"
            v-model:content="articleData.content"
            contentType="html"
            theme="snow"
          />
          <Btn
            type="submit"
            :isLoading="slotProps.isLoading"
            class="btn__editor-page"
            >{{ buttonLabel }}</Btn
          >
        </div>

        <div class="category">
          <label class="editor__inputForm-label" for="Tags">Tags</label>
          <button class="btn__add-category" @submit.prevent="chooseCategory">
            ADD TAG
          </button>
        </div>
      </Form>
    </div>
  </div>
</template>

<script>
import Article from '@/services/Article.js'
import EditorInput from '@/components/general/EditorInput.vue'
import Btn from '@/components/general/Btn.vue'
import Form from '@/components/general/Form.vue'
import ArticleEditorCard from '@/components/general/ArticleEditorCard.vue'
import handleError from '@/helpers/handleError.js'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'

export default {
  components: { EditorInput, Btn, Form, ArticleEditorCard, QuillEditor },
  props: {
    title: {
      type: String,
      required: true
    },
    sectionHeading: {
      type: String,
      required: true
    },
    buttonLabel: {
      type: String,
      required: true
    },
    methodKey: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      articleData: {
        title: '',
        content: ''
      },
      isLoading: false
    }
  },
  async created() {
    if (this.$route.name === 'edit-article') {
      try {
        const response = await Article.show(this.$route.params.id)
        this.articleData = response.data
      } catch (error) {
        handleError(error)
      }
    }
  },
  methods: {
    async createArticle() {
      const response = await Article.create(this.articleData)
      if (response?.status === 201) {
        this.$router.push({ name: 'my-profile' })
      }
    },
    async updateArticle() {
      const response = await Article.update(
        this.articleData,
        this.articleData.id
      )
      if (response?.status === 200) {
        this.$router.push({ name: 'my-profile' })
      }
    },

    async handleArticleMethod() {
      if (this.methodKey === 'create') {
        this.createArticle()
      } else if (this.methodKey === 'update') {
        this.updateArticle()
      }
    }
  }
}
</script>
