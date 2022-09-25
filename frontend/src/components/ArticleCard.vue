<template>
  <article class="article">
    <RouterLink to="/" class="article__link">
      <ul class="article__categories">
        <li class="article__category">
          <a href="#" class="article__category-link">Category</a>
        </li>
      </ul>
      <img
        src="https://loremflickr.com/420/350"
        alt="Title"
        class="article__image"
      />
      <div class="article__content">
        <time class="article__time">10:00</time>
        <h3 class="article__heading">
          Richird Norton photorealistic rendering as real photos
        </h3>
        <p class="article__text">
          Progressively incentivize cooperative systems through technically
          sound functionalities. The credibly productivate seamless data.
        </p>
      </div>
    </RouterLink>
  </article>
</template>

<script>
export default {
  name: 'ArticleCard'
}
</script>
