<template>
  <main class="main">
    <ArticleEditorCard :title="title" />
    <div class="section">
      <h2 class="editor__section-heading">{{ sectionHeading }}</h2>

      <div class="section__inner section__inner--editor">
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
            <QuillEditor
              v-else
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
        </Form>
        <div class="tags__area">
          <label class="editor__inputForm-label" for="Tags">Tags</label>
          <div class="category">
            <CategoryCard
              v-for="category in articleData.categories"
              :key="category.id"
              :category="category"
              class="category__link-articleForm"
            />

            <Btn
              v-if="methodKey === 'create'"
              @click="addCategoriesToArticle()"
              :isLoading="isLoading"
              type="submit"
              class="btn__add-category"
              >ADD TAG &#65291;</Btn
            >
            <Btn
              v-if="methodKey === 'update'"
              @click="updateCategoriesOnArticle()"
              :isLoading="isLoading"
              type="submit"
              class="btn__add-category"
              >ADD TAG &#65291;</Btn
            >
          </div>

          <Multiselect
            v-model="selectedCategories"
            :options="categoriesTagsComputed"
            mode="tags"
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
import '@vueform/multiselect/themes/default.css'

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
        content: '',
        categories: [],
        category_id: []
      },
      categoryList: {
        data: []
      },
      options: [],
      selectedCategories: [],
      isLoading: false,
      multiSelectHidden: false
    }
  },
  async created() {
    try {
      const response = await Category.getAll()
      this.categoryList = response.data
    } catch (error) {
      handleError(error)
    }

    if (this.$route.name === 'edit-article') {
      try {
        const response = await Article.show(this.$route.params.id)
        this.articleData = response.data
      } catch (error) {
        handleError(error)
      }
    }
  },
  computed: {
    categoriesTagsComputed() {
      const array = []
      this.categoryList.data.forEach(function (category) {
        array.push(category.slug)
      })
      return array
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
        await this.createArticle()
      } else if (this.methodKey === 'update') {
        await this.updateArticle()
      }
    },
    //for Article Create
    async findSelectedCategoriesIdBySlug(slug) {
      try {
        const response = await Category.bySlug(slug)
        this.articleData.category_id.push(response.data.id)
      } catch (error) {
        handleError(error)
      }
    },

    async addCategoriesToArticle() {
      this.selectedCategories.forEach(
        async (slug) => await this.findSelectedCategoriesIdBySlug(slug)
      )
    },

    //for Article update
    async findSelectedCategoriesBySlug(slug) {
      try {
        const response = await Category.bySlug(slug)
        this.articleData.categories.push(response.data)
      } catch (error) {
        handleError(error)
      }
    },

    async updateCategoriesOnArticle() {
      this.selectedCategories.forEach(
        async (slug) => await this.findSelectedCategoriesBySlug(slug)
      )
    }
  }
}
</script>
