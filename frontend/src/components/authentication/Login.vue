<template>
  <li class="header__nav-item">
    <a
      href="#"
      @click.prevent="modalIsOpened = true"
      class="header__nav-item-link"
      >Login</a
    >
  </li>
  <Modal v-if="modalIsOpened" @close="modalIsOpened = false" title="Login">
    <form @submit.prevent="loginUser" class="login">
      <Input
        v-model="credentials.email"
        name="email"
        lable="Email"
        type="email"
        placeholder="enter.your@email.com"
      />
      <div class="register__inputWrapper-with-addons">
        <div class="register__password">
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
        <div class="register__password-security">
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
    </form>
  </Modal>
</template>

<script>
import Modal from '../general/Modal.vue'
import Btn from '../general/Btn.vue'
import Input from '../general/Input.vue'
import axios from 'axios'
export default {
  name: 'Login',
  components: { Modal, Btn, Input },

  data() {
    return {
      modalIsOpened: false,
      invalidCredentials: false,
      isLoading: false,
      passwordHidden: true,
      credentials: {
        email: 'test@example.com',
        password: 'password'
      }
    }
  },
  methods: {
    loginUser() {
      this.isLoading = true
      this.invalidCredentials = false

      axios
        .post('http://localhost:8000/api/authenticate', this.credentials, {
          headers: {
            accept: 'application/json'
          }
        })
        .then((response) => {
          localStorage.setItem('token', response.data)

          setTimeout(() => {
            this.isLoading = false
            this.modalIsOpened = false
            this.$router.push({ name: `my-profile` })
          }, 1000)
        })
        .catch((error) => {
          if (error.response?.status === 403) {
            this.invalidCredentials = true
          }
          setTimeout(() => {
            this.isLoading = false
            this.modalIsOpened = true
          }, 1000)
        })
    },
    showPassword() {
      this.passwordHidden = !this.passwordHidden
    }
  }
}
</script>
