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

        <Input
          v-model="userData.name"
          name="name"
          lable="Name"
          placeholder="Enter your name"
          :errors="errors"
        />

        <Input
          v-model="userData.slug"
          name="slug"
          lable="Username"
          placeholder="Enter your username"
          :errors="errors"
        />

        <Input
          v-model="userData.email"
          name="email"
          lable="Email"
          type="email"
          placeholder="enter.your@email.com"
          :errors="errors"
        />
        <div class="register__inputWrapper-with-addons">
          <div class="register__password">
            <Input
              v-if="passwordHidden"
              v-model="userData.password"
              name="password"
              lable="Password"
              type="password"
              placeholder="Enter at least 8 symbols"
              :errors="errors"
            />
            <Input
              v-if="!passwordHidden"
              v-model="userData.password"
              name="password"
              lable="Password"
              placeholder="Enter at least 8 symbols"
              :errors="errors"
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
import Input from '../general/Input.vue'
import axios from 'axios'
export default {
  name: 'Register',
  components: { Modal, Btn, Input },
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
