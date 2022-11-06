import Http from './Http'

export default {
  async loginUser(credentials) {
    return await Http.post('/authenticate', credentials)
  },

  async registerUser(userData) {
    return await Http.post('/registration', userData)
  },

  async me() {
    return await Http.get('/user')
  },

  async updateUser(userData, userId) {
    return await Http.put(`/users/${userId}`, userData)
  }
}
