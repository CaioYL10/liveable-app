import { defineStore } from 'pinia'
import { ref } from 'vue'

interface Imovel {
  id: number
  titulo: string
  preco: number
  avaliacao: number
  imagem?: string
  endereco?: string
  camas?: number
  banheiros?: number
  area?: number
}

export const usePropertiesStore = defineStore('properties', () => {
  const imoveis = ref<Imovel[]>([])
  const imovelSelecionado = ref<Imovel | null>(null)
  const loading = ref(false)
  const erro = ref<string | null>(null)

  async function fetchImoveis() {
    loading.value = true
    erro.value = null
    try {
      const res = await fetch('/api/imoveis')
      if (!res.ok) throw new Error('Erro ao buscar imóveis')
      imoveis.value = await res.json()
    } catch (e: any) {
      erro.value = e.message
    } finally {
      loading.value = false
    }
  }

  async function fetchImovel(id: number) {
    loading.value = true
    erro.value = null
    try {
      const res = await fetch(`/api/imoveis/${id}`)
      if (!res.ok) throw new Error('Imóvel não encontrado')
      imovelSelecionado.value = await res.json()
    } catch (e: any) {
      erro.value = e.message
    } finally {
      loading.value = false
    }
  }

  return { imoveis, imovelSelecionado, loading, erro, fetchImoveis, fetchImovel }
})