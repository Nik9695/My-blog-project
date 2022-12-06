<template>
  <div class="editor__inputForm-wrapper">
    <label :for="name" class="editor__inputForm-label">{{ lable }}</label>
    <input
      v-model="inputValue"
      :type="type"
      :name="name"
      :placeholder="placeholder"
      class="editor__inputForm-input"
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
    lable: {
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
    }
  },
  data() {
    return {}
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
