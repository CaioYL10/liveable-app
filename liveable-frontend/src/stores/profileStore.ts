/* eslint-disable @typescript-eslint/no-explicit-any */
import { defineStore } from 'pinia'
import { ref } from 'vue'
import { useLoginStore } from './loginStore'

interface Perfil {
  id: number
  nome: string
  email: string
  contact?: number
  foto?: string
  banner?: string
  favoriteProperties?: string
}

export const useProfileStore = defineStore('profile', () => {
  const perfil = ref<Perfil | null>(null)
  const loading = ref(false)
  const erro = ref<string | null>(null)

  async function fetchPerfil() {
    const loginStore = useLoginStore()
    loading.value = true
    erro.value = null
    try {
      const res = await fetch('/api/perfil', {
        headers: {
          'Authorization': `Bearer ${loginStore.token}`
        }
      })
      if (!res.ok) throw new Error('Não foi possível carregar o perfil')
      perfil.value = await res.json()
    } catch (e: any) {
      erro.value = e.message
    } finally {
      loading.value = false
    }
  }

  async function atualizarFoto(arquivo: File) {
    const loginStore = useLoginStore()
    const formData = new FormData()
    formData.append('foto', arquivo)
    try {
      const res = await fetch('/api/perfil/foto', {
        method: 'POST',
        headers: { 'Authorization': `Bearer ${loginStore.token}` },
        body: formData
      })
      if (!res.ok) throw new Error('Erro ao atualizar foto')
      const data = await res.json()
      if (perfil.value) perfil.value.foto = data.foto
    } catch (e: any) {
      erro.value = e.message
    }
  }

  return { perfil, loading, erro, fetchPerfil, atualizarFoto }
})
