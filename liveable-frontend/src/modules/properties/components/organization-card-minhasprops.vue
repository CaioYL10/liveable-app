<script setup lang="ts">
import { ref, onMounted } from 'vue'
import CardCasa from './CardCasa.vue'
import { getToken } from '@/services/auth'

interface Property {
  id: number
  property_title: string
  pricePerDay: number
  avaliation: number
  images: { url: string }[]
}

const properties = ref<Property[]>([])
const loading = ref(true)
const erro = ref(false)

onMounted(async () => {
  try {
    const token = getToken()

    const res = await fetch('http://127.0.0.1:8000/api/my-properties', {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: 'application/json',
      },
    })

    if (!res.ok) throw new Error()

    properties.value = await res.json()
  } catch {
    erro.value = true
  } finally {
    loading.value = false
  }
})
</script>

<template>
  <div class="container-organization">
    <p v-if="loading" class="loading">Carregando...</p>
    <p v-else-if="erro">Erro ao carregar propriedades.</p>
    <p v-else-if="properties.length === 0" class="vazio">
      Você ainda não tem nenhuma propriedade cadastrada.
    </p>
    <CardCasa v-else v-for="property in properties" :key="property.id" :casa="property" />
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

.container-organization {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 350px));
  gap: 30px;
  width: 100%;
  justify-content: center;
}

@media (max-width: 768px) {
  .container-organization {
    grid-template-columns: 1fr;
    justify-items: center;
  }
}

.vazio,
.loading {
  text-align: center;
  opacity: 0.5;
  font-size: 14px;
  grid-column: 1 / -1;
  font-family: 'Poppins', sans-serif;
  margin-top: 4rem;
}
</style>
