<template>
  <div class="modal">
    <div class="modal__inner">
      <div class="modal__inner-title">{{ title }}</div>
      <div class="modal__inner-close" @click="close">x</div>
      <div class="modal__inner-content">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    }
  },
  methods: {
    close() {
      console.log('close from Modal')
      this.$emit('close')
    }
  }
}
</script>
