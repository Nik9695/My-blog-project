<script setup>
import {RouterLink, RouterView} from 'vue-router'
</script>

<template>
  <header class="header">
    <div class="header__inner">
      <h1 class="header__title">
        <a href="#" class="header__title-link">LevelUp Blog</a>
      </h1>
      <nav class="header__nav">
        <ul class="header__nav-list">
          <li class="header__nav-item"><a href="#" class="header__nav-item-link">Home</a></li>
          <li class="header__nav-item"><a href="#" class="header__nav-item-link">About</a></li>
          <li class="header__nav-item"><a href="#" class="header__nav-item-link">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <RouterView/>
</template>

<style lang="scss">
@import 'assets/scss/main.scss';
</style>
