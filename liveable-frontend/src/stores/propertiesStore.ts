/* eslint-disable @typescript-eslint/no-explicit-any */
import { defineStore } from 'pinia'
import { ref } from 'vue'

interface Imovel {
  id: number
  title: string
  price: number
  type: string
  contact: number
  assessment: number
  area: number
  location: string
  imagem: string
  wiFi?: string
  tv?: string
  refrigerator?: string
  airConditioning?: string
  camas?: number
  washingMachine?: string
  microwave?: string
  banheiros?: number
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
