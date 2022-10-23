<template>
  <button :class="buttonClass" :type="type" :disabled="isLoading">
    <slot></slot>
    <span v-if="isLoading" class="btn__loader"></span>
  </button>
</template>

<script>
export default {
  name: 'Btn',
  props: {
    type: {
      type: String,
      required: true
    },
    isLoading: {
      type: Boolean,
      default: false
    },
    buttonClass: {
      type: String,
      default: ''
    }
  }
}
</script>
