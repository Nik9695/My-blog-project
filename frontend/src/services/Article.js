import Http from './Http'

export default {
  async getAll() {
    return await Http.get('/articles')
  },

  async byUserId(id) {
    return await Http.get(`/users/${id}/articles`)
  }
}
