import Http from './Http'

export default {
  async getAll() {
    return await Http.get(`/categories`)
  },
  async bySlug(slug) {
    return await Http.get(`/categories/${slug}`)
  }
}
