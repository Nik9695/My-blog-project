<template>
  <main>
    <AppHeader />
    <RouterView :key="$route.fullPath" />
    <AppFooter />
    <Login />
    <Register />
    <notifications position="bottom right" />
  </main>
</template>

<script>
import { RouterView } from 'vue-router'
import AppHeader from '@/components/layout/AppHeader.vue'
import AppFooter from '@/components/layout/AppFooter.vue'
import Login from '@/components/authentication/Login.vue'
import Register from '@/components/authentication/Register.vue'

export default {
  name: 'App',
  components: { RouterView, AppHeader, AppFooter, Login, Register },

  data() {
    return {
      isHide: true
    }
  }
}
</script>

<style lang="scss">
@import 'assets/scss/main.scss';
</style>
