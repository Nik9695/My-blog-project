<template>
  <footer class="footer">
    <div class="footer__upper">
      <div class="footer__inner footer__inner--grid">
        <div class="footer__section">
          <h4 class="footer__section-title">Authorization</h4>
          <ul class="footer__section-list">
            <li class="footer__section-item">
              <a
                class="footer__section-link"
                href="#"
                @click.prevent="modalStore.openModal('login')"
              >
                Log in</a
              >
            </li>
            <li class="footer__section-item">
              <a
                class="footer__section-link"
                href="#"
                @click.prevent="modalStore.openModal('register')"
              >
                Sign up</a
              >
            </li>
          </ul>
        </div>
        <div class="footer__section">
          <h4 class="footer__section-title">Explorate</h4>
          <ul class="footer__section-list">
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">About</RouterLink>
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link"
                >Partners</RouterLink
              >
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link"
                >Job Opportunities</RouterLink
              >
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link"
                >Advertise</RouterLink
              >
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link"
                >Membership</RouterLink
              >
            </li>
          </ul>
        </div>
        <div class="footer__section">
          <h4 class="footer__section-title">Headquarter</h4>
          <ul class="footer__section-list">
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link"
                >191 Middleville Road, NY 1001, Sydney Australia</RouterLink
              >
            </li>
          </ul>
        </div>
        <div class="footer__section">
          <h4 class="footer__section-title">Headquarter</h4>
          <ul class="footer__section-list">
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link"
                >191 Middleville Road, NY 1001, Sydney Australia</RouterLink
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer__bottom">
      <div class="footer__inner footer__inner--bottom">
        <p class="footer__bottom-text footer__bottom-text--copyright">
          2021 | RUNO Publisher Studio
        </p>
        <p class="footer__bottom-text footer__bottom-text--subscribe">
          Subscribe
        </p>
      </div>
    </div>
  </footer>
</template>

<script>
import { mapStores } from 'pinia'
import { useModalStore } from '@/store/Modal.js'

export default {
  name: 'AppFooter',
  computed: {
    ...mapStores(useModalStore)
  }
}
</script>
