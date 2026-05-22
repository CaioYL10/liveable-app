<script setup lang="ts">
    // isso vai sair quando o router for arrumado, está forma de import esta aqui só para testes
    import propertyDetails from '@/modules/properties/views/propertyDetails.vue';
    import TheNav from '../components/TheNav.vue';
    import TheFooter from '../components/TheFooter.vue';
    import ViewProfile from '@/modules/profile/views/viewProfile.vue';
    import LoginView from '@/modules/login/views/loginView.vue';
    import homeView from '@/modules/home/views/homeView.vue';
import CardCarousel from '@/modules/properties/components/Card-carousel.vue';
</script>

<template>
    <header>
        <nav><TheNav class="nav" /></nav>
    </header>

    <main>
        <router-view />
        <CardCarousel />
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
