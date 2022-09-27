<template>
  <article class="mainArticle">
    <div class="mainArticle__inner">
      <ul class="mainArticle__categories">
        <CategoryCard />
      </ul>
      <h2 class="mainArticle__heading">
        Richird Norton photorealistic rendering as real photos
      </h2>
      <p class="mainArticle__content">
        <time class="marinArticle__content-time">10:00</time>
        <span class="mainArticle__content-divider"></span>
        <span class="mainArticle__content-text"
          >Progressively incentivize cooperative systems through technically
          sound functionalities. The credibly productivate seamless data.</span
        >
      </p>
    </div>
  </article>
</template>

<script>
import CategoryCard from './CategoryCard.vue'
export default {
  name: 'MainArticle',
  components: { CategoryCard }
}
</script>
