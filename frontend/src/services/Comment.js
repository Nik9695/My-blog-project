import Http from './Http'

export default {
  async getAll(articleId = null, perPage = 5, page = 1) {
    let query = `/articles/${articleId}/comments?per_page=${perPage}&page=${page}`
    return await Http.get(query)
  },

  async create(articleId, commentContent) {
    return await Http.post(`/comments`, {
      article_id: articleId,
      content: commentContent
    })
  }
}
