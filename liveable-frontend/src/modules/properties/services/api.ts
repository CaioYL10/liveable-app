import axios from 'axios'

const api = axios.create({
  baseURL: 'https://liveable-app.onrender.com/api'
})

export default api
