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
          <li class="header__nav-item">
            <RouterLink :to="{ name: `about` }" class="header__nav-item-link"
              >About</RouterLink
            >
          </li>
          <li class="header__nav-item">
            <a href="#" class="header__nav-item-link">Contact</a>
          </li>
          <li class="header__nav-item">
            <RouterLink
              :to="{ name: `my-profile` }"
              class="header__nav-item-link"
              >My profile</RouterLink
            >
          </li>
          <Logger />

          <Register />
        </ul>
      </nav>
    </div>
  </header>
</template>

<script>
import Logger from '@/components/authentication/Logger.vue'
import Register from '@/components/authentication/Register.vue'
export default {
  name: 'AppHeader',
  components: { Logger, Register }
}
</script>
