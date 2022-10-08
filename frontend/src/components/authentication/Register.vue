<template>
  <li class="header__nav-item--register" @click.prevent="modalIsOpened = true">
    <a href="#" class="header__nav-item-link--register">Sign up</a>
  </li>

  <Modal v-if="modalIsOpened" @close="modalIsOpened = false" title="Sign up">
    <form @submit.prevent="registerUser" class="register">
      <div class="register__error" v-if="!registrationPassed">
        Please fill the form to sign up.
      </div>
      <div class="register__success" v-if="registrationPassed">
        You were registered successfully!
      </div>

      <div class="register__inputWrapper">
        <label for="name" class="register__label">Name</label>
        <input
          type="text"
          class="register__input"
          name="name"
          v-model="userData.name"
        />
      </div>
      <div class="register__inputWrapper">
        <label for="email" class="register__label">Email</label>
        <input
          type="text"
          class="register__input"
          name="email"
          v-model="userData.email"
        />
      </div>
      <label for="text" class="register__label">Password</label>

      <div class="register__inputWrapper-with-addons">
        <div class="register__password">
          <input
            v-if="passwordHidden"
            type="password"
            class="register__input"
            name="password"
            v-model="userData.password"
          />
          <input
            v-else
            type="text"
            class="register__input"
            name="password"
            v-model="userData.password"
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

      <Btn type="send" :isLoading="isLoading">Sign up</Btn>
    </form>
  </Modal>
</template>

<script>
import Modal from '../general/Modal.vue'
import Btn from '../general/Btn.vue'
import axios from 'axios'
export default {
  name: 'Register',
  components: { Modal, Btn },
  data() {
    return {
      modalIsOpened: false,
      registrationPassed: false,
      isLoading: false,
      passwordHidden: true,
      userData: {
        name: '',
        email: '',
        password: ''
      }
    }
  },
  methods: {
    async registerUser() {
      this.isLoading = true
      axios
        .post('http://localhost:8000/api/register', {
          name: this.userData.name,
          email: this.userData.email,
          password: this.userData.password
        })
        .then((response) => {
          this.registrationPassed = true
          this.loginAfterRegister()

          setTimeout(() => {
            this.isLoading = false
            this.modalIsOpened = false
          }, 2000)
        })
        .catch((error) => {
          this.registrationPassed = false
          setTimeout(() => {
            this.isLoading = false
            this.modalIsOpened = true
          }, 2000)

          console.log(error)
        })
    },
    showPassword() {
      this.passwordHidden = !this.passwordHidden
    },
    async loginAfterRegister() {
      try {
        const response = await axios.post(
          'http://localhost:8000/api/authenticate',
          {
            email: this.userData.email,
            password: this.userData.password
          },
          {
            headers: {
              accept: 'application/json'
            }
          }
        )
        localStorage.setItem('token', response.data)
        this.$router.push({ name: `my-profile` })
        this.$router.go()
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>
