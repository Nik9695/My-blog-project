<template>
  <main>
    <div class="myProfile">
      <div class="myProfile__inner">
        <img
          src="@/assets/images/default-user-icon.png"
          class="myProfile__image"
        />
        <h2 class="myProfile__heading">{{ authStore.user.name }}</h2>
        <p class="myProfile__content">{{ authStore.user.email }}</p>

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

        <Form
          :handleCallback="updateProfile"
          :data="userData"
          v-slot="slotProps"
        >
          <EditorInput
            v-model="userData.email"
            name="email"
            lable="Email"
            placeholder="your@email.com"
          />
          <EditorInput
            v-model="userData.name"
            name="name"
            lable="Name"
            placeholder="Name surname"
          />
          <EditorInput
            v-model="userData.slug"
            name="slug"
            lable="Slug"
            placeholder="Slug"
          />
          <EditorInput
            v-model="userData.password"
            name="password"
            type="password"
            lable="Password"
            placeholder="Enter new password"
          />
          <!--           <EditorInput
            v-model="userData.email"
            name="Repeat password"
            lable="Repeat password"
            placeholder="Repeat password"
          /> -->

          <Btn type="submit" :isLoading="slotProps.isLoading">Update</Btn>
        </Form>
      </div>
    </div>
  </main>
</template>

<script>
import EditorInput from '@/components/general/EditorInput.vue'
import Btn from '@/components/general/Btn.vue'
import Form from '@/components/general/Form.vue'
import Auth from '@/services/Auth.js'
import { mapStores } from 'pinia'
import { useAuthStore } from '@/store/Auth.js'

export default {
  components: { EditorInput, Btn, Form },
  data() {
    return {
      userData: {
        email: '',
        name: '',
        slug: '',
        password: ''
      },
      isLoading: false
    }
  },
  computed: {
    ...mapStores(useAuthStore)
  },
  methods: {
    async updateProfile() {
      const response = await Auth.updateUser(
        this.userData,
        this.authStore.user.id
      )
      this.$router.push({ name: 'my-profile' })
    }
  }
}
</script>
