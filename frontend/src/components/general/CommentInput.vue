<template>
  <div class="comments__inputWrapper">
    <img :src="avatar_path" class="comment__area-author-photo" />
    <input
      v-model="inputValue"
      class="comment__inputForm"
      :type="type"
      :name="name"
      :placeholder="placeholder"
    />
  </div>
</template>

<script>
import { mapStores } from 'pinia'
import { useErrorStore } from '@/store/Error.js'

export default {
  props: {
    modelValue: {
      type: String,
      required: true
    },
    name: {
      type: String,
      required: true
    },

    type: {
      type: String,
      default: 'text'
    },
    placeholder: {
      type: String,
      default: 'text'
    },
    avatar_path: {
      type: String,
      required: true
    }
  },
  computed: {
    inputValue: {
      get() {
        return this.modelValue
      },
      set(value) {
        this.$emit('update:modelValue', value)
      }
    },
    ...mapStores(useErrorStore)
  }
}
</script>
