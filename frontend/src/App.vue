<script setup>
import { RouterLink, RouterView } from 'vue-router'
import AppHeader from './components/general/AppHeader.vue'
import AppFooter from './components/general/AppFooter.vue'
</script>

<template>
  <AppHeader />
  <RouterView />
  <AppFooter />
</template>

<style lang="scss">
@import 'assets/scss/main.scss';
</style>
