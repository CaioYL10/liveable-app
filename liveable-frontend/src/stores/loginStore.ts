/* eslint-disable @typescript-eslint/no-explicit-any */
import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

interface Usuario {
  id: number
  nome: string
  email: string
}

export const useLoginStore = defineStore('login', () => {
  const usuario = ref<Usuario | null>(null)
  const token = ref<string | null>(localStorage.getItem('token'))
  const loading = ref(false)
  const erro = ref<string | null>(null)

  const estaLogado = computed(() => !!token.value)

  async function login(email: string, senha: string) {
    loading.value = true
    erro.value = null
    try {
      const res = await fetch('/api/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password: senha })
      })
      if (!res.ok) throw new Error('Email ou senha incorretos')
      const data = await res.json()
      token.value = data.token
      usuario.value = data.user
      localStorage.setItem('token', data.token)
    } catch (e: any) {
      erro.value = e.message
    } finally {
      loading.value = false
    }
  }

  function logout() {
    token.value = null
    usuario.value = null
    localStorage.removeItem('token')
  }

  return { usuario, token, loading, erro, estaLogado, login, logout }
})
