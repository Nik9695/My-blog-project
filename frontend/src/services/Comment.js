import Http from './Http'

export default {
  async getAll(articleId) {
    await Http.get(`/articles/${articleId}/comments`)
  },

  async create(articleId, commentContent) {
    await Http.post(`/comments`, {
      article_id: articleId,
      content: commentContent
    })
  }
}
