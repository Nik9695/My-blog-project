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
  },

  async updateUserAvatar(userData, userId) {
    const formData = new FormData()

    Object.keys(userData).forEach((key) => {
      formData.append(key, userData[key])
    })

    formData.append('_method', 'PATCH')

    return await Http.post(`/users/${userId}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  }
}
