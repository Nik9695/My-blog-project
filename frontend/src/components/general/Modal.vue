<template>
  <div class="modal">
    <div class="modal__inner">
      <div class="model__inner-title">
        {{ this.title }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: ' '
    }
  }
}
</script>
