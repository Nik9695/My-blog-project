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
        <p class="footer__bottom-text footer__bottom-text--copyright">2021 | RUNO Publisher Studio</p>
        <p class="footer__bottom-text  footer__bottom-text--subscribe">Subscribe</p>
      </div>
    </div>
  </footer>
</template>

<style lang="scss">
@import 'assets/scss/main.scss';
</style>
