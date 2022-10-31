<template>
  <div>
    <Modal v-if="modalStore.activeModal === 'register'" title="Sign up">
      <Form :handleCallback="registerUser" :data="userData" v-slot="slotProps">
        <Input
          v-model="userData.name"
          name="name"
          lable="Name"
          placeholder="Enter your name"
        />

        <Input
          v-model="userData.slug"
          name="slug"
          lable="Username"
          placeholder="Enter your username"
        />

        <Input
          v-model="userData.email"
          name="email"
          lable="Email"
          type="email"
          placeholder="enter.your@email.com"
        />

        <div class="inputForm__inputWrapper-with-addons">
          <div class="inputForm__password">
            <Input
              v-if="passwordHidden"
              v-model="userData.password"
              name="password"
              lable="Password"
              type="password"
              placeholder="Enter at least 8 symbols"
            />
            <Input
              v-if="!passwordHidden"
              v-model="userData.password"
              name="password"
              lable="Password"
              placeholder="Enter at least 8 symbols"
            />
          </div>

          <div class="inputForm__password-security">
            <button class="btn__showPassword" @click.prevent="showPassword">
              <span class="btn__showPassword-small-right">
                <i
                  class="fas"
                  :class="{
                    'fa-eye-slash': passwordHidden,
                    'fa-eye': !passwordHidden
                  }"
                ></i>
              </span>
            </button>
          </div>
        </div>

        <Btn type="submit" :isLoading="slotProps.isLoading" class="btn"
          >Sign up</Btn
        >
        <a
          class="modal__switcher"
          href="#"
          @click.prevent="modalStore.openModal('login')"
        >
          Already a member? Log in</a
        >
      </Form>
    </Modal>
  </div>
</template>

<script>
import Modal from '../general/Modal.vue'
import Btn from '../general/Btn.vue'
import Input from '../general/Input.vue'
import Auth from '@/services/Auth.js'
import Form from '@/components/general/Form.vue'
import { mapStores } from 'pinia'
import { useModalStore } from '@/store/Modal.js'

export default {
  name: 'Register',
  components: { Modal, Btn, Input, Form },
  data() {
    return {
      isLoading: false,
      passwordHidden: true,
      userData: {
        name: '',
        slug: '',
        email: '',
        password: ''
      }
    }
  },
  computed: {
    ...mapStores(useModalStore)
  },

  methods: {
    async registerUser() {
      const response = await Auth.registerUser(this.userData)
      localStorage.setItem('token', response.data.token)
      this.$router.push({ name: 'my-profile' })
      this.$notify({
        type: 'success',
        text: 'Registration passed successfully!'
      })
      this.modalStore.closeModal()
    },
    showPassword() {
      this.passwordHidden = !this.passwordHidden
    }
  }
}
</script>
