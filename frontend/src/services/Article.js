import Http from './Http'

export default {
  async getAll(
    orderBy = 'created_at',
    sortedBy = 'desc',
    perPage = 10,
    page = 1
  ) {
    return await Http.get(
      `/articles?direction=${sortedBy}&ordering=${orderBy}&per_page=${perPage}&page=${page}`
    )
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
  },

  async delete(article, articleId) {
    return await Http.delete(`/articles/${articleId}`, article)
  }
}
