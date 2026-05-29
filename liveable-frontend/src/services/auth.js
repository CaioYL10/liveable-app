const TOKEN_KEY = 'token'

// Salva o token
export function setToken(token) {
  localStorage.setItem(TOKEN_KEY, token)
}

// Pega o token
export function getToken() {
  return localStorage.getItem(TOKEN_KEY)
}

// Remove o token (logout)
export function removeToken() {
  localStorage.removeItem(TOKEN_KEY)
}

// Verifica se está logado
export function isAuthenticated() {
  return !!getToken()
}
