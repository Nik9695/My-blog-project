import { useErrorStore } from '@/store/Error.js'
import { notify } from '@kyvg/vue3-notification'

export default (errorResponse) => {
  const errorStore = useErrorStore()

  if (errorResponse.response?.status == 422) {
    errorStore.setErrors(errorResponse.response.data.errors)
    notify({ type: 'error', text: errorResponse.response.data.message })
  } else if (errorResponse.response?.status === 403) {
    errorStore.setErrors(errorResponse.response.data)
    notify({ type: 'error', text: errorResponse.response.data.message })
  } else if (errorResponse.response?.status === 401) {
    errorStore.setErrors(errorResponse.response.data)
    notify({ type: 'error', text: 'You are unauthorized for this action.' })
  } else if (errorResponse.response?.status === 500) {
    errorStore.setErrors(errorResponse.response.data)
    notify({ type: 'error', text: errorResponse.response.data.message })
  }
}
