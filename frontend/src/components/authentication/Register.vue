<template>
  <div>
    <Modal v-if="modalStore.activeModal === 'register'" title="Sign up">
      <form @submit.prevent="registerUser" class="inputForm">
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

        <Btn type="submit" :isLoading="isLoading">Sign up</Btn>
        <a
          class="modal__switcher"
          href="#"
          @click.prevent="modalStore.openModal('login')"
        >
          Already a member? Log in</a
        >
      </form>
    </Modal>
  </div>
</template>

<script>
import Modal from '../general/Modal.vue'
import Btn from '../general/Btn.vue'
import Input from '../general/Input.vue'
import Auth from '@/services/Auth.js'
import { mapStores } from 'pinia'
import { useModalStore } from '@/store/Modal.js'
import { useErrorStore } from '@/store/Error.js'

export default {
  name: 'Register',
  components: { Modal, Btn, Input },
  data() {
    return {
      registrationPassed: false,
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
    hasErrors() {
      return Object.keys(this.errors).length
    },
    userDataComputed() {
      return Object.assign({}, this.userData)
    },
    ...mapStores(useModalStore, useErrorStore)
  },
  watch: {
    userDataComputed: {
      handler(newValue, oldValue) {
        if (!oldValue) {
          return
        }

        Object.keys(newValue).forEach((key) => {
          if (newValue[key] !== oldValue[key]) {
            this.errorStore.deleteErrors(key)
          }
        })
      },
      deep: true
    }
  },
  methods: {
    async registerUser() {
      this.errorStore.clearErrors()
      this.isLoading = true

      Auth.registerUser(this.userData)
        .then((response) => {
          this.registrationPassed = true
          localStorage.setItem('token', response.data.token)
          this.$router.push({ name: `my-profile` })

          setTimeout(() => {
            this.isLoading = false
            this.modalStore.closeModal()
          }, 1000)
        })
        .catch((error) => {
          if (error.response?.status == 422) {
            this.errorStore.setErrors(error.response.data.errors)
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
