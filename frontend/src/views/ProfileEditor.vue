<template>
  <main>
    <ProfileCard
      :name="authStore.user.name"
      :email="authStore.user.email"
      :link="'/my-profile'"
      :linkLabel="'Back to profile'"
    />

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
          <Btn
            type="submit"
            :isLoading="slotProps.isLoading"
            class="btn__editor-page"
            >Update</Btn
          >
        </Form>
      </div>
    </div>
  </main>
</template>

<script>
import EditorInput from '@/components/general/EditorInput.vue'
import Btn from '@/components/general/Btn.vue'
import Form from '@/components/general/Form.vue'
import ProfileCard from '@/components/general/ProfileCard.vue'

import Auth from '@/services/Auth.js'
import { mapStores } from 'pinia'
import { useAuthStore } from '@/store/Auth.js'

export default {
  components: { EditorInput, Btn, Form, ProfileCard },
  data() {
    return {
      userData: {
        email: '',
        name: '',
        slug: '',
        password: ''
        //repeatedPassword: ''
      },
      isLoading: false
    }
  },
  computed: {
    ...mapStores(useAuthStore)
  },
  methods: {
    async updateProfile() {
      /*       if (this.userData.password != this.userData.repeatedPassword) {
        response = error.status(403)
        console.log(response)
        return response
      } */
      this.isLoading = true
      const response = await Auth.updateUser(
        this.userData,
        this.authStore.user.id
      )
      this.$router.go({ name: 'my-profile' })
    }
  }
}
</script>
