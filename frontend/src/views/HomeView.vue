<template>
  <main>
    <div class="section">
      <MainArticle />
      <div class="section__inner">
        <h2 class="section__heading">Popular topics</h2>

        <div class="section__categories">
          <ul class="section__categories-list">
            <li class="section__categories-item">
              <RouterLink to="/" class="section__categories-link--active"
                >All</RouterLink
              >
            </li>
            <li class="section__categories-item">
              <RouterLink to="/" class="section__categories-link"
                >Adventure</RouterLink
              >
            </li>
            <li class="section__categories-item">
              <RouterLink to="/" class="section__categories-link"
                >Travel</RouterLink
              >
            </li>
            <li class="section__categories-item">
              <RouterLink to="/" class="section__categories-link"
                >Fashion</RouterLink
              >
            </li>
            <li class="section__categories-item">
              <RouterLink to="/" class="section__categories-link"
                >Technology</RouterLink
              >
            </li>
            <li class="section__categories-item">
              <RouterLink to="/" class="section__categories-link"
                >Branding</RouterLink
              >
            </li>
            <li class="section__categories-item section__categories-item--last">
              <RouterLink to="/" class="section__categories-link--last"
                >View all</RouterLink
              >
            </li>
          </ul>
        </div>

        <div class="section__articles-cascade">
          <ArticleItemCard v-for="i in 8" :key="i" />
        </div>
      </div>
    </div>

    <div class="section">
      <div class="section__inner">
        <h2 class="section__heading">Editor's pick</h2>

        <div class="section__articles">
          <ArticleCard v-for="i in 3" :key="i" />
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import MainArticle from '../components/MainArticle.vue'
import ArticleItemCard from '../components/ArticleItemCard.vue'
import ArticleCard from '../components/ArticleCard.vue'
</script>
