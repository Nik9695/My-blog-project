<template>
  <div>
    <li
      class="header__nav-item--register"
      @click.prevent="modalIsOpened = true"
    >
      <a href="#" class="header__nav-item-link--register">Sign up</a>
    </li>

    <Modal v-if="modalIsOpened" @close="modalIsOpened = false" title="Sign up">
      <form @submit.prevent="registerUser" class="register">
        <div class="register__success" v-if="!hasErrors">
          You were registered successfully!
        </div>
        <div class="register__inputWrapper">
          <div class="register__error" v-if="errors.name">
            {{ errors.name[0] }}
          </div>
          <label for="name" class="register__label">Name</label>
          <input
            v-model="userData.name"
            type="text"
            class="register__input"
            name="name"
            :class="{ 'register__input--error': errors.name }"
          />
        </div>

        <div class="register__inputWrapper">
          <label for="name" class="register__label">Username</label>
          <div class="register__error" v-if="errors.slug">
            {{ errors.slug[0] }}
          </div>
          <input
            type="text"
            class="register__input"
            name="slug"
            v-model="userData.slug"
            :class="{ 'register__input--error': errors.slug }"
          />
        </div>

        <div class="register__inputWrapper">
          <label for="email" class="register__label">Email</label>
          <div class="register__error" v-if="errors.email">
            {{ errors.email[0] }}
          </div>
          <input
            type="text"
            class="register__input"
            name="email"
            v-model="userData.email"
            :class="{ 'register__input--error': errors.email }"
          />
        </div>

        <label for="text" class="register__label">Password</label>
        <div class="register__error" v-if="errors.password">
          {{ errors.password[0] }}
        </div>

        <div class="register__inputWrapper-with-addons">
          <div class="register__password">
            <input
              v-if="passwordHidden"
              type="password"
              class="register__input"
              name="password"
              v-model="userData.password"
              :class="{ 'register__input--error': errors.password }"
            />
            <input
              v-else
              type="text"
              class="register__input"
              name="password"
              v-model="userData.password"
              :class="{ 'register__input--error': errors.password }"
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

        <Btn type="submit" :isLoading="isLoading">Sign up</Btn>
      </form>
    </Modal>
  </div>
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
        slug: '',
        email: '',
        password: ''
      },
      errors: {}
    }
  },
  methods: {
    async registerUser() {
      this.errors = []
      this.isLoading = true
      axios
        .post('http://localhost:8000/api/register', {
          name: this.userData.name,
          slug: this.userData.slug,
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
          if (error.response?.status == 422) {
            this.errors = error.response.data.errors
          }
          //this.registrationPassed = false

          setTimeout(() => {
            this.isLoading = false
            //this.modalIsOpened = true
          }, 1000)
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
      } catch (error) {
        console.log(error)
      }
    }
  },
  computed: {
    hasErrors() {
      return Object.keys(this.errors).length
    }
  }
}
</script>
