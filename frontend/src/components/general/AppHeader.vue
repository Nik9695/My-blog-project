<script setup>
import { RouterLink } from 'vue-router'
</script>

<template>
  <header class="header">
    <div class="header__inner">
      <h1 class="header__title">
        <RouterLink to="/" class="header__title-link">LevelUp Blog</RouterLink>
      </h1>
      <nav class="header__nav">
        <ul class="header__nav-list">
          <li class="header__nav-item">
            <RouterLink to="/" class="header__nav-item-link">Home</RouterLink>
          </li>
          <li class="header__nav-item">
            <RouterLink to="/about" class="header__nav-item-link"
              >About</RouterLink
            >
          </li>
          <li class="header__nav-item">
            <a href="#" class="header__nav-item-link">Contact</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script>
export default {
  name: 'AppHeader'
}
</script>
