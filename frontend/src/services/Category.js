import Http from './Http'

export default {
  async getAll() {
    return await Http.get(`/categories`)
  },
  async show(slug) {
    return await Http.get(`/categories/${slug}`)
  },
  async create(articleData) {
    return await Http.post('/categories', articleData)
  },
  async edit(slug, articleData) {
    return await Http.patch(`/categories/${slug}`, articleData)
  }
}
