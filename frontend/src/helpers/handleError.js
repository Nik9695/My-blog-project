import { useErrorStore } from '@/store/Error.js'

export default (error) => {
  const errorStore = useErrorStore()

  if (error.response?.status == 422) {
    errorStore.setErrors(error.response.data.errors)
  } else if (error.response?.status === 403) {
    errorStore.setErrors(error.response.data)
  }
}
