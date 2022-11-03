import Http from './Http'

export default {
  async create(articleId, commentContent) {
    await Http.post(`/comments`, {
      article_id: articleId,
      content: commentContent
    })
  }
}
