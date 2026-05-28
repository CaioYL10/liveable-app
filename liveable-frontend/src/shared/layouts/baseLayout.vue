<script setup lang="ts">
    import TheNav from '../components/TheNav.vue';
    import TheFooter from '../components/TheFooter.vue';
</script>

<template>
  <div class="container-all">
    <header>
        <nav><TheNav class="nav" /></nav>
    </header>

    <main>
        <router-view />
    </main>

    <footer>
      <TheFooter />
    </footer>
  </div>
</template>

<style scoped>
header {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 2vw;
}

main {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0 2rem;
}

.container-all {
  display: flex;
  flex-direction: column;
  gap: 2vw;
}
</style>

<!-- <script setup lang="ts">
import { onMounted, ref } from 'vue'

const mensagem = ref('carregando...')

onMounted(async () => {
  try {
    const response = await fetch('http://127.0.0.1:8000/api/teste')

    const data = await response.json()

    mensagem.value = data.mensagem
  } catch (error) {
    console.error(error)
    mensagem.value = 'erro ao conectar'
  }
})
</script>

<template>
  <div>
    <h1>{{ mensagem }}</h1>
  </div>
</template> -->
