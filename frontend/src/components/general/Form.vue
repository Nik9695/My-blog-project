<template>
  <form :class="class" @submit.prevent="handleRequest">
    <slot :isLoading="isLoading"></slot>
  </form>
</template>

<script>
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
        } else if (error.response?.status === 403) {
          this.errorStore.setErrors(error.response.data)
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
