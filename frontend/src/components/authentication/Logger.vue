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
        <label for="email" class="login__inputWrapper-label">Email </label>
        <input
          type="text"
          class="login__inputWrapper-input"
          name="email"
          v-model="credentials.email"
        />
      </div>
      <div class="login__inputWrapper">
        <label for="password" class="login__inputWrapper-label"
          >Password
        </label>
        <input
          type="text"
          class="login__inputWrapper-input"
          name="password"
          v-model="credentials.password"
        />
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
      invalidCredentials: true,
      isLoading: false,
      credentials: {
        email: 'nik@gmail.com',
        password: '123'
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
      } catch (error) {
        if (error.response?.status === 403) {
          this.invalidCredentials = true
        }
        console.log(error)
      }
      this.isLoading = false
    }
  }
}
</script>
