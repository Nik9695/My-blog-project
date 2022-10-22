<template>
  <header class="header">
    <div class="header__inner">
      <h1 class="header__title">
        <RouterLink to="/" class="header__title-link">LevelUp Blog</RouterLink>
      </h1>
      <nav class="header__nav">
        <ul class="header__nav-list">
          <li class="header__nav-item">
            <RouterLink :to="{ name: `home` }" class="header__nav-item-link"
              >Home</RouterLink
            >
          </li>
          <li class="header__nav-item" v-if="authStore.isLoggedIn">
            <RouterLink
              :to="{ name: `my-profile` }"
              class="header__nav-item-link"
              >My profile</RouterLink
            >
          </li>
          <li class="header__nav-item" v-if="authStore.isLoggedIn">
            <a
              href="#"
              @click.prevent="authStore.logoutUser()"
              class="header__nav-item-link"
              >Log out</a
            >
          </li>
          <li class="header__nav-item" v-if="authStore.isGuest">
            <a
              class="header__nav-item-link"
              href="#"
              @click.prevent="modalStore.openModal('login')"
            >
              Log in</a
            >
          </li>
          <li class="header__nav-item--register" v-if="authStore.isGuest">
            <a
              class="header__nav-item-link--register"
              href="#"
              @click.prevent="modalStore.openModal('register')"
            >
              Sign up</a
            >
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script>
import { mapStores } from 'pinia'
import { useModalStore } from '@/store/Modal.js'
import { useAuthStore } from '@/store/Auth.js'

export default {
  name: 'AppHeader',
  computed: {
    ...mapStores(useModalStore, useAuthStore)
  }
}
</script>
