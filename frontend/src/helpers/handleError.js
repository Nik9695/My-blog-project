import { useErrorStore } from '@/store/Error.js'
import { notify } from '@kyvg/vue3-notification'

export default (error) => {
  const errorStore = useErrorStore()

  if (error.response?.status == 422) {
    errorStore.setErrors(error.response.data.errors)
    notify({ type: 'error', text: error.response.data.message })
  } else if (error.response?.status === 403) {
    errorStore.setErrors(error.response.data)
    notify({ type: 'error', text: error.response.data.message })
  }
}
