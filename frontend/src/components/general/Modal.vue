<template>
  <div class="modal">
    <div class="modal__inner">
      <div class="modal__inner-title">{{ title }}</div>
      <div class="modal__inner-close" @click="modalStore.closeModal()">x</div>
      <div class="modal__inner-content">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
import { mapStores } from 'pinia'
import { useModalStore } from '@/store/Modal.js'

export default {
  props: {
    title: {
      type: String,
      required: true
    }
  },
  computed: {
    ...mapStores(useModalStore)
  }
}
</script>
