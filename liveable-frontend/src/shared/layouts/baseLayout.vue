<script setup lang="ts">
    // isso vai sair quando o router for arrumado, está forma de import esta aqui só para testes
    import propertyDetails from '@/modules/properties/views/propertyDetails.vue';
    import TheNav from '../components/TheNav.vue';
    import TheFooter from '../components/TheFooter.vue';
    import ViewProfile from '@/modules/profile/views/viewProfile.vue';
    import LoginView from '@/modules/login/views/loginView.vue';
    import homeView from '@/modules/home/views/homeView.vue';
    import CardCarousel from '@/modules/properties/components/Card-carousel.vue';
import CardAltaCarousel from '@/modules/properties/components/CardAlta-carousel.vue';
</script>

<template>
    <header>
        <nav><TheNav class="nav" /></nav>
    </header>

    <main>
        <router-view />
    </main>

    <footer>
      <TheFooter />
    </footer>
</template>

<style scoped>
header {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px 0;
}

main {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px 0;
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
