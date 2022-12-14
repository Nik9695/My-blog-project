import Http from './Http'
export default {
  async getAll(
    orderBy = 'created_at',
    sortedBy = 'desc',
    perPage = 10,
    page = 1,
    categorySlug = null
  ) {
    let query = `/articles?direction=${sortedBy}&ordering=${orderBy}&per_page=${perPage}&page=${page}`

    if (categorySlug) {
      query += `&category=${categorySlug}`
    }

    return await Http.get(query)
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
  },

  async updateArticleBackground(articleData, articleId) {
    const formData = new FormData()

    Object.keys(articleData).forEach((key) => {
      formData.append(key, articleData[key])
    })

    formData.append('_method', 'PATCH')

    return await Http.post(`/articles/${articleId}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  }
}
