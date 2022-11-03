<template>
  <div class="section__categories">
    <ul class="section__categories-list">
      <li
        class="section__categories-item"
        v-for="category in categories"
        :key="category.id"
      >
        <RouterLink
          :to="{ name: 'categoryArticles', params: { slug: category.slug } }"
          :class="{
            'section__categories-link--active':
              category.slug === $route.params.slug
          }"
          class="section__categories-link"
          >{{ category.name }}</RouterLink
        >
      </li>
      <li class="section__categories-item section__categories-item--last">
        <RouterLink
          :to="{ name: 'categoryArticles', params: { slug: 'all' } }"
          :class="{
            'section__categories-link--active': 'all' === $route.params.slug
          }"
          class="section__categories-link"
          >View all</RouterLink
        >
      </li>
    </ul>
  </div>
</template>

<script>
import handleError from '@/helpers/handleError.js'
import Category from '@/services/Category.js'

export default {
  data() {
    return {
      categories: []
    }
  },
  created() {
    Category.getAll()
      .then((response) => {
        this.categories = response.data.data
      })
      .catch((error) => {
        handleError(error)
      })
  }
}
</script>
