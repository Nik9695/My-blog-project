import Http from './Http'

export default {
  async loginUser(credentials) {
    return await Http.post('/authenticate', credentials)
  },

  async registerUser(userData) {
    return await Http.post('/register', userData)
  },

  async me() {
    return await Http.get('/user')
  }
}
