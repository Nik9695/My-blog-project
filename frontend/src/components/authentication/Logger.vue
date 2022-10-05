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
      <div class="login__error" v-if="invalidCredentials">
        Wrong email or password
      </div>
      <div class="login__inputWrapper">
        <label for="email" class="login__label">Email </label>
        <input
          type="text"
          class="login__input"
          name="email"
          v-model="credentials.email"
        />
      </div>
      <label for="text" class="login__label">Password </label>

      <div class="login__inputWrapper-with-addons">
        <div class="login__password">
          <input
            v-if="passwordHidden"
            type="password"
            class="login__input"
            name="password"
            v-model="credentials.password"
          />
          <input
            v-else
            type="text"
            class="login__input"
            name="password"
            v-model="credentials.password"
          />
        </div>
        <div class="login__password-security">
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
import axios from 'axios'
export default {
  name: 'Logger',
  components: { Modal, Btn },

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
    async loginUser() {
      this.isLoading = true
      this.invalidCredentials = false
      try {
        const response = await axios.post(
          'http://localhost:8000/api/authenticate',
          this.credentials,
          {
            headers: {
              accept: 'application/json'
            }
          }
        )
        localStorage.setItem('token', response.data)
        this.$router.push({ name: `my-profile` })
        this.modalIsOpened = false
      } catch (error) {
        if (error.response?.status === 403) {
          this.invalidCredentials = true
        }
        console.log(error)
      }
      this.isLoading = false
    },
    showPassword() {
      this.passwordHidden = !this.passwordHidden
    }
  }
}
</script>
