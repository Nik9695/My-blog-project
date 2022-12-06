<template>
  <main class="main">
    <ArticleEditorCard :title="title" />
    <div class="section">
      <h2 class="editor__section-heading">Add content</h2>

      <div class="section__inner section__inner--articleEditor">
        <Form
          :handleCallback="createArticle"
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
              v-model:content="articleData.content"
              contentType="html"
              theme="snow"
            />
            <Btn
              type="submit"
              :isLoading="slotProps.isLoading"
              class="btn__editor-page"
              >Create</Btn
            >
          </div>
        </Form>
        <div class="tags__area">
          <label class="editor__inputForm-label" for="Tags">Tags</label>
          <div class="categories__area">
            <CategoryCard
              v-for="category in articleData.categories"
              :key="category.id"
              :category="category"
              class="category__link-articleForm"
            />
          </div>

          <Multiselect
            v-model="value"
            mode="tags"
            :close-on-select="false"
            :searchable="true"
            :create-option="true"
            :options="options"
            placeholder="Choose your stack"
          />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import EditorInput from '@/components/general/EditorInput.vue'
import Btn from '@/components/general/Btn.vue'
import Form from '@/components/general/Form.vue'
import ArticleEditorCard from '@/components/general/ArticleEditorCard.vue'
import CategoryCard from '@/components/article/CategoryCard.vue'

import Article from '@/services/Article.js'
import Category from '@/services/Category.js'
import handleError from '@/helpers/handleError.js'

import { QuillEditor } from '@vueup/vue-quill'
import Multiselect from '@vueform/multiselect'

import '@vueup/vue-quill/dist/vue-quill.snow.css'

export default {
  components: {
    EditorInput,
    Btn,
    Form,
    ArticleEditorCard,
    QuillEditor,
    Multiselect,
    CategoryCard
  },
  props: {
    title: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      articleData: {
        title: '',
        content: '',
        category_id: []
      },
      categoryList: {
        data: []
      },
      options: [{}],
      value: null,
      isLoading: false
    }
  },
  async created() {
    try {
      const response = await Category.getAll()
      response.data.forEach((category) => {
        this.options.push({ value: category.id, label: category.slug })
      })
    } catch (error) {
      handleError(error)
    }
  },

  methods: {
    async createArticle() {
      this.articleData.category_id = this.value
      const response = await Article.create(this.articleData)
      if (response?.status === 201) {
        this.$router.push({ name: 'my-profile' })
      }
      this.$notify({
        type: 'success',
        text: 'Article created successfully!'
      })
    }
  }
}
</script>
