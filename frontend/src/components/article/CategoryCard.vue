<template>
  <div>
    <li class="category">
      <a href="#" class="category__link">{{ getCategoryName }}</a>
    </li>
  </div>
</template>

<script>
export default {
  name: 'CategoryCard',
  props: {
    category: {
      type: Object,
      required: false
    }
  },
  /*   methods: {
    getCategoryName() {
      return this.category.name
    }
  }, */

  computed: {
    getCategoryName() {
      return this.category.name
    }
  }
}
</script>
