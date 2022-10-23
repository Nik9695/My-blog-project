<template>
  <main>
    <div class="myProfile">
      <div class="myProfile__inner">
        <img
          src="@/assets/images/default-user-icon.png"
          class="myProfile__image"
        />
        <h2 class="myProfile__heading">Test User</h2>
        <p class="myProfile__content">email</p>

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
        <h2 class="editor__section-heading">Edit Profile</h2>

        <form action="" class="editor__inputForm">
          <EditorInput
            v-model="userData.email"
            name="email"
            lable="Email"
            placeholder="your@email.com"
          />
          <EditorInput
            v-model="userData.email"
            name="name"
            lable="Name"
            placeholder="Name surname"
          />
          <EditorInput
            v-model="userData.email"
            name="slug"
            lable="Slug"
            placeholder="Slug"
          />
          <EditorInput
            v-model="userData.email"
            name="password"
            lable="Password"
            placeholder="Enter new password"
          />
          <EditorInput
            v-model="userData.email"
            name="Repeat password"
            lable="Repeat password"
            placeholder="Repeat password"
          />

          <button class="btn__editor-page" @submit.prevent="updateUser">
            Update
          </button>
        </form>
      </div>
    </div>
  </main>
</template>

<script>
import EditorInput from '@/components/general/EditorInput.vue'
import Btn from '@/components/general/Btn.vue'

export default {
  components: { EditorInput, Btn },
  data() {
    return {
      userData: {
        email: '',
        name: '',
        slug: '',
        password: ''
      }
    }
  },
  methods: {
    updateProfile() {}
  }
}
</script>
