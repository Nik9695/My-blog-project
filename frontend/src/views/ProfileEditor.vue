<template>
  <main>
    <ProfileCard :user="user" link="/my-profile" linkLabel="Back to profile" />
    <div class="section">
      <div class="section__inner section__inner--editor">
        <h2 class="editor__section-heading">Edit Profile</h2>

        <img
          class="myProfile__image myProfile__image--uploadImage"
          @click="showAvatarUpload = !showAvatarUpload"
          :src="user.avatar_path"
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
import myUpload from 'vue-image-crop-upload'

import Auth from '@/services/Auth.js'
import { mapStores } from 'pinia'
import { useAuthStore } from '@/store/Auth.js'

export default {
  components: { EditorInput, Btn, Form, ProfileCard, myUpload },
  data() {
    return {
      userData: {
        email: '',
        name: '',
        slug: '',
        password: ''
      },
      isLoading: false,
      showAvatarUpload: false
    }
  },
  computed: {
    ...mapStores(useAuthStore),

    user() {
      return this.authStore.user
    }
  },
  created() {
    Object.keys(this.userData).forEach((key) => {
      this.userData[key] = this.user[key]
    })
  },
  methods: {
    async updateProfile() {
      const response = await Auth.updateUser(this.userData, this.user.id)
      this.authStore.setUser(response.data)
      this.$notify({
        type: 'success',
        text: 'Profile updated successfully!'
      })
    },
    async cropSuccess(imgDataUrl, field) {
      this.userData.avatar = this.dataUrlToFile(imgDataUrl, field)
      const response = await Auth.updateUserAvatar(this.userData, this.user.id)
      this.authStore.setUser(response.data)
      this.$notify({
        type: 'success',
        text: 'Profile avatar updated successfully!'
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
