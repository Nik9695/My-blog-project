<template>
  <main class="main">
    <ArticleEditorCard :title="title" />
    <div class="section">
      <h2 class="editor__section-heading">Edit content</h2>

      <div class="section__inner section__inner--articleEditor">
        <Form
          :handleCallback="updateArticle"
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
              >Update</Btn
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
          <label
            class="editor__inputForm-label editor__inputForm-label--articleBackground"
            for="Tags"
            >Click on image to update it:</label
          >
          <div class="article__image">
            <img
              class="article__backgroundImage"
              @click="showAvatarUpload = !showAvatarUpload"
              :src="articleData.background_image_path"
              alt=""
            />
            <my-upload
              field="img"
              @crop-success="cropSuccess"
              v-model="showAvatarUpload"
              :width="300"
              :height="300"
              img-format="jpg"
              lang-type="en"
            />
          </div>
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
import myUpload from 'vue-image-crop-upload'

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
    CategoryCard,
    myUpload
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
        categories: [],
        category_id: []
      },
      options: [{}],
      value: [],
      isLoading: false,
      showAvatarUpload: false
    }
  },
  async created() {
    try {
      const response = await Article.show(this.$route.params.id)
      this.articleData.title = response.data.title
      this.articleData.content = response.data.content
      this.articleData.categories = response.data.categories
      this.articleData.background_image_path =
        response.data.background_image_path
    } catch (error) {
      handleError(error)
    }

    try {
      const response = await Category.getAll()
      response.data.forEach((category) => {
        this.options.push({ value: category.id, label: category.slug })
      })
      this.categoryList = response.data
    } catch (error) {
      handleError(error)
    }
  },
  methods: {
    async updateArticle() {
      this.articleData.category_id = this.value
      const response = await Article.update(
        this.articleData,
        this.$route.params.id
      )
      if (response?.status === 200) {
        this.$router.push({ name: 'my-profile' })
      }
      this.$notify({
        type: 'success',
        text: 'Article updated successfully!'
      })
    },
    async cropSuccess(imgDataUrl, field) {
      this.articleData.background_image = this.dataUrlToFile(imgDataUrl, field)
      const response = await Article.updateArticleBackground(
        this.articleData,
        this.$route.params.id
      )
      this.articleData.background_image_path =
        response.data.background_image_path

      this.$notify({
        type: 'success',
        text: 'Article background image updated successfully!'
      })
    },
    dataUrlToFile(dataurl, filename) {
      let arr = dataurl.split(','),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]),
        n = bstr.length,
        u8arr = new Uint8Array(n)
      while (n--) {
        u8arr[n] = bstr.charCodeAt(n)
      }
      return new File([u8arr], filename, { type: mime })
    }
  }
}
</script>
