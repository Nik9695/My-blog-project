<template>
  <main>
    <div class="myProfile">
      <div class="myProfile__inner">
        <h2 class="myProfile__heading">Create new article</h2>

        <div class="devider"></div>

        <p>
          <RouterLink class="myProfile__link" to="/my-profile">
            Back to profile</RouterLink
          >
        </p>
      </div>
    </div>

    <div class="section">
      <div class="section__inner section__inner--editor">
        <h2 class="editor__section-heading">Add content</h2>

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

            <EditorInput
              v-model="articleData.content"
              name="content"
              lable="Content"
              placeholder="Enter content of article here"
              :isTextArea="true"
            />
            <Btn type="submit" :isLoading="slotProps.isLoading">Create</Btn>
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
  </main>
</template>

<script>
import Article from '@/services/Article.js'
import EditorInput from '@/components/general/EditorInput.vue'
import Btn from '@/components/general/Btn.vue'
import Form from '@/components/general/Form.vue'

export default {
  components: { EditorInput, Btn, Form },
  data() {
    return {
      articleData: {
        title: '',
        content: ''
      },
      isLoading: false,
      isTextArea: true
    }
  },
  computed: {},
  methods: {
    async createArticle() {
      const response = await Article.create(this.articleData)
      if (response?.status === 201) {
        this.$router.push({ name: 'my-profile' })
      }
    }
  }
}
</script>
