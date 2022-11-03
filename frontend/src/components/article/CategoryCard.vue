<template>
  <div>
    <li class="category">
      <a href="#" class="category__link">{{ category.name }}</a>
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
  }
}
</script>
