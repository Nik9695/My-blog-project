import Http from './Http'

export default {
  async getAll() {
    return await Http.get('/articles')
  },

  async byUserId(id) {
    return await Http.get(`/users/${id}/articles`)
  },

  async show(id) {
    return await Http.get(`/articles/${id}`)
  },

  async create(articleData) {
    return await Http.post(`/articles`, articleData)
  },

  async update(articleData, articleId) {
    return await Http.put(`/articles/${articleId}`, articleData)
  }
}
