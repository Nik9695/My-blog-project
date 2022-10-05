<template>
  <div class="article__item">
    <div class="article__item-top">
      <img
        src="https://loremflickr.com/420/350"
        alt=""
        class="article__item-image"
      />
      <ul class="article__categories">
        <CategoryCard />
      </ul>
    </div>
    <div class="article__item-bottom">
      <time class="article__item-bottom-date">08.08.2021</time>
      <h3 class="article__item-bottom-title">
        <RouterLink to="/" class="article__item-bottom-titleLink"
          >Richird Norton photorealistic rendering as real photos</RouterLink
        >
      </h3>
      <p class="article__item-bottom-text">
        Progressively incentivize cooperative systems through technically sound
        functionalities. The credibly productivate seamless data.
      </p>
      <div class="article__area-author-info">
        <img
          src="@/assets/images/authorImage.jpg"
          class="article__area-author-photo"
        />
        <div class="article__area-author-content">
          <div class="article__area-author-name">By Jennifer Lawrence</div>
          <div class="article__area-author-title">Thinker & Designer</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CategoryCard from './CategoryCard.vue'
export default {
  name: 'ArticleItemCard',
  components: { CategoryCard }
}
</script>
