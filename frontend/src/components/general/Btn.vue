<template>
  <button class="btn" :type="type" :disabled="isLoading">
    <slot></slot>
    <div v-if="isLoading" class="btn__loader"></div>
  </button>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      required: true
    },
    isLoading: {
      type: Boolean,
      default: false
    }
  }
}
</script>
