<template>
  <li class="category">
    <a href="#" :class="class">{{ category.name }}</a>
  </li>
</template>

<script>
export default {
  name: 'CategoryCard',
  props: {
    category: {
      type: Object,
      required: false
    },
    class: {
      type: String,
      default: 'category__link-onCard'
    }
  }
}
</script>
