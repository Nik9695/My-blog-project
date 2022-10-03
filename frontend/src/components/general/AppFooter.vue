<script setup>
import { RouterLink } from 'vue-router'
</script>

<template>
  <footer class="footer">
    <div class="footer__upper">
      <div class="footer__inner footer__inner--grid">
        <div class="footer__section">
          <h4 class="footer__section-title">Title</h4>
          <ul class="footer__section-list">
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
          </ul>
        </div>
        <div class="footer__section">
          <h4 class="footer__section-title">Title</h4>
          <ul class="footer__section-list">
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
          </ul>
        </div>
        <div class="footer__section">
          <h4 class="footer__section-title">Title</h4>
          <ul class="footer__section-list">
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
          </ul>
        </div>
        <div class="footer__section">
          <h4 class="footer__section-title">Title</h4>
          <ul class="footer__section-list">
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
            </li>
            <li class="footer__section-item">
              <RouterLink to="/" class="footer__section-link">Link</RouterLink>
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
export default {
  name: 'AppFooter'
}
</script>
