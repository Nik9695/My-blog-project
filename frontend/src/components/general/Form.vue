<template>
  <form class="form" @submit.prevent="handleRequest">
    <slot :Loading="Loading"></slot>
  </form>
</template>

<script>
import { mapStores } from 'pinia'
import { useErrorStore } from '@/store/Error.js'

export default {
  data() {
    return {
      Loading: false
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
    }
  },
  computed: {
    ...mapStores(useErrorStore),
    dataComputed() {
      return Object.assign({}, this.data)
    }
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
      this.errorStore.clearErrors()
      this.isLoading = true

      try {
        await this.handleCallback()
      } catch (error) {
        if (error.response?.status == 422) {
          this.errorStore.setErrors(error.response.data.errors)
        }

        setTimeout(() => {
          this.isLoading = false
        }, 1000)
      }
    },
    showPassword() {
      this.passwordHidden = !this.passwordHidden
    }
  }
}
</script>
