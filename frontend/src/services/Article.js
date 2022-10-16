import Http from './Http'

export default {
  async getAll() {
    return await Http.get('/articles')
  },

  async bySlug(slug) {
    return await Http.get(`/users/${slug}/articles`)
  }
}
