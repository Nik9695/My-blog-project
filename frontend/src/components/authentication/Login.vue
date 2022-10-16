<template>
  <Modal v-if="modalStore.activeModal === 'login'" title="Login">
    <form @submit.prevent="loginUser" class="inputForm">
      <Input
        v-model="credentials.email"
        name="email"
        lable="Email"
        type="email"
        placeholder="enter.your@email.com"
        :errors="errors"
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
            :errors="errors"
          />
          <Input
            v-if="!passwordHidden"
            v-model="credentials.password"
            name="password"
            lable="Password"
            placeholder="Enter your password"
            :errors="errors"
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

      <Btn type="submit" :isLoading="isLoading">Login</Btn>
      <a
        class="modal__switcher"
        href="#"
        @click.prevent="modalStore.openModal('register')"
      >
        Not on LevelUp blog yet? Sign up</a
      >
    </form>
  </Modal>
</template>

<script>
import Modal from '../general/Modal.vue'
import Btn from '../general/Btn.vue'
import Input from '../general/Input.vue'
import Auth from '@/services/Auth.js'
import { mapStores } from 'pinia'
import { useModalStore } from '@/store/Modal.js'

export default {
  name: 'Login',
  components: { Modal, Btn, Input },

  data() {
    return {
      invalidCredentials: false,
      isLoading: false,
      passwordHidden: true,
      credentials: {
        email: 'test@example.com',
        password: 'password'
      },
      errors: {}
    }
  },
  computed: {
    ...mapStores(useModalStore),
    cridentialsComputed() {
      return Object.assign({}, this.credentials)
    }
  },
  watch: {
    cridentialsComputed: {
      handler(newValue, oldValue) {
        if (!oldValue) {
          return
        }

        Object.keys(newValue).forEach((key) => {
          if (newValue[key] !== oldValue[key]) {
            this.errors[key] = null
          }
        })
      },
      deep: true
    }
  },
  methods: {
    loginUser() {
      this.errors = []
      this.isLoading = true
      this.invalidCredentials = false

      Auth.loginUser(this.credentials)
        .then((response) => {
          localStorage.setItem('token', response.data)

          setTimeout(() => {
            this.isLoading = false
            this.modalStore.closeModal()
            this.$router.push({ name: `my-profile` })
          }, 1000)
        })
        .catch((error) => {
          if (error.response?.status === 403) {
            this.errors = error.response.data
            console.log(this.errors)
          } else if (error.response?.status == 422) {
            this.errors = error.response.data.errors
          }
          setTimeout(() => {
            this.isLoading = false
          }, 1000)
        })
    },
    showPassword() {
      this.passwordHidden = !this.passwordHidden
    }
  }
}
</script>
