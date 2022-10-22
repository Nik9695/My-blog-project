<template>
  <Modal v-if="modalStore.activeModal === 'login'" title="Login">
    <Form :handleCallback="loginUser" :data="credentials" v-slot="slotProps">
      <Input
        v-model="credentials.email"
        name="email"
        lable="Email"
        type="email"
        placeholder="enter.your@email.com"
      />
      <div class="inputForm__inputWrapper-with-addons">
        <div class="inputForm__password">
          <Input
            v-if="passwordHidden"
            v-model="credentials.password"
            name="password"
            lable="Password"
            type="password"
            placeholder="Enter your password"
          />
          <Input
            v-if="!passwordHidden"
            v-model="credentials.password"
            name="password"
            lable="Password"
            placeholder="Enter your password"
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

      <Btn type="submit" :isLoading="slotProps.isLoading">Login</Btn>
      <a
        class="modal__switcher"
        href="#"
        @click.prevent="modalStore.openModal('register')"
      >
        Not on LevelUp blog yet? Sign up</a
      >
    </Form>
  </Modal>
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
  name: 'Login',
  components: { Modal, Btn, Input, Form },

  data() {
    return {
      invalidCredentials: false,
      isLoading: false,
      passwordHidden: true,
      credentials: {
        email: 'test@example.com',
        password: 'password'
      }
    }
  },
  computed: {
    ...mapStores(useModalStore)
  },

  methods: {
    async loginUser() {
      this.invalidCredentials = false

      const response = await Auth.loginUser(this.credentials)
      localStorage.setItem('token', response.data)
      this.isLoading = false
      this.modalStore.closeModal()
      this.$router.push({ name: `my-profile` })
    },
    showPassword() {
      this.passwordHidden = !this.passwordHidden
    }
  }
}
</script>
