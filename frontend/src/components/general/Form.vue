<template>
  <form :class="class" @submit.prevent="handleRequest">
    <slot :isLoading="isLoading"></slot>
  </form>
</template>

<script>
import handleError from '@/helpers/handleError.js'
import { mapStores } from 'pinia'
import { useErrorStore } from '@/store/Error.js'

export default {
  data() {
    return {
      isLoading: false
    }
  },
  props: {
    handleCallback: {
      type: Function,
      required: true
    },
    data: {
      type: Object,
      required: true
    },
    class: {
      type: String,
      default: 'form'
    }
  },
  computed: {
    dataComputed() {
      return Object.assign({}, this.data)
    },
    ...mapStores(useErrorStore)
  },
  watch: {
    dataComputed: {
      handler(newValue, oldValue) {
        if (!oldValue) {
          return
        }

        Object.keys(newValue).forEach((key) => {
          if (newValue[key] !== oldValue[key]) {
            this.errorStore.deleteErrors(key)
          }
        })
      },
      deep: true
    }
  },

  methods: {
    async handleRequest() {
      this.isLoading = true
      try {
        await this.handleCallback()
      } catch (error) {
        handleError(error)
        this.isLoading = false
      }
      this.isLoading = false
    },
    showPassword() {
      this.passwordHidden = !this.passwordHidden
    }
  }
}
</script>
